<?php
session_set_cookie_params(0);
session_start();
ob_start();
require '../model/Log.php';
use Model\Log;

?>
<!DOCTYPE html>
<html lang="<?php echo substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);?>">

<head><!-- Début de l'en tete -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style/bootstrap.css">
  <link rel="stylesheet" href="style/style.css">
  <script src="style/bootstrap.js"></script>
  <title>Validation d'Inscription</title>
  <link rel="icon" type="image/x-con" href="./style/logo.png">
</head><!-- Fin de l'en tete -->

<body>
  <?php
  //recupère les saisies de l'utilisateur envoyées avec la méthode POST
  $mail = @$_POST["mail"];
  $username = @$_POST["username"];
  $password = @$_POST["password"];
//étapes pour proteger la base de données contre les injections sql 
  $username = str_replace("'", "", $username);
  $password = str_replace("'", "", $password);
  $mail = str_replace("'", "", $mail);
  $db = new SQLite3('../data/data.db');
  //Si la fonction renvoie False alors l'inscription est impossible.
  if (Log::VerifMail($mail) == False) { ?>
    <div class="container d-flex justify-content-center div">
      <h2 class="text-white">L'adresse mail est déja utilisé.</h2>
    </div>

    <?php
    header("refresh:2;url=./register.php");
    exit;
  }//De meme pour la fonction VerifUsername
  if (Log::VerifUsername($username) == False) { ?>
    <div class="container d-flex justify-content-center div">
      <h2 class="text-white">Le nom d'utilisateur est déja utilisé.</h2>
    </div>

    <?php
    header("refresh:2;url=./register.php");
    exit;
  }// vérifie que le mot de passe est supérieur à 6 caractères
  if (strlen($password) <= 6) {
    header("refresh:2;url=./register.php");
    ?>
    <div class="container d-flex justify-content-center div">
      <h2 class="text-white">Veuillez saisir un mot de passe de plus de 6 caratères.</h2>
    </div>
    <?php
    exit;
  }//vérification des saisies
  if (!preg_match("/^[a-zA-Z-0-9'\s]+$/", $username)) {
    header("refresh:2;url=./register.php"); ?>
    <div class="container d-flex justify-content-center div">
      <h2 class="text-white">Le nom d'utilisateur n'est pas valide.</h2>
    </div>
    <?php exit;
  }
  if (!preg_match("/^[a-zA-Z-0-9 .'@\s]+$/", $mail)) {
    header("refresh:2;url=./register.php"); ?>
    <div class="container d-flex justify-content-center div">
      <h2 class="text-white">L'adresse email n'est pas valide.</h2>
    </div>
    <?php
    exit;
  }
  //connexion à la base de données pour rajouter les saisies en tant que nouvel utilisateur
  $db = new SQLite3('../data/data.db');
  $sql = $db->prepare("INSERT INTO log(id,username,mail,password,right) VALUES(?,?,?,?,?);");
  $sql->bindValue(1, null);
  $sql->bindValue(2, $username);
  $sql->bindValue(3, $mail);
  $sql->bindValue(4, $password);
  $sql->bindValue(5, "U");
  $sql->execute();

  $idrequest = 'select max(id) from log';
  $result = $db->query($idrequest);
  while ($res = $result->fetchArray()) {
    $userid = $res['max(id)'];
  }
//passage en session du nom d'utilisateur, le droit et l'id de l'utilisateur
  $_SESSION["username"] = $username;
  $_SESSION["right"] = "U";
  $_SESSION["userid"] = $userid;
  header("refresh:3;url=./index.php"); ?>

  <div class="container d-flex justify-content-center div">
    <h2 class="text-white">Inscription reussite ! Retour à la page d'accueil</h2>
  </div>
  </div>
</body>

</html>