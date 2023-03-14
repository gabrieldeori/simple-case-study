<?php
  require_once('Crud.php');

  class Usuario extends Crud {
    protected string $tabela = 'usuarios';

    function __construct(
      public string $nome,
      private string $email,
      private string $senha,
      private string $repete_senha = "",
      private string $recupera_senha = "",
      private string $token = "",
      private string $codigo_confirmacao = "",
      private string $status = "",
      public array $erro = []
    ) {}

      public function insert() {
        $usuario = $this->findByEmail($this->email);
        if(!$usuario) {
          $data_cadastro = date('Y-m-d H:i:s');
          $senha_cripto = sha1($this->senha);
          $sql = "INSERT INTO $this->tabela VALUES (null,?,?,?,?,?,?,?,?)";
          $sql=DB::prepare($sql);
          $registered = $sql->execute(
            array(
              $this->nome,
              $this->email,
              $senha_cripto,
              $this->recupera_senha,
              $this->token,
              $this->codigo_confirmacao,
              $this->status,
              $data_cadastro
            ));

          if(!$registered) {
              $this->erro["erro_geral"] = "Ocorreu um erro interno no banco!";
              return false;
            }
          return $registered;
        } else {
          $this->erro["erro_geral"] = "Usuário já cadastrado!";
        }
      }

      public function update($token, $id) {
        $sql = "UPDATE $this->tabela SET token=? WHERE id=?";
        $sql = DB::prepare($sql);
        return $sql->execute(array($token, $id));
      }

    public function set_repete_senha($repete_senha) {
      $this->repete_senha = $repete_senha;
    }

    public function validate_register() {
      if (!preg_match("/^[a-zA-ZÀ-ÖØ-öø-ÿ ]*$/", $this->nome)) {
        $this->erro["erro_nome"] = "Somente letras e espaços em branco!";
      }

      if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
        $this->erro["erro_email"] = "Formato de email inválido!";
      }

      if (strlen($this->senha) < 8) {
        $this->erro["erro_senha"] = "Senha deve ter ao menos 8 caracteres!";
      }

      if($this->senha !== $this->repete_senha) {
        $this->erro["erro_repete"] = "Senhas não correspondem!";
      }
    }

    public function register() {
      if(empty($this->erro)) {
        return $this->insert();
      } else {
        $this->erro["erro_geral"] = "Alguns campos apresentam problemas!";
        return false;
      }
    }
  }
?>
