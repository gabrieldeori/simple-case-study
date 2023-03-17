<?php
  class Contact extends Crud {
    private $name = "";
    private $surname = "";
    private $nick = "";
    private $email = "";
    private $number = "";
    private $birthdate = "";
    private $photo = "";
    private $id = "";

    public function get() {
      return [
        'name'=>$this->name,
        'surname'=>$this->surname,
        'nick'=>$this->nick,
        'email'=>$this->email,
        'number'=>$this->number,
        'birthdate'=>$this->birthdate,
        'photo'=>$this->photo,
        'id'=>$this->id
        ];
      }

      public function set($arrayProp) {
        foreach ($arrayProp as $key => $value) {
          $this->$key = $value;
        }
        return true;
    }
  }
?>
