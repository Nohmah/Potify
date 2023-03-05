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
 
    
    /**
     * Constructeur de la classe Music
     *
     * @param  mixed $id
     * @param  mixed $title
     * @param  mixed $time
     * @param  mixed $nol
     * @param  mixed $artist
     * @param  mixed $genre
     * @param  mixed $album
     * @param  mixed $albumtime
     * @param  mixed $year
     * @param  mixed $nom
     * @param  mixed $BPM
     * @param  mixed $key
     * @param  mixed $interpreter
     * @param  mixed $compositor
     * @param  mixed $productor
     * @return void
     */
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
    /**
     *      * accesseur de l'attribut id
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
     * accesseur de l'attribut title
     *
     * @return void
     */
    public function getTitle()
    {
        return $this->title;
    }
    
    /**
     * setTitle
     *
     * @param  mixed $title
     * @return void
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }
    
    /**
     * accesseur de l'attribut time
     *
     * @return void
     */
    public function getTime()
    {
        return $this->time;
    }
    
    /**
     * setTime
     *
     * @param  mixed $time
     * @return void
     */
    public function setTime($time)
    {
        $this->time = $time;
    }
    
    /**
     * accesseur de l'attribut nol
     *
     * @return void
     */
    public function getNumberOfListening()
    {
        return $this->nol;
    }    
    /**
     * setNumberOfListening
     *
     * @param  mixed $nol
     * @return void
     */
    public function setNumberOfListening($nol)
    {
        $this->nol = $nol;
    }
    
    /**
     * accesseur de l'attribut artist
     *
     * @return void
     */
    public function getArtist()
    {
        return $this->artist;
    }    
    /**
     * setArtist
     *
     * @param  mixed $artist
     * @return void
     */
    public function setArtist($artist)
    {
        $this->artist = $artist;
    }
    
    /**
     * accesseur de l'attribut genre
     *
     * @return void
     */
    public function getGenre()
    {
        return $this->genre;
    }    
    /**
     * setGenre
     *
     * @param  mixed $genre
     * @return void
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;
    }
    
    /**
     * accesseur de l'attribut album
     *
     * @return void
     */
    public function getAlbum()
    {
        return $this->album;
    }    
    /**
     * setAlbum
     *
     * @param  mixed $album
     * @return void
     */
    public function setAlbum($album)
    {
        $this->album = $album;
    }
    
    /**
     * accesseur de l'attribut albumtime
     *
     * @return void
     */
    public function getAlbumTime()
    {
        return $this->albumtime;
    }    
    /**
     * setAlbumTime
     *
     * @param  mixed $albumtime
     * @return void
     */
    public function setAlbumTime($albumtime)
    {
        $this->albumtime = $albumtime;
    }
    
    /**
     * accesseur de l'attribut year
     *
     * @return void
     */
    public function getYear()
    {
        return $this->year;
    }    
    /**
     * setYear
     *
     * @param  mixed $year
     * @return void
     */
    public function setYear($year)
    {
        $this->year = $year;
    }
    
    /**
     * accesseur de l'attribut nom
     *
     * @return void
     */
    public function getNumberOfMusic()
    {
        return $this->nom;
    }    
    /**
     * setNumberOfMusic
     *
     * @param  mixed $nom
     * @return void
     */
    public function setNumberOfMusic($nom)
    {
        $this->nom = $nom;
    }
        
    /**
     * accesseur de l'attribut BPM
     *
     * @return void
     */
    public function getBPM()
    {
        return $this->BPM;
    }    
    /**
     * setBPM
     *
     * @param  mixed $BPM
     * @return void
     */
    public function setBPM($BPM)
    {
        $this->BPM = $BPM;
    }
    
    /**
     * accesseur de l'attribut key
     *
     * @return void
     */
    public function getKey()
    {
        return $this->key;
    }    
    /**
     * setKey
     *
     * @param  mixed $key
     * @return void
     */
    public function setKey($key)
    {
        $this->key = $key;
    }
    
    /**
     * accesseur de l'attribut interpreter
     *
     * @return void
     */
    public function getInterpreter()
    {
        return $this->interpreter;
    }    
    /**
     * setInterpreter
     *
     * @param  mixed $interpreter
     * @return void
     */
    public function setInterpreter($interpreter)
    {
        $this->interpreter = $interpreter;
    }
    
    /**
     * accesseur de l'attribut compositor
     *
     * @return void
     */
    public function getCompositor()
    {
        return $this->compositor;
    }    
    /**
     * setCompositor
     *
     * @param  mixed $compositor
     * @return void
     */
    public function setCompositor($compositor)
    {
        $this->compositor = $compositor;
    }
    
    /**
     * accesseur de l'attribut productor
     *
     * @return void
     */
    public function getProductor()
    {
        return $this->productor;
    }    
    /**
     * setProductor
     *
     * @param  mixed $productor
     * @return void
     */
    public function setProductor($productor)
    {
        $this->productor = $productor;
    }

    
    /**
     * Fonction permettant de supprimer une musique dans la base de données
     *
     * @param  mixed $id
     * @return void
     */
    public static function DeleteMusic($id)
    {
        $db = new SQLite3('../data/data.db');
        $sql = $db->prepare("DELETE FROM music WHERE id=?");
        $sql->bindValue(1,$id);
        $sql->execute();
    }
    
    /**
     * fonction mettant à jour une musique dans la base de données
     *
     * @param  mixed $values
     * @return void
     */
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
    
    /**
     * Fonction permettant d'ajouter une musique dans la base de données
     *
     * @param  mixed $values
     * @return void
     */
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
?>
