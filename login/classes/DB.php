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
        } catch (PDOException $error) {
          echo "<br> Falha ao se conectar com o banco: <br>".$error->getMessage();
        }
      }
      return self::$pdo;
    }

    protected function createToken() {
      return sha1(uniqid().date("Y-m-y H-i-s"));
    }

    public static function prepare($sql) {
      return self::instanciar()->prepare($sql);
    }
  }
?>
