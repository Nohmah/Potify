<?php
require '../model/Music.php';
use Model\Music;
ob_start();
$lang = "fr";
//include 'translate_'.$lang.'.php';
$values=$_POST['values'];
/*$title = $_POST['title'];
$time = $_POST['time'];
$nol = $_POST['nol'];
$artist = $_POST['artist'];
$genre = $_POST['genre'];
$id = $_POST['id'];
$album = $_POST['album'];
$albumtime = $_POST['albumtime'];
$year = $_POST['year'];
$nom = $_POST['nom'];
$BPM = $_POST['BPM'];
$key = $_POST['key'];
$interpreter = $_POST['interpreter'];
$compositor = $_POST['compositor'];
$productor = $_POST['productor'];*/


if (
    empty($values['title']) || empty($values['time']) || empty($values['nol']) ||empty($values['artist']) || 
    empty($values['genre']) || empty($values['album']) ||empty($values['albumtime']) || 
    empty($values['year']) || empty($values['nom']) ||empty($values['BPM']) || empty($values['key']) || 
    empty($values['interpreter']) || empty($values['compositor']) || empty($values['productor'])
) {
    echo "Please fill all fields"; 
    exit;
}
// check if name field is valid
if (!preg_match("/^[a-zA-Z-()'\s]+$/",$values['title'])) {
    echo "title field is not valid.";
    exit;
}
// check if time field is valid
if (!preg_match("/^[0-9:]+$/", $values['time'])) {
    echo "time field is not valid.";
    exit;
}
if (!preg_match("/^[0-9 ]+$/", $values['nol'])) {
    echo "nol field is not valid.";
    exit;
}
if (!preg_match("/^[a-zA-Z-,'\s]+$/", $values['artist'])) {
    echo "artist field is not valid.";
    exit;
}
if (!preg_match("/^[a-zA-Z-'\s]+$/", $values['genre'])) {
    echo "genre field is not valid.";
    exit;
}
if (!preg_match("/^[a-zA-Z-'\s]+$/", $values['album'])) {
    echo "album field is not valid.";
    exit;
}
if (!preg_match("/^[0-9:]+$/", $values['albumtime'])) {
    echo "albumtime field is not valid.";
    exit;
}
// check if year field is valid
if (!preg_match("/^[0-9]+$/", $values['year'])) {
    echo "Year field is not valid.";
    exit;
}
if (!preg_match("/^[0-9]+$/", $values['nom'])) {
    echo "nom field is not valid.";
    exit;
}
if (!preg_match("/^[0-9]+$/", $values['BPM'])) {
    echo "bpm field is not valid.";
    exit;
}
if (!preg_match("/^[a-zA-Z-'\W\s]+$/", $values['key'])) {
    echo "key field is not valid.";
    exit;
}
if (!preg_match("/^[a-zA-Z-'\W\s]+$/", $values['interpreter'])) {
    echo "interpreter field is not valid.";
    exit;
}
if (!preg_match("/^[a-zA-Z-'\W\s]+$/", $values['compositor'])) {
    echo "compositor field is not valid.";
    exit;
}
if (!preg_match("/^[a-zA-Z-'\W\s]+$/", $values['productor'])) {
    echo "productor field is not valid.";
    exit;
}

if(isset($values['id']))
{
    Music::UpdateMusic($values);
    echo "Music was successfully edited!";
    header("refresh:2; url=./main.php");
}
else
{
    Music::AddMusic($values);
    echo"Music was successfully added!";
    //header("refresh:2;url=./main.php");
}
var_dump($_FILES);
if (isset($_FILES['fichier'])) {
 //création de deux variables : l'une récupérant le fichier l'autre prend pour valeur le chemin du dossier uploads.


$chemin_temp = $_FILES['fichier']['tmp_name'];
$con = new SQLite3('../data/data.db');
$sql = 'select max(id) from music';
$result = $con->query($sql);
while ($res = $result->fetchArray()) {
    $newid=$res['max(id)'];
}

$chemin_dest = "./cover/" .$newid .  ".jpg";
//Si un fichier et stocké dans le répertoire uploads alors
//Télécharge le fichier et le déplace dans le repertoire uploads.
move_uploaded_file($chemin_temp, $chemin_dest);
}

if (isset($_FILES['fichieraudio'])) {
    //création de deux variables : l'une récupérant le fichier l'autre prend pour valeur le chemin du dossier uploads.
   
   
   $chemin_temp = $_FILES['fichieraudio']['tmp_name'];
   $con = new SQLite3('../data/data.db');
   $sql = 'select max(id) from music';
   $result = $con->query($sql);
   while ($res = $result->fetchArray()) {
       $newid=$res['max(id)'];
   }
   
   $chemin_dest = "./audio/" .$newid .  ".mp3";
   //Si un fichier et stocké dans le répertoire uploads alors
   //Télécharge le fichier et le déplace dans le repertoire uploads.
   move_uploaded_file($chemin_temp, $chemin_dest);
}
?>