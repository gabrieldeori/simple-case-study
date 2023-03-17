<?php
  require('./autoload.php');
  require('./utils/charFilter.php');
  require('./utils/validateFields.php');

  $contact = new Contact();

  $validatedFields = validateAtLeastOneField(["name", "nick", "number", "email"]);
  if (isset($validatedFields[ERROR_VAL])) {
    $contact->setError($validatedFields);
  } else {
    $validatedOtherFields = validateAnyField(['surname', 'birthdate', 'photo']);
    $contact->set($validatedFields);
    $contact->set($validatedOtherFields);
    $validatedContact = $contact->registerContact();
  }
?>

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
