<?php
  require_once('DB.php');

  abstract class Crud extends DB {
    protected string $tabela;

    abstract public function insert();
    abstract public function update($token, $id);

    public function findById($id){
      $sql = "SELECT * FROM $this->tabela WHERE id=?";
      $sql = DB::prepare($sql);
      $sql->execute(array($id));
      $valor = $sql->fetch();
      return $valor;
    }

    public function findByEmail($email){
      $sql = "SELECT * FROM $this->tabela WHERE email=? LIMIT 1";
      $sql = DB::prepare($sql);
      $sql->execute(array(($email)));
      $usuario = $sql->fetch();
      return $usuario;
    }

    public function findBy($column, $condition){
      $sql = "SELECT * FROM $this->tabela WHERE $column=? LIMIT 1";
      $sql = DB::prepare($sql);
      $sql->execute(array(($condition)));
      $usuario = $sql->fetch();
      return $usuario;
    }

    public function findAll(){
      $sql = "SELECT * FROM $this->tabela";
      $sql = DB::prepare($sql);
      $sql->execute();
      $valor = $sql->fetchAll();
      return $valor;
    }

    public function delete($id) {
      $sql = "DELETE FROM $this->tabela WHERE id=?";
      $sql = DB::prepare($sql);
      $response = $sql->execute(array($id));
      return $response;
    }
  }
?>