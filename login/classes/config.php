<?php
  define('SERVIDOR', 'localhost');
  define('USUARIO', 'root');
  define('SENHA', '');
  define('BANCO', 'login');

  function antiXSite($dados) {
    $dados = trim($dados);
    $dados = stripslashes($dados);
    $dados = htmlspecialchars($dados);

    return $dados;
  }
?>
