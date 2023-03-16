<?php
  class Contact {
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
        'name'=>$this->surname,
        'name'=>$this->nick,
        'name'=>$this->email,
        'name'=>$this->number,
        'name'=>$this->birthdate,
        'name'=>$this->photo,
        'name'=>$this->id
      ];
    }

    public function set($name, $surname, $nick, $email, $number, $birthdate, $photo) {

    }
  }
?>
