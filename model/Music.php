<?php

namespace Model;

use SQLite3;

class Music
{
    private $id;
    private $title;
    private $time;
    private $nol;
    private $artist;
    private $genre;    
    private $album;
    private $albumtime;
    private $year;
    private $nom;
    private $BPM;
    private $key;
    private $interpreter;
    private $compositor;
    private $productor;
 

    public function __construct($id, $title, $time, $nol, $artist, $genre, $album, $albumtime, $year, $nom, $BPM, $key, $interpreter, $compositor, $productor)
    {
        $this->id = $id;
        $this->title = $title;
        $this->time = $time;
        $this->nol = $nol;
        $this->artist = $artist;
        $this->genre = $genre;
        $this->album = $album;
        $this->albumtime = $albumtime;
        $this->year = $year;
        $this->nom = $nom;
        $this->BPM = $BPM;
        $this->key = $key;
        $this->interpreter = $interpreter;
        $this->compositor = $compositor;
        $this->productor = $productor;
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
    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getTime()
    {
        return $this->time;
    }

    public function setTime($time)
    {
        $this->time = $time;
    }

    public function getNumberOfListening()
    {
        return $this->nol;
    }
    public function setNumberOfListening($nol)
    {
        $this->nol = $nol;
    }

    public function getArtist()
    {
        return $this->artist;
    }
    public function setArtist($artist)
    {
        $this->artist = $artist;
    }

    public function getGenre()
    {
        return $this->genre;
    }
    public function setGenre($genre)
    {
        $this->genre = $genre;
    }

    public function getAlbum()
    {
        return $this->album;
    }
    public function setAlbum($album)
    {
        $this->album = $album;
    }

    public function getAlbumTime()
    {
        return $this->albumtime;
    }
    public function setAlbumTime($albumtime)
    {
        $this->albumtime = $albumtime;
    }

    public function getYear()
    {
        return $this->year;
    }
    public function setYear($year)
    {
        $this->year = $year;
    }

    public function getNumberOfMusic()
    {
        return $this->nom;
    }
    public function setNumberOfMusic($nom)
    {
        $this->nom = $nom;
    }
    
    public function getBPM()
    {
        return $this->BPM;
    }
    public function setBPM($BPM)
    {
        $this->BPM = $BPM;
    }

    public function getKey()
    {
        return $this->key;
    }
    public function setKey($key)
    {
        $this->key = $key;
    }

    public function getInterpreter()
    {
        return $this->interpreter;
    }
    public function setInterpreter($interpreter)
    {
        $this->interpreter = $interpreter;
    }

    public function getCompositor()
    {
        return $this->compositor;
    }
    public function setCompositor($compositor)
    {
        $this->compositor = $compositor;
    }

    public function getProductor()
    {
        return $this->productor;
    }
    public function setProductor($productor)
    {
        $this->productor = $productor;
    }


    public static function DeleteMusic($id)
    {
        $db = new SQLite3('../data/data.db');
        $sql = $db->prepare("DELETE FROM music WHERE id=?");
        $sql->bindValue(1,$id);
        $sql->execute();
    }

    public static function UpdateMusic($values)
    {
        $db = new SQLite3('../data/data.db');
        $sql = $db->prepare("UPDATE music SET title=?,time=?,nol=?,artist=?,genre=?,album=?,albumtime=?,year=?,nom=?,BPM=?,key=?,interpreter=?,compositor=?,productor=? where id=?");
        $sql->bindValue(1,$values['title']);
        $sql->bindValue(2, $values['time']);
        $sql->bindValue(3,$values['nol']);
        $sql->bindValue(4, $values['artist']);
        $sql->bindValue(5,$values['genre']);
        $sql->bindValue(6, $values['album']);
        $sql->bindValue(7, $values['albumtime']);
        $sql->bindValue(8, $values['year']);
        $sql->bindValue(9, $values['nom']);
        $sql->bindValue(10, $values['BPM']);
        $sql->bindValue(11, $values['key']);
        $sql->bindValue(12, $values['interpreter']);
        $sql->bindValue(13, $values['compositor']);
        $sql->bindValue(14, $values['productor']);
        $sql->bindValue(15, $values['id']);
        $sql->execute();
    }

    public static function AddMusic($values)
    {
        $db = new SQLite3('../data/data.db');
        $sql = $db->prepare("INSERT INTO music(id,title,time,nol,artist,genre,album,albumtime,year,nom,BPM,key,interpreter,compositor,productor) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $sql->reset();
        $sql->bindValue(1,null);
        $sql->bindValue(2,$values['title']);
        $sql->bindValue(3, $values['time']);
        $sql->bindValue(4,$values['nol']);
        $sql->bindValue(5, $values['artist']);
        $sql->bindValue(6,$values['genre']);
        $sql->bindValue(7, $values['album']);
        $sql->bindValue(8, $values['albumtime']);
        $sql->bindValue(9, $values['year']);
        $sql->bindValue(10, $values['nom']);
        $sql->bindValue(11, $values['BPM']);
        $sql->bindValue(12, $values['key']);
        $sql->bindValue(13, $values['interpreter']);
        $sql->bindValue(14, $values['compositor']);
        $sql->bindValue(15, $values['productor']);
        $sql->execute();
    }
}
// faire fonction statique pour supprimer une musique en prenant en parametre l'id de la musique.
?>