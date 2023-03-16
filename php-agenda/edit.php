<?php
  require('./autoload.php');

  $contact = new Contact();
  $contact_info = $contact->get();
  print_r($contact_info);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./src/css/base.css">
  <link rel="stylesheet" href="./src/css/general.css">
  <link rel="stylesheet" href="./src/css/edit.css">
  <script src="https://kit.fontawesome.com/1c46d70306.js" crossorigin="anonymous"></script>
  <title>Editar Contato</title>
</head>
<body>
  <main>
    <form class="edit" method="POST">
      <img class="profile-pic" src="src/img/profile.svg" alt="">
      <div class="form-group">
        <label for="name"><i class="fa-solid fa-user"></i></label>
        <div>
          <input class="nice-input" type="text" name="name" id="name" placeholder="Nome" value="Gabriel" required>
          <input class="nice-input" type="text" name="surname" id="surname" placeholder="Sobrenome" value="de Oliveira Ribeiro" required>
          <input class="nice-input" type="text" name="nick" id="nick" placeholder="Apelido" value="Deori">
        </div>
      </div>
    
      <div class="form-group">
        <label for="number"><i class="fa-solid fa-phone"></i></label>
        <input class="nice-input" type="tel" name="number" id="number" placeholder="Celular" value="+5532999999999">
      </div>
    
      <div class="form-group">
        <label for="email"><i class="fa-solid fa-envelope"></i></label>
        <input class="nice-input" type="email" name="email" id="email" placeholder="E-mail" value="deori@mail.com">
      </div>
    
      <div class="form-group">
        <label for="birthdate"><i class="fa-solid fa-cake-candles"></i></label>
        <input class="nice-input" type="date" name="birthdate" id="birthdate" value="1995-05-04">
      </div>
    </form>

    <div class="flex-row">
      <button class="nice-btn-green" type="submit" disabled>Salvar</button>
      <a href="index.php"><button class="nice-btn-green">Voltar</button></a>
    </div>
  </main>
</body>
</html>