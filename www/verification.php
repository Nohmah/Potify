<?php
require '../model/Music.php';
require '../model/Log.php';
use Model\Log;
use Model\Music;
ob_start();
@$values=$_POST['values']; 
@$accountvalues=$_POST['accountvalues'];
?>
<!DOCTYPE html>
<html lang="<?php echo substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);?>">

<head><!-- Début de l'en tete -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style/bootstrap.css">
  <link rel="stylesheet" href="style/style.css">
  <script src="style/bootstrap.js"></script>
  <title>Verification</title>
  <link rel="icon" type="image/x-con" href="./style/logo.png">
</head><!-- Fin de l'en tete -->
<body>
<?php
//Vérification de chaque valeurs, affiche un message d'erreur si la valeur saisie est invalide ou si aucune saisie n'a été renseignée.
//vérifie que toute les valeurs soient saisies
if ($values != null)
{
if (
    empty($values['title']) || empty($values['time']) || empty($values['nol']) ||empty($values['artist']) || 
    empty($values['genre']) || empty($values['album']) ||empty($values['albumtime']) || 
    empty($values['year']) || empty($values['nom']) ||empty($values['BPM']) || empty($values['key']) || 
    empty($values['interpreter']) || empty($values['compositor']) || empty($values['productor'])
) { ?>
    <div class="container d-flex justify-content-center div">
        <h2 class="text-white">Veuillez remplir tout les champs.</h2>
    </div>
<?php
    exit;
}
// Vérifie que le champs Titre est valide
if (!preg_match("/^[a-zA-Z-0-9'\W\s]+$/",$values['title'])) { ?>
    <div class="container d-flex justify-content-center div">
        <h2 class="text-white">Le champs Titre est invalide.</h2>
    </div>
<?php
    exit;
}
// Verifie que le champs Durée est valide
if (!preg_match("/^[0-9:]+$/", $values['time'])) { ?>
    <div class="container d-flex justify-content-center div">
        <h2 class="text-white">Le champs Durée est invalide.</h2>
</div>
<?php
    exit;
}
//Vérifie que le champs Nombre d'écoute est valide
if (!preg_match("/^[0-9 ]+$/", $values['nol'])) { ?>
        <div class="container d-flex justify-content-center div">
        <h2 class="text-white">Le champs Nombre d'écoute est invalide.</h2>
    </div>
<?php
    exit;
}
//Vérifie que le champs Artiste est valide
if (!preg_match("/^[a-zA-Z-0-9'\W\s]+$/", $values['artist'])) { ?>
        <div class="container d-flex justify-content-center div">
        <h2 class="text-white">Le champs Artiste est invalide.</h2>
    </div>
<?php
    exit;
}
//Vérifie que le champs Genre est valide
if (!preg_match("/^[a-zA-Z- '\s]+$/", $values['genre'])) { ?>
        <div class="container d-flex justify-content-center div">
        <h2 class="text-white">Le champs Genre est invalide.</h2>
    </div>
<?php
    exit;
}
//Vérifie que le champs Album est valide
if (!preg_match("/^[a-zA-Z-0-9'\W\s]+$/", $values['album'])) { ?>
        <div class="container d-flex justify-content-center div">
        <h2 class="text-white">Le champs Album est invalide.</h2>
    </div>
<?php
    exit;
}
//Vérifie que le champs Durée Album est valide

if (!preg_match("/^[0-9:]+$/", $values['albumtime'])) { ?>
    <div class="container d-flex justify-content-center div">
        <h2 class="text-white">Le champs Durée Album est invalide.</h2>
    </div>
<?php
    exit;
}
//Vérifie que le champs Année est valide
if (!preg_match("/^[0-9]+$/", $values['year'])) { ?>
    <div class="container d-flex justify-content-center div">
        <h2 class="text-white">Le champs Année est invalide.</h2>
    </div><?php
    exit;
}
//Vérifie que le champs Nombre de Musique est valide
if (!preg_match("/^[0-9]+$/", $values['nom'])) { ?>
    <div class="container d-flex justify-content-center div">
        <h2 class="text-white">Le champs Nombre de Musique est invalide.</h2>
    </div><?php
    exit;
}
//Vérifie que le champs BPM est valide
if (!preg_match("/^[0-9]+$/", $values['BPM'])) { ?>
    <div class="container d-flex justify-content-center div">
        <h2 class="text-white">Le champs BPM est invalide.</h2>
    </div><?php
    exit;
}
//Vérifie que le champs Note est valide
if (!preg_match("/^[a-zA-Z-'\W\s]+$/", $values['key'])) { ?>
    <div class="container d-flex justify-content-center div">
        <h2 class="text-white">Le champs Note est invalide.</h2>
    </div><?php
    exit;
}
//Vérifie que le champs Interprète est valide
if (!preg_match("/^[a-zA-Z-0-9'\W\s]+$/", $values['interpreter'])) { ?>
    <div class="container d-flex justify-content-center div">
        <h2 class="text-white">Le champs Interpète est invalide.</h2>
    </div><?php
    exit;
}
//Vérifie que le champs Compositeur est valide
if (!preg_match("/^[a-zA-Z-0-9'\W\s]+$/", $values['compositor'])) { ?>
    <div class="container d-flex justify-content-center div">
        <h2 class="text-white">Le champs Compositeur est invalide.</h2>
    </div><?php
    exit;
}
//Vérifie que le champs Producteur est valide
if (!preg_match("/^[a-zA-Z-0-9'\W\s]+$/", $values['productor'])) { ?>
    <div class="container d-flex justify-content-center div">
        <h2 class="text-white">Le champs Producteur est invalide.</h2>
    </div><?php
    exit;
}
//Vérifie si un id est renseigné, si oui alors la musique est mise à jour sinon elle est crée
if(isset($values['id']))
{
    Music::UpdateMusic($values); ?>
    <div class="container d-flex justify-content-center div">
    <h2 class="text-white">La musique à bien été mise à jour !</h2>
</div>
    <?php 
    unlink("./cover/" . $values['id'] . ".jpg");
    unlink("./audio/". $values['id'].".mp3");
    header("refresh:2; url=./product.php?id=" . $values['id']);
//Si un fichier est renseigné alors met à jour l'image de l'album
    if (isset($_FILES['fichier'])) {
        //création de deux variables : l'une récupérant le fichier l'autre prend pour valeur le chemin du dossier uploads.
       
       
       $chemin_temp = $_FILES['fichier']['tmp_name'];
       $chemin_dest = "./cover/" .$values['id'] .  ".jpg";
       //Si un fichier et stocké dans le répertoire uploads alors
       //Télécharge le fichier et le déplace dans le repertoire uploads.
       move_uploaded_file($chemin_temp, $chemin_dest);
       }
//Si fichieraudio est renseigné alors met à jour l'audio de la musique      
       if (isset($_FILES['fichieraudio'])) {
           //création de deux variables : l'une récupérant le fichier l'autre prend pour valeur le chemin du dossier uploads.
          
          
          $chemin_temp = $_FILES['fichieraudio']['tmp_name'];         
          $chemin_dest = "./audio/" .$values['id'] .  ".mp3";
          //Si un fichier et stocké dans le répertoire uploads alors
          //Télécharge le fichier et le déplace dans le repertoire uploads.
          move_uploaded_file($chemin_temp, $chemin_dest);
       }
}
//Si aucun id est renseigné alors ajoute la musiaue à la base de données
else
{
    Music::AddMusic($values); ?>
            <div class="container d-flex justify-content-center div">
            <h2 class="text-white">La musique à été ajoutée !</h2>
    </div>
    <?php header("refresh:2;url=./index.php");
}
//Meme procédure des fichiers mais ne remplace pas, seulement ajoute au dossier audio et cover
if (isset($_FILES['fichier'])) {
 //création de deux variables : l'une récupérant le fichier l'autre prend pour valeur le chemin du dossier cover.

//Selectionne le dernier id renseigné dans la table music et stocke la valeur dans une variable newid
$chemin_temp = $_FILES['fichier']['tmp_name'];
$con = new SQLite3('../data/data.db');
$sql = 'select max(id) from music';
$result = $con->query($sql);
while ($res = $result->fetchArray()) {
    $newid=$res['max(id)'];
}
//utilisation de la variable newid pour nommer le fichier.
$chemin_dest = "./cover/" .$newid .  ".jpg";
move_uploaded_file($chemin_temp, $chemin_dest);
}

if (isset($_FILES['fichieraudio'])) {
    //création de deux variables : l'une récupérant le fichier l'autre prend pour valeur le chemin du dossier audio.
   
   
   $chemin_temp = $_FILES['fichieraudio']['tmp_name'];
   $con = new SQLite3('../data/data.db');
   $sql = 'select max(id) from music';
   $result = $con->query($sql);
   while ($res = $result->fetchArray()) {
       $newid=$res['max(id)'];
   }
   
   $chemin_dest = "./audio/" .$newid .  ".mp3";
   move_uploaded_file($chemin_temp, $chemin_dest);
}
}
//Vérifie si la variable $accountvalues qui récupère les saisies de l'administrateur de la page editaccount.php n'est pas null, 
//si elle ne l'est pas le code effectue les vérifications pour les modifications de compte.
if ($accountvalues != null)
{
    if (
        empty($accountvalues['username']) || empty($accountvalues['mail']) || empty($accountvalues['password']) ||empty($accountvalues['right']) || 
        empty($accountvalues['registrationdate']) 
    ) { ?>
        <div class="container d-flex justify-content-center div">
            <h2 class="text-white">Veuillez remplir tout les champs.</h2>
        </div>
    <?php
        exit;
    }
    // Vérifie que le champs Nom d'Utilisateur est valide
    if (!preg_match("/^[a-zA-Z-()'\s]+$/",$accountvalues['username'])) { ?>
        <div class="container d-flex justify-content-center div">
            <h2 class="text-white">Le champs Nom d'Utilisateur est invalide.</h2>
        </div>
    <?php
        exit;
    }
    // Verifie que le champs Durée est valide
    if (!preg_match("/^[a-zA-Z-0-9'@.\s]+$/", $accountvalues['mail'])) { ?>
        <div class="container d-flex justify-content-center div">
            <h2 class="text-white">Le champs Mail est invalide.</h2>
    </div>
    <?php
        exit;
    }
    //Vérifie que le champs Mot de Passe est valide
    if (!preg_match("/^[a-zA-Z-0-9'\W\s]+$/", $accountvalues['password'])) { ?>
            <div class="container d-flex justify-content-center div">
            <h2 class="text-white">Le champs Mot de Passe est invalide.</h2>
        </div>
    <?php
        exit;
    }
    //Vérifie que le champs Droit est valide
    if (!preg_match("/^[a-zA-Z-,'\s]+$/", $accountvalues['right'])) { ?>
            <div class="container d-flex justify-content-center div">
            <h2 class="text-white">Le champs Droit est invalide.</h2>
        </div>
    <?php
        exit;
    }
    //Vérifie que le champs Date d'Inscription est valide
    if (!preg_match("/^[a-zA-Z-0-9'\W\s]+$/", $accountvalues['registrationdate'])) { ?>
                <div class="container d-flex justify-content-center div">
            <h2 class="text-white">Le champs Date d'Inscription est invalide.</h2>
        </div>
    <?php
        exit;
    }
//Si les saisies ont passées les vérifications, les données du compte sont mise à jour avec la fonction statique UpdateAccount
    Log::UpdateAccount($accountvalues); ?>
    <div class="container d-flex justify-content-center div">
    <h2 class="text-white">Le compte à bien été mis à jour !</h2>
</div>
<?php
//Une fois les modifications efféctuées, l'admin est renvoyer à la liste des comptes.
header("refresh:2;url=./adminaccount.php");
}
?>
</body>
</html>