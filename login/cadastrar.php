<?php
  require_once('classes/config.php');
  require_once('autoload.php');
  require_once('utils/validateFields.php');

  $fieldsResponse = validateEmptyFields(['nome', 'email', 'senha', 'repete_senha']);
  if (isset($fieldsResponse[ERROR])) {
    echo $fieldsResponse[ERROR];
  } else {
    print_r($fieldsResponse);
  }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/estilo.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  <title>Cadastrar</title>
</head>
<body>
  <form method="POST">
    <h1>Cadastrar</h1>

    <div class="input-group">
      <img class="input-icon" src="img/id-card.png" alt="">
      <input
        type="text" name="nome" id="nome"
        placeholder="Digite seu nome Completo"
      >
    </div>
    <div class="input-group">
      <img class="input-icon" src="img/user.png" alt="">
      <input
        type="email" name="email" id="email" placeholder="Digite seu email"
      >
    </div>
    <div class="input-group">
      <img class="input-icon" src="img/lock.png" alt="">
      <input
          type="password" name="senha" id="senha" placeholder="Digite sua senha"
        >
    </div>
    <div class="input-group">
      <img class="input-icon" src="img/unlock.png" alt="">
      <input
          type="password" name="repete_senha" id="repete_senha" placeholder="Repita sua senha"
        >
    </div>
    <div>
      <input type="checkbox" name="termos" id="termos" value="ok">
      <label for="termos">
        Ao se cadastrar você concorda com a nossa
        <a class="link" href="">Política de Privacidade</a>
        e os nossos <a class="link" href="">Termos de Uso</a>.
      </label>
    </div>
    <button class="btn-blue" type="submit">Cadastrar</button>
    <a href="index.php">Já tenho uma conta</a>
  </form>
</body>
</html>
