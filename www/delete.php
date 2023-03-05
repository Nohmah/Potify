<?php
require '../model/Music.php';
require '../model/Log.php';
use Model\Log;
use Model\Music;

session_set_cookie_params(0);
session_start();
//Vérifie si l'utilisateur est un admin, si oui alors la fonction DeleteMusic est activée, l'image et l'audio de la musique sont aussi supprimé avec l'id passé en GET.
if ($_SESSION['right'] == "A") {
  if (isset($_GET['id'])) {
    Music::DeleteMusic($_GET['id']);
    @unlink("./cover/" . $_GET['id'] . ".jpg");
    @unlink("./audio/" . $_GET['id'] . ".mp3");
  }
//Si le paramètre userid est passé en GET alors la fonction DeleteAccount est activé.
  if (isset($_GET['userid'])) {
    Log::DeleteAccount($_GET['userid']);
  }

}
?>
<!--Début de la page-->
<!DOCTYPE html>
<html lang="<?php echo substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2); ?>">

<head><!-- Début de l'en tete -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style/bootstrap.css">
  <link rel="stylesheet" href="style/style.css">
  <script src="style/bootstrap.js"></script>
  <title>Suppression</title>
  <link rel="icon" type="image/x-con" href="./style/logo.png">
</head><!-- Fin de l'en tete -->

<body>
  <!-- Si le paramètre id est renseigné en GET alors affiche un message de confirmation de la suppression de la musique-->
  <?php if (isset($_GET['id'])) { ?>
    <div class="container d-flex justify-content-center div">
      <h2 class="text-white">Musique Supprimée</h2>
    </div>
    <!--Renvoie l'utilisateur vers la page d'accueil -->
  <?php header("refresh:2;url=./index.php");
} else { ?>
<!-- Sinon affiche que le compte à bien été supprimé-->
    <div class="container d-flex justify-content-center div">
      <h2 class="text-white">Compte Supprimé</h2>
    </div>
  <?php
  //Renvoie l'utilisateur vers la page du fichier adminaccount.php
  header("refresh:2;url=./adminaccount.php");
 } ?>
 <!-- Si l'utilisateur n'est pas admin un message d'erreur s'affiche et l'utilisateur est renvoyé à la page d'accueil-->
  <?php if ($_SESSION['right'] != "A") {
    header("refresh:2;url=./index.php");
    ?>
    <div class="container d-flex justify-content-center div">
      <h2 class="text-white">Vous n'avez pas les droits pour effecter cette action</h2>
    </div>
    <?php
  }
  ?>
</body>

</html>