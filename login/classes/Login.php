<?php
require_once('DB.php');

class Login {
  protected string $tabela = 'usuarios';
  public string $nome;
  public string $email;
  public array $erro=[];
  private string $senha;
  private string $token;

  private function criptPass($senha) {
    return sha1($senha);
  }

  private function createToken() {
    return sha1(uniqid().date("Y-m-y H-i-s"));
  }

  private function updateLogin($token, $email, $criptSenha) {
    $sql = "UPDATE $this->tabela SET token=? WHERE email=? AND senha=? LIMIT 1";
    $sql = DB::prepare($sql);
    $updated = $sql->execute(array($token, $email, $criptSenha));
    if ($updated) {
      $_SESSION['token'] = $this->token;
      return true;
    }
    return false;
  }

  private function verifyEmailRegister($email, $criptSenha) {
    $sql = "SELECT * FROM $this->tabela WHERE email=? AND senha=? LIMIT 1";
    $sql = DB::prepare($sql);
    $sql->execute(array($email, $criptSenha));
    return $sql->fetch(PDO::FETCH_ASSOC); // FETCH COMO MATRIZ ASSOCIATIVA
  }

  public function auth($email, $senha) {
    $criptSenha = $this->criptPass($senha);
    $emailRegistered = $this->verifyEmailRegister($email, $criptSenha);
    if ($emailRegistered) {
      $this->token = $this->createToken();
    } else {
      $this->erro["erro_geral"] = "Usuário ou senha incorretos!";
      return false;
    }

    $updated = $this->updateLogin($this->token, $email, $criptSenha);
    if ($updated) {
      header('location: restrita/index.php');
      return true;
    }
    $this->erro["erro_geral"] = "Algo falhou no servidor!";
    return false;
  }
}
?>
