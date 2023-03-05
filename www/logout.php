<?php
session_set_cookie_params(0);
session_start();
//renvoie l'utilisateur sur la page d'accueil et supprime les sessions.
header("refresh:1;url=./index.php");
session_destroy();
?>
<!DOCTYPE html>
<html lang="<?php echo substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);?>">

<head><!-- Début de l'en tete -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style/bootstrap.css">
  <link rel="stylesheet" href="style/style.css">
  <script src="style/bootstrap.js"></script>
  <title>Déconnexion</title>
  <link rel="icon" type="image/x-con" href="./style/logo.png">
</head><!-- Fin de l'en tete -->

<body>
    <div class="container d-flex justify-content-center div">
        <h2 class="text-white">Vous avez été déconnecté. Retour à la page d'accueil</h2>
    </div>
</body>

</html>