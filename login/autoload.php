<?php
  function autoload($className) {
    $dir = __DIR__ . '/exautoload/' . $className . '.php';
    $dir = str_replace("\\", DIRECTORY_SEPARATOR, $dir);
    if (is_file($dir)) {
      require_once($dir);
    }
  }

  spl_autoload_register('autoload');
?>