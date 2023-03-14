<?php
  require_once('classes/config.php');
  require_once('autoload.php');
  require_once('utils/validateFields.php');
  require_once("templates/basic_input.php");

  $nome = "";
  $email = "";

  $fieldsResponse = validateEmptyFields(['nome', 'email', 'senha', 'repete_senha']);
  if (isset($fieldsResponse[ERROR])) {
    $erro_geral = $fieldsResponse[ERROR];
  } else { 
    $nome = $fieldsResponse['nome'];
    $email = $fieldsResponse['email'];
    $senha = $fieldsResponse['senha'];
    $repete_senha = $fieldsResponse['repete_senha'];
    $usuario = new Usuario($nome, $email, $senha);
    $usuario->set_repete_senha($repete_senha);
    $usuario->validate_register();
    $registered = $usuario->register();
    if($registered) {
      header('location: index.php?registered=1');
    } else {
      $erro_geral = $usuario->erro["erro_geral"];
    }
  }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="src/css/estilo.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  <title>Cadastrar</title>
</head>
<body>
  <form method="POST">
    <h1>Cadastrar</h1>

    <?php include("templates/general_error.php")?>
    <?php
      basicInput('nome', 'text', 'Digite seu nome', 'src/img/id-card.png', $nome, true);
      basicInput('email', 'email', 'Digite seu email', 'src/img/user.png', $email, true);
      basicInput('senha', 'password', 'Digite uma senha', 'src/img/lock.png', '', true);
      basicInput('repete_senha', 'password', 'Repita sua senha', 'src/img/unlock.png', '', true);
    ?>
      <div <?php if(isset($erro_geral) or isset($erro_checkbox)) { echo "class=\"erro-input\" \"input-check-group\""; } else { echo "class=\"input-check-group\""; } ?> >
        <input type="checkbox" name="termos" id="termos" value="ok" required>
        <label for="termos">
          Ao se cadastrar você concorda com a nossa
          <a class="link" href="">Política de Privacidade</a>
          e os nossos <a class="link" href="">Termos de Uso</a>.
        </label>
        <?php
          if(isset($erro_checkbox)) {
            echo "<div class=\"erro\">$erro_checkbox</div>";
          }
        ?>
        </div>
    <button class="btn-blue" type="submit">Cadastrar</button>
    <a href="index.php">Já tenho uma conta</a>
  </form>
</body>
</html>
