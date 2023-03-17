<?php
  class Crud extends DB {
    protected string $tabela;
    protected string $values;
    protected string $fields;
    protected array $propArray;
    protected array $error;

    public function create() {
      $sql = "INSERT INTO $this->tabela VALUES $this->values";
      $sql = DB::prepare($sql);
      $registered = $sql->execute($this->propArray);

      if($registered) {
        return true;
      }
      return false;
      $this->error["errorCrud"] = "Não criado!";
    }

    public function find() {
      $sql = "SELECT * FROM $this->tabela WHERE $this->fields LIMIT 1";
      $sql = DB::prepare($sql);
      $sql->execute($this->propArray);
      $finded = $sql->fetch();
      if($finded) {
        return $finded;
      }
      return false;
      $this->error["errorCrud"] = "Nada encontrado!";
    }

    public function update() {
      $sql = "UPDATE $this->tabela SET $this->values WHERE $this->fields";
      $sql = DB::prepare($sql);
      $updated = $sql->execute($this->propArray);
      if($updated) {
        return true;
      }
      return false;
      $this->error["errorCrud"] = "Não atualizado!";
    }

    public function delete() {
      $sql = "DELETE FROM $this->tabela WHERE $this->fields";
      $sql = DB::prepare($sql);
      $deleted = $sql->execute($this->propArray);
      if ($deleted) {
        return true;
      }
      return false;
      $this->error["errorCrud"] = "Não deletado!";
    }

    public function setError($error) {
      $errorKey = array_keys($error)[0];
      $this->error[$errorKey] = $error[$errorKey];
    }
  }
?>
