<?php
  require('./autoload.php');
  require('./utils/charFilter.php');
  require('./utils/validateFields.php');

  $contact = new Contact();
  $contact->set($_POST);
  $contact->setOldPhoto();
  $contactValues = $contact->get();

  if(isset($_POST['submit']) && !isset($_POST['delete'])) {
    $validatedFields = validateAtLeastOneField(["name", "nick", "number", "email"]);
    if (isset($validatedFields[ERROR_VAL])) {
      $contact->setError($validatedFields);
    } else {
      $contactValues = $contact->get();
      $validatedOtherFields = validateAnyField(['surname', 'birthdate', 'id']);
      $validatedProfilepic = validateProfilepic('profilepic');
      $contact->set($validatedFields);
      $contact->set($validatedOtherFields);
      if ($validatedProfilepic['name'] != "") {
        $contact->setProfilepic($validatedProfilepic);
      }
      $registeredContact = $contact->registerContact();
    }

    if($contact->getError()) {
      foreach ($contact->getError() as $newError) {
        echo "<p class=\"error_message\">".$newError."</p>";
      }
    }
  }

  if(isset($_POST['delete']) && $_POST['delete'] === "deletar") {
    $contact->deleteContact();
  }
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
  <?php
    $contactValues = $contact->get();
  ?>
  <header class="contacts-header">
    <h1>Contatos</h1>
  </header>
  <main>
    <form class="edit" method="POST" enctype="multipart/form-data">
      <div class="profile-pic-wrapper">
        <img class="profile-pic" alt=""
          src=<?php if (!is_array($contactValues->photo)) { echo "'$contactValues->photo'"; } ?>
        >
        <input type="file" name="profilepic" id="profilepic">
      </div>

      <div class="form-group">
        <label for="name"><i class="fa-solid fa-user"></i></label>
        <input class="nice-input" type="text" name="name" id="name" placeholder="Nome"
            value=<?php echo "'$contactValues->name'" ?>>
      </div>

      <div class="form-group">
        <label for="name"><i class="fa-solid fa-user"></i></label>
        <input class="nice-input" type="text" name="surname" id="surname" placeholder="Sobrenome"
            value=<?php echo "'$contactValues->surname'" ?>>
      </div>

      <div class="form-group">
        <label for="name"><i class="fa-solid fa-user"></i></label>
        <input class="nice-input" type="text" name="nick" id="nick" placeholder="Apelido"
            value=<?php echo "'$contactValues->nick'" ?>>
      </div>

      <div class="form-group">
        <label for="number"><i class="fa-solid fa-phone"></i></label>
        <input class="nice-input" type="tel" name="number" id="number" placeholder="Número"
          value=<?php echo "'$contactValues->number'" ?>>
      </div>

      <div class="form-group">
        <label for="email"><i class="fa-solid fa-envelope"></i></label>
        <input class="nice-input" type="email" name="email" id="email" placeholder="E-mail"
          value=<?php echo "'$contactValues->email'" ?>>
      </div>

      <div class="form-group">
        <label for="birthdate"><i class="fa-solid fa-cake-candles"></i></label>
        <input class="nice-input" type="date" name="birthdate" id="birthdate"
          value=<?php echo "'$contactValues->birthdate'" ?>>
      </div>
      <div class="flex-row">
        <button class="nice-btn-green" type="submit" name="submit">Salvar</button>
      </div>
      <input type="hidden" name="id" value=<?php echo"'$contactValues->id'" ?>>
      <input type="hidden" name="old_photo" value=<?php echo"'$contactValues->old_photo'" ?>>
      <input type="hidden" name="photo" value=<?php if (!is_array($contactValues->photo)) { echo "'$contactValues->photo'"; } ?>>
    </form>
    <form class="flex-row" method="POST">
      <input id="deleteInput" name="delete" type="text" placeholder="Digite 'deletar' sem aspas para deletar">
      <input type="hidden" name="id" value=<?php echo"'$contactValues->id'" ?>>
      <button disabled="true" class="nice-btn-green" id="deleteButton" type="submit">Deletar</button>
    </form>
    <div class="flex-row">
      <a href="index.php"><button class="nice-btn-green">Voltar</button></a>
    </div>
  </main>
  <script>
    const deleteInput = document.getElementById('deleteInput');
    const deleteButton = document.getElementById('deleteButton');
    deleteInput.addEventListener('input', ({ target }) => {
      if (target.value === "deletar") {
        deleteButton.disabled = false;
      } else {
        deleteButton.disabled = true;
      }
    })
  </script>
</body>

</html>