<?php
  function autoload($nomeClass) {
    $dir = __DIR__ . '/exautoload/' . $nomeClass . '.php';
    $dir = str_replace("\\", DIRECTORY_SEPARATOR, $dir);
    if (is_file($dir)) {
      require_once($dir);
    }
  }

  spl_autoload_register('autoload');
?>