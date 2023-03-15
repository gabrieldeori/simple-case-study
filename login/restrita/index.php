<?php
  require_once('../classes/config.php');
  require_once('../autoload.php');

  $token = $_SESSION['TOKEN'];

  $login = new Login();
  $logged = $login->isAuth($token);

  if ($logged) {
    echo "<h1>Bem-vindo $login->nome</h1>";
    echo "<h2>$login->email</h2>";
  } else {
    header('location: ../index.php');
  }
?>
