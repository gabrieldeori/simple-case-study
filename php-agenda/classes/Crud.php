<?php
  require('../db/DB.php');

  class Crud extends DB {
    protected string $tabela;
    protected string $query;
    protected array $propArray;
    protected array $erro;

    public function create() {
      $sql = "INSERT INTO $this->tabela VALUES $this->query";
      $sql = DB::prepare($sql);
      $registered = $sql->execute($this->propArray);

      if($registered) {
        return true;
      }
      return false;
      $this->erro["erro_geral"] = "Ocorreu um erro interno no banco!";
    }

    public function findById($id) {
      $sql = "SELECT * FROM $this->tabela WHERE id=? LIMIT 1";
      $sql = DB::prepare($sql);
      $sql->execute(array($id));
      return $sql->fetch();
    }

    public function updateById($id) {
    }
  }
?>