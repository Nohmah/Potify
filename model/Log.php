<?php

namespace Model;

use SQLite3;

class Log
{
    private $id;
    private $username;
    private $mail;
    private $password;
    private $right;
    private $registration_date;
    public function __construct($id,$username, $mail, $password, $right,$registration_date)
    {
        $this->id=$id;
        $this->username = $username;
        $this->mail = $mail;
        $this->password = $password;
        $this->right = $right;
        $this->registration_date=$registration_date;
    }

    //Création des accesseurs et mutateurs des attributs de la classe.

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getMail()
    {
        return $this->mail;
    }

    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getRight()
    {
        return $this->right;
    }

    public function setRight($right)
    {
        $this->right = $right;
    }

    public function getRegistrationDate()
    {
        return $this->registration_date;
    }

    public function setRegistrationDate($registration_date)
    {
        $this->registration_date = $registration_date;
    }

    public static function VerifMail($mail)
    {
        $db = new SQLite3('../data/data.db');
        $sql = $db->prepare("select * from log where mail=?");
        $sql->bindValue(1,$mail);
        $results=$sql->execute();
        if ($results->fetchArray() != null) {
          echo "Adresse email deja utilisé";
          exit;
          }
    }
}

?>