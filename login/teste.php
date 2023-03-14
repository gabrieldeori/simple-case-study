<?php
  require_once('classes/config.php');
  require_once('autoload.php');
  require_once('utils/validateFields.php');

    $nome = "Gabriel";
    $email = "deori@deori.deori";
    $senha = "12345678";
    $repete_senha = "12345678";
    $usuario = new Usuario($nome, $email, $senha);
    $usuario->set_repete_senha($repete_senha);
    print_r($usuario->findAll());

    // $usuario->validate_register();
    // $registered = $usuario->register();
    // echo $usuario->nome . "<br>";
    // print_r($usuario->erro);
    // echo $registered . "<br>";
    // echo "Olá";
?>