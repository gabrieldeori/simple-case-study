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
      return (object) [
        "name"=>$this->name,
        "surname"=>$this->surname,
        "nick"=>$this->nick,
        "email"=>$this->email,
        "number"=>$this->number,
        "birthdate"=>$this->birthdate,
        "photo"=>$this->photo,
        "id"=>$this->id
        ];
      }

      public function set($arrayProp) {
        foreach ($arrayProp as $key => $value) {
          $this->$key = $value;
        }
        return true;
    }

    private function validateContact() {
      if (!empty($this->name) and !preg_match("/^[a-zA-ZÀ-ÖØ-öø-ÿ ]*$/", $this->name)) {
        $this->error["error_name"] = "Somente letras e espaços em branco!";
      }

      if (!empty($this->surname) and !preg_match("/^[a-zA-ZÀ-ÖØ-öø-ÿ ]*$/", $this->surname)) {
        $this->error["error_surname"] = "Somente letras e espaços em branco!";
      }

      if (!empty($this->email) and !filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
        $this->error["error_email"] = "Formato de email inválido!";
      }

      if(!empty($this->number) and !preg_match('/^[\d\s()+-]+$/', $this->number)) {
        $this->error["error_number"] = "Número inválido!";
      }

      if(!empty($this->birthdate) and !preg_match('/^\d{4}-\d{2}-\d{2}$/', $this->birthdate, $matches)) {
        $this->error["error_birthdate"] = "Data inválida!";
      }

      // if(!empty($this->photo) and preg_match('/^.+\.(jpg|jpeg|png)$/', $this->photo)) {
      //   $this->error["error_photo"] = "Arquivo inválido!";
      // } # Esperar para ver se é possível validar o arquivo usando essa técnica.

      $someError = $this->getError();
      if ($someError) {
        return false;
      }
      return true;
    }

    public function findAllContacts() {
      $this->setTable('contacts');
      return $this->findAll();
    }

    public function registerContact() {
      $validatedContact = $this->validateContact();
      if ($validatedContact && empty($this->id)) {
        $this->setTable('contacts');
        $this->values = "(null,?,?,?,?,?,?,?,?)";
        $this->propArray = [
          $this->name,
          $this->surname,
          $this->nick,
          $this->email,
          $this->number,
          $this->birthdate,
          $this->photo,
          $this->getHour()
        ];
        $registered = $this->create();
        if ($registered) {
          return true;
        } else {
          return false;
        }
      } else if ($validatedContact && !empty($this->id)) {
        $this->setTable('contacts');
        $this->values = "(?,?,?,?,?,?,?,?)";
        $this->propArray = [
          $this->name,
          $this->surname,
          $this->nick,
          $this->email,
          $this->number,
          $this->birthdate,
          $this->photo,
        ];
        $this->fields = ['id', 'name', 'surname', 'nick', 'email', 'number', 'birthdate', 'photo'];
        $registered = $this->update();
        if ($registered) {
          return true;
        } else {
          return false;
        }
      }
      return false;
    }
  }
?>
