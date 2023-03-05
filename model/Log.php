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
    /**
     * Le constructeur de la classe Log
     *
     * @param  mixed $id
     * @param  mixed $username
     * @param  mixed $mail
     * @param  mixed $password
     * @param  mixed $right
     * @param  mixed $registration_date
     * @return void
     */
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
    
    /**
     * accesseur de l'attribut id
     *
     * @return void
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * setId
     *
     * @param  mixed $id
     * @return void
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    
    /**
     *      * accesseur de l'attribut username

     *
     * @return void
     */
    public function getUsername()
    {
        return $this->username;
    }
    
    /**
     * setUsername
     *
     * @param  mixed $username
     * @return void
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }
    
    /**
     *      * accesseur de l'attribut mail

     *
     * @return void
     */
    public function getMail()
    {
        return $this->mail;
    }
    
    /**
     * setMail
     *
     * @param  mixed $mail
     * @return void
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    }
    
    /**
     *      * accesseur de l'attribut password

     *
     * @return void
     */
    public function getPassword()
    {
        return $this->password;
    }
    
    /**
     * setPassword
     *
     * @param  mixed $password
     * @return void
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }
    
    /**
     *      * accesseur de l'attribut right

     *
     * @return void
     */
    public function getRight()
    {
        return $this->right;
    }
    
    /**
     * setRight
     *
     * @param  mixed $right
     * @return void
     */
    public function setRight($right)
    {
        $this->right = $right;
    }
    
    /**
     *      * accesseur de l'attribut registration_date
     *
     * @return void
     */
    public function getRegistrationDate()
    {
        return $this->registration_date;
    }
    
    /**
     * setRegistrationDate
     *
     * @param  mixed $registration_date
     * @return void
     */
    public function setRegistrationDate($registration_date)
    {
        $this->registration_date = $registration_date;
    }
    
    /**
     *  Fonction permettant de vérifier si le mail saisie est déja inscrit dans la base de données
     *
     * @param  mixed $mail
     * @return false/true
     */
    public static function VerifMail($mail)
    {
        $db = new SQLite3('../data/data.db');
        $sql = $db->prepare("select * from log where mail=?");
        $sql->bindValue(1,$mail);
        $results=$sql->execute();
        if ($results->fetchArray() != null) {
            return false;
          }
        else
        {
            return true;
        }
    }
    
    /**
     * Fonction effectuant une connexion à la base de données et effectue un update
     *
     * @param  mixed $values
     * @return void
     */
    public static function UpdateAccount($values)
    {
        $db = new SQLite3('../data/data.db');
        $sql = $db->prepare("UPDATE log SET username=?,mail=?,password=?,right=?,registration_date=? where id=?");
        $sql->bindValue(1,$values['username']);
        $sql->bindValue(2, $values['mail']);
        $sql->bindValue(3,$values['password']);
        $sql->bindValue(4, $values['right']);
        $sql->bindValue(5,$values['registrationdate']);
        $sql->bindValue(6, $values['userid']);
        $sql->execute();
    }
    
    /**
     * Fonction permettant de supprimer les données de la table log 
     *
     * @param  mixed $userid
     * @return void
     */
    public static function DeleteAccount($userid)
    {
        $db = new SQLite3('../data/data.db');
        $sql = $db->prepare("DELETE FROM log WHERE id=?");
        $sql->bindValue(1,$userid);
        $sql->execute();
    }
    
    /**
     * Fonction permettant de vérifier si le nom d'utilisateur est deja insrit dans la base de données
     *
     * @param  mixed $username
     * @return false/true
     */
    public static function VerifUsername($username)
    {
        $db = new SQLite3('../data/data.db');
        $sql = $db->prepare("select * from log where username=?");
        $sql->bindValue(1,$username);
        $results=$sql->execute();
        if ($results->fetchArray() != null) {
            return false;
          }
        else
        {
            return true;
        }
    }
}

?>