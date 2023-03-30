<?php
  require('./autoload.php');
  require('./utils/charFilter.php');
  require('./utils/validateFields.php');
  require('./templates/contact.php');

  
  $contacts = new Contact();

  if(isset($_POST['submit_search'])) {
    echo "input: " . $_POST['inputSearch'];
  } else {
    $contacts = $contacts->findAllContacts();
    usort($contacts, function($a, $b) {
      return strcmp($a->name, $b->name);
    });
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
  <header class="contacts-header">
    <h1>Contatos</h1>
  </header>
  <main class="contacts">
    <div class="header-controls">
      <a href="edit.php" class="nice-btn-green">Novo Contato</a>
      <form method="POST">
        <input type="text" name="inputSearch" id="inputSearh">
        <button type="submit" name="submit_search" class="nice-btn-green">Procurar</button>
      </form>
    </div>
    <?php
      if($contacts) {
        foreach($contacts as $contact) {
          createContact($contact);
        }
      }
    ?>
  </main>
  <script src="./src/scripts/contactMenu.js"></script>
</body>
</html>