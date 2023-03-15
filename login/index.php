<?php
    require_once('classes/config.php');
    require_once('autoload.php');
    require_once('utils/validateFields.php');
    require_once("templates/basic_input.php");

    $email = "";

    $fieldsResponse = validateEmptyFields(['email', 'senha']);
    if (isset($fieldsResponse[ERROR])) {
      $erro_geral = $fieldsResponse[ERROR];
    } else {
      $email = $fieldsResponse['email'];
      $senha = $fieldsResponse['senha'];

      $login = new Login();
      $logged = $login->auth($email, $senha);

      if($logged) {
        header('location: restrita/index.php');
      } else {
        $erro_geral = $login->erro['erro_geral'];
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
  <title>Login</title>
</head>
<body>
  <form method="post">
    <h1>Login</h1>

    <?php if (isset($_GET['result']) && $_GET['result'] === 'ok') { ?>
        <div class="sucesso animate__animated animate__rubberBand">Cadastrado com sucesso!</div>
    <?php } ?>

    <?php if (isset($erro_geral)) { ?>
        <div class="erro-geral animate__animated animate__rubberBand">
         <?php echo $erro_geral; ?>
        </div>
    <?php } ?>

    <?php
      basicInput('email', 'email', 'Digite seu email', 'src/img/user.png', $email, false);
      basicInput('senha', 'password', 'Digite sua senha', 'src/img/lock.png', '', false);
    ?>
    <a href="esqueci.php">Esqueceu a senha?</a>
    <button class="btn-blue" type="submit">Fazer Login</button>
    <a href="cadastrar.php">Ainda não tenho cadastro</a>
  </form>
</body>
</html>