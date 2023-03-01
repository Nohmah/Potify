<?php
session_set_cookie_params(0);
session_start();
header("refresh:1;url=./main.php");
session_destroy();
?>
<!DOCTYPE html lang="fr">
<html>

<head><!-- Début de l'en tete -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style/bootstrap.css">
  <link rel="stylesheet" href="style/style.css">
  <script src="style/bootstrap.js"></script>
  <title>Logout</title>
</head><!-- Fin de l'en tete -->

<body>
    <div class="container d-flex justify-content-center div">
        <h2 class="text-white">Vous avez été déconnecté. Retour à la page d'accueil</h2>
    </div>
</body>

</html>