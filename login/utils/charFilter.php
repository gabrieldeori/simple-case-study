<?php
  function antiXSite($dados) {
    $dados = trim($dados);
    $dados = stripslashes($dados);
    $dados = htmlspecialchars($dados);

    return $dados;
  }
?>
