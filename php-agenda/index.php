<?php
  require('./autoload.php');
  require('./utils/charFilter.php');
  require('./utils/validateFields.php');
  require('./templates/contact.php');

  $contacts = new Contact();
  $contacts = $contacts->findAllContacts();

  foreach($contacts as $contact) {
    echo "<pre class='developer'>";
    print_r($contact);
    echo "</pre>";
  }
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./src/css/base.css">
  <link rel="stylesheet" href="./src/css/general.css">
  <link rel="stylesheet" href="./src/css/contact.css">
  <script src="https://kit.fontawesome.com/1c46d70306.js" crossorigin="anonymous"></script>
  <title>Agenda</title>
</head>

<body>
  <header>
    <h1>Contatos</h1>
    <a href="edit.php"><button class="nice-btn-green">Novo contato</button></a>
  </header>
  <main class="contacts">
    <?php
    foreach($contacts as $contact) {
      createContact($contact);
    }
    ?>
  </main>
  <script src="./src/scripts/contactMenu.js"></script>
</body>

</html>