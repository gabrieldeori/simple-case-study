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

      public function set($name, $surname, $nick, $email, $number, $birthdate, $photo) {
        $this->name = 'name';
        $this->surname = 'surname';
        $this->nick = 'nick';
        $this->email = 'email';
        $this->number = 'number';
        $this->birthdate = 'birthdate';
        $this->photo = 'photo';
        $this->id = 'id';
        return true;
    }
  }
?>
