<?php
  require_once('config.php');

  class DB {
    private static $pdo;
    public static function instanciar(){
      if(!isset(self::$pdo)) {
        try {
          self::$pdo = new PDO('mysql:host='.SERVIDOR.';dbname='.BANCO,USUARIO,SENHA);
          self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
          echo "<br> CONECTADO <br>";
        } catch (PDOException $error) {
          echo "<br> Falha ao se conectar com o banco: <br>".$error->getMessage();
        }
      }
      return self::$pdo;
    }

    public static function prepare($sql) {
      return self::instanciar()->prepare($sql);
    }
  }
?>
