<?php
require '../model/Music.php';
use Model\Music;
session_set_cookie_params(0);
session_start();
header("refresh:0.1;url=./main.php");

Music::DeleteMusic($_GET['id']);
unlink("./cover/" . $_GET['id'] . ".jpg");

?>
<!DOCTYPE html lang="fr">
<html>

<head><!-- Début de l'en tete -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style/bootstrap.css">
  <link rel="stylesheet" href="style/style.css">
  <script src="style/bootstrap.js"></script>
  <title>Delete Music</title>
</head><!-- Fin de l'en tete -->

<body>
    <div class="container d-flex justify-content-center div">
        <h2 class="text-white">Music Deleted</h2>
    </div>
</body>

</html>