<?php
  class Recuperar extends DB {
    private string $tabela = "usuarios";
    function __construct(
      private string $email
    ) {}

    private function emailCheck($email) {
      $sql = "SELECT * FROM $this->tabela WHERE email=? LIMIT 1";
      $sql = DB::prepare($sql);
      $sql->execute(array($email));
      return $sql->fetch();
    }

    private function sendEmail ($email) {
      return true;
    }

    public function recuperarSenha() {
      $emailExists = $this->emailCheck($this->email);
      if ($emailExists) {
        $this->sendEmail($this->email);
        return true;
      } else {
        return false;
      }
    }
  }
?>