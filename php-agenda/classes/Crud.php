<?php
  define('ERROR_CRUD', 'error_crud');

  class Crud extends DB {
    protected string $table;
    protected string $values;
    protected string $fields;
    protected array $propArray;
    protected array $error;

    protected function setTable($tableName) {
      $this->table = $tableName;
    }

    public function create() {
      $sql = "INSERT INTO $this->table VALUES $this->values";
      $sql = DB::prepare($sql);
      $registered = $sql->execute($this->propArray);
      if($registered) {
        return true;
      }
      echo $registered;
      $this->error[ERROR_CRUD] = "Não criado!";
      return false;
    }

    public function findAll() {
      $sql = "SELECT * FROM $this->table";
      $sql = DB::prepare($sql);
      $sql->execute();
      $finded = $sql->fetchAll();
      if($finded) {
        return $finded;
      }
      return false;
      $this->error[ERROR_CRUD] = "Nada encontrado!";
    }

    public function find() {
      $sql = "SELECT * FROM $this->table WHERE $this->fields LIMIT 1";
      $sql = DB::prepare($sql);
      $sql->execute($this->propArray);
      $finded = $sql->fetch();
      if($finded) {
        return $finded;
      }
      return false;
      $this->error[ERROR_CRUD] = "Nada encontrado!";
    }

    public function update() {
      $sql = "UPDATE $this->table SET $this->values WHERE $this->fields";
      $sql = DB::prepare($sql);
      $updated = $sql->execute($this->propArray);
      if($updated) {
        return true;
      }
      return false;
      $this->error[ERROR_CRUD] = "Não atualizado!";
    }

    public function delete() {
      $sql = "DELETE FROM $this->table WHERE $this->fields";
      $sql = DB::prepare($sql);
      $deleted = $sql->execute($this->propArray);
      if ($deleted) {
        return true;
      }
      return false;
      $this->error[ERROR_CRUD] = "Não deletado!";
    }

    public function setError($error) {
      $errorKey = array_keys($error)[0];
      $this->error[$errorKey] = $error[$errorKey];
    }

    public function getError() {
      if(!empty($this->error)) {
        return $this->error;
      }
      return false;
    }
  }
?>
