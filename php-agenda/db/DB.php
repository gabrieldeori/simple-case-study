<?php
  require_once('config.php');

  class DB {
    private static $pdo;
    public static function instanciar(){
      if(!isset(self::$pdo)) {
        try {
          self::$pdo = new PDO('mysql:host='.SERVER.';dbname='.DATABASE,USER,PASSWORD);
          self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        } catch (PDOException $error) {
          echo "<br> Falha ao se conectar com o banco: <br>".$error->getMessage();
        }
      }
      return self::$pdo;
    }

    protected function createToken() {
      return sha1(uniqid().date("Y-m-d H:i:s"));
    }

    protected function getHour() {
      return date('Y-m-d H:i:s');
    }

    public static function prepare($sql) {
      return self::instanciar()->prepare($sql);
    }
  }
?>
