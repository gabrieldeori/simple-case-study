<?php
require_once('DB.php');

class Login {
  protected string $tabela = 'usuarios';
  public string $nome;
  public string $email;
  public array $erro=[];
  private string $senha;
  private string $token;
}
?>