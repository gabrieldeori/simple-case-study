<?php
  class Recuperar extends Usuario {
    function __construct(
      private string $email,
    ) {}

    private function emailCheck($email) {
      $sql = "SELECT * FROM $this->tabela WHERE email=? LIMIT 1";
      $sql = DB::prepare($sql);
      $sql->execute(array($email));
      return $sql->fetch();
    }

    private function registerToken($token, $email) {
      $sql = "UPDATE $this->tabela SET recupera_senha=? WHERE email=? LIMIT 1";
      $sql = DB::prepare($sql);
      $sql->execute(array($token, $email));
      return $sql->fetch();
    }

    private function sendEmail($token, $email) {
      return true;
    }

    public function recuperarSenha() {
      $emailExists = $this->emailCheck($this->email);
      if ($emailExists) {
        $token = $this->createToken();
        $tokened = $this->registerToken($token, $this->email);

        if($tokened) {
          $this->sendEmail($token, $this->email);
        }

        return true;
      } else {
        return false;
      }
    }
  }
?>