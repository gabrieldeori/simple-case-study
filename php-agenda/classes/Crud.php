<?php
  require('../db/DB.php');

  class Crud extends DB {
    protected string $tabela;
    protected string $values;
    protected string $wheres;
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

    public function findBy() {
      $sql = "SELECT * FROM $this->tabela WHERE $this->wheres LIMIT 1";
      $sql = DB::prepare($sql);
      $sql->execute($this->propArray);
      return $sql->fetch();
    }

    public function updateById($id) {
    }
  }
?>