<?php
  require_once('classes/config.php');
  require_once('autoload.php');
  require_once('utils/validateFields.php');

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
  <link rel="stylesheet" href="./css/estilo.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  <title>Cadastrar</title>
</head>
<body>
  <form method="POST">
    <h1>Cadastrar</h1>

    <?php include("components/general_error.php")?>

    <div class="input-group">
      <img class="input-icon" src="img/id-card.png" alt="">
      <input
        <?php if(isset($erro_geral) or isset($usuario->erro['erro_nome'])) { echo "class=\"erro-input\""; }?>
        <?php if(isset($_POST['nome_completo'])) { echo "value=\"".$_POST['nome_completo']."\""; }?>
        type="text" name="nome_completo" id="nome_completo" placeholder="Digite seu nome Completo" required
      >
      <?php
          if(isset($usuario->erro['erro_nome'])) {
            echo "<div class=\"erro\">$usuario->erro['erro_nome']</div>";
          }
        ?>
      </div>
      <div class="input-group">
        <img class="input-icon" src="img/user.png" alt="">
        <input
          <?php if(isset($erro_geral) or isset($erro_email)) { echo "class=\"erro-input\""; }?>
          <?php if(isset($_POST['email'])) { echo "value=\"".$_POST['email']."\""; }?>
          type="email" name="email" id="email" placeholder="Digite seu email" required
        >
        <?php
          if(isset($erro_email)) {
            echo "<div class=\"erro\">$erro_email</div>";
          }
        ?>
      </div>
      <div class="input-group">
        <img class="input-icon" src="img/lock.png" alt="">
        <input
          <?php if(isset($erro_geral) or isset($erro_senha)) { echo "class=\"erro-input\""; }?>
          <?php if(isset($_POST['senha'])) { echo "value=\"".$_POST['senha']."\""; }?>
            type="password" name="senha" id="senha" placeholder="Digite sua senha" required
          >
        <?php
          if(isset($erro_senha)) {
            echo "<div class=\"erro\">$erro_senha</div>";
          }
        ?>
      </div>
      <div class="input-group">
        <img class="input-icon" src="img/unlock.png" alt="">
        <input
          <?php if(isset($erro_geral) or isset($erro_repete_senha)) { echo "class=\"erro-input\""; }?>
          <?php if(isset($_POST['repete_senha'])) { echo "value=\"".$_POST['repete_senha']."\""; }?>
            type="password" name="repete_senha" id="repete_senha" placeholder="Repita sua senha" required
          >
        <?php
          if(isset($erro_repete_senha)) {
            echo "<div class=\"erro\">$erro_repete_senha</div>";
          }
        ?>
      </div>
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
    <button class="btn-blue" type="submit">Cadastrar</button>
    <a href="index.php">Já tenho uma conta</a>
  </form>
</body>
</html>
