<?php
  require('../db/DB.php');

  class Crud extends DB {
    protected string $tabela;
    protected string $values;
    protected string $fields;
    protected array $propArray;
    protected array $erro;

    public function create() {
      $sql = "INSERT INTO $this->tabela VALUES $this->values";
      $sql = DB::prepare($sql);
      $registered = $sql->execute($this->propArray);

      if($registered) {
        return true;
      }
      return false;
      $this->erro["erro_geral"] = "Ocorreu um erro interno no banco!";
    }

    public function find() {
      $sql = "SELECT * FROM $this->tabela WHERE $this->fields LIMIT 1";
      $sql = DB::prepare($sql);
      $sql->execute($this->propArray);
      return $sql->fetch();
    }

    public function update() {
      $sql = "UPDATE $this->tabela SET $this->values WHERE $this->fields";
      $sql = DB::prepare($sql);
      return $sql->execute($this->propArray);
    }
  }
?>
