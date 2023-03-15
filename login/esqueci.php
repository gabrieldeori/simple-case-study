<?php
  require_once('classes/config.php');
  require_once('autoload.php');
  require_once('utils/validateFields.php');
  require_once("templates/basic_input.php");

  $fieldsResponse = validateEmptyFields(['email']);
  if (isset($fieldsResponse[ERROR])) {
    $erro_geral = $fieldsResponse[ERROR];
  } else {
    $email = $fieldsResponse['email'];
    $recuperar = new Recuperar($email);
    header('location: recuperar.php');
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
  <title>Esqueci a Senha</title>
</head>
<body>
  <form method="POST">
    <h1>Recuperar senha</h1>
    <?php
      basicInput('email', 'email', 'Digite seu email', 'src/img/id-card.png', '', true);
    ?>
    <button class="btn-blue" type="submit">Recuperar senha</button>
    <a href="login.php">Fazer login</a>
  </form>
</body>
</html>