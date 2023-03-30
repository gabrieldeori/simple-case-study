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
    private $old_photo = "";

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
        foreach ((object) $arrayProp as $key => $value) {
          $this->$key = $value;
        }
        return true;
    }

    public function setOldPhoto($old) {
      $this->old_photo = $old;
    }

    public function setProfilepic($imageInfo) {
        $this->photo = $imageInfo;
      return true;
  }

    private function validateContact() {
      if (!empty($this->name) && !preg_match("/^[a-zA-ZÀ-ÖØ-öø-ÿ ]*$/", $this->name)) {
        $this->error["error_name"] = "Somente letras e espaços em branco!";
      }

      if (!empty($this->surname) && !preg_match("/^[a-zA-ZÀ-ÖØ-öø-ÿ ]*$/", $this->surname)) {
        $this->error["error_surname"] = "Somente letras e espaços em branco!";
      }

      if (!empty($this->email) && !filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
        $this->error["error_email"] = "Formato de email inválido!";
      }

      if (!empty($this->number) && !preg_match('/^[\d\s()+-]+$/', $this->number)) {
        $this->error["error_number"] = "Número inválido!";
      }

      if (!empty($this->birthdate) && !preg_match('/^\d{4}-\d{2}-\d{2}$/', $this->birthdate, $matches)) {
        $this->error["error_birthdate"] = "Data inválida!";
      }

      if (!empty($this->photo['name'])) {
        $image = $this->photo;
        $extension = pathinfo($image['name'], PATHINFO_EXTENSION);
        $permited = "/^(jpg|jpeg|png)$/";
        if (!preg_match($permited, $extension)) {
          $this->error["error_photo"] = "Apenas imagens jpg ou png permitidas";
        } else {
          $max_size = 1024 * 1024 * 2; // 2mb
          if ($image['size'] > $max_size) {
            $this->error["error_photo"] = "Tamanho máximo de 2mb";
          } else {
            $imgname = sha1(date('YmdHis').uniqid().$image['name']).".".$extension;
            $temporary = $image['tmp_name'];
            $dir = './public/img/';
            if (file_exists($this->old_photo)) {
              $deleted = unlink($this->old_photo);
            }

            move_uploaded_file($temporary, $dir . $imgname);
            $this->photo = $dir . $imgname;
          }
        }
      } else {
        $this->photo = "./src/img/profile.svg";
      }

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

    public function findBy($fieldString, $valueArray) {
      $this->setTable('contacts');
      $this->fields = [$fieldString];
      $this->propArray = (array) [$valueArray];
      return $this->find();
    }
  


    public function deleteContact() {
      $this->setTable('contacts');
      $this->fields = "id=?";
      $this->propArray = [$this->id];
      $this->delete();
    }

    public function registerContact() {
      $validatedContact = $this->validateContact();
      if ($validatedContact && $this->id === "") {
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
      } else if ($validatedContact && $this->id !== "") {
        $this->setTable('contacts');
        $this->values = "name=?,surname=?,nick=?,email=?,number=?,birthdate=?,photo=?";
        $this->propArray = (array) [
          $this->name,
          $this->surname,
          $this->nick,
          $this->email,
          $this->number,
          $this->birthdate,
          $this->photo,
          $this->id
        ];
        $this->fields = 'id=?';
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