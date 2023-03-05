<?php
//faire une connection a la base de données, préparer une requete insert into log, prendre en argument les entrées de l'utilisateur, mettre le U dans right.
//Faire un fichier de validation de la création du compte pour vérifier que l'adresse mail n'est pas déja prise. 
//faire la trad fr 
?>
<!DOCTYPE html>
<html lang="<?php echo substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);?>">

<head><!-- Début de l'en tete -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style/bootstrap.css">
  <link rel="stylesheet" href="style/style.css">
  <script src="style/bootstrap.js"></script>
  <title>Inscription</title>
  <link rel="icon" type="image/x-con" href="./style/logo.png">
</head><!-- Fin de l'en tete -->

<body>
  <!-- Navbar permettant uniquement de renvoyer vers la page d'accueil-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark navbar-inner">
    <div class="container-fluid">
      <a href="./index.php"><img src="./style/logo.png" alt="Logo du site"></a>
      <a class="navbar-brand" href="./index.php">Accueil</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        </ul>
      </div>
    </div>
  </nav>
  <h1 class="text-white">S'inscrire</h1>
  <div class="container registerdiv">
    <!-- Formulaire permettant de s'inscrire et envoie les saisies au fichier validlogin.php -->
    <form action="validregister.php" method="post">
      <div class="form-group">
        <label class="text-white">Email</label>
        <input type="text" class="form-control" placeholder="Votre email" name="mail" required >
        <label class="text-white">Nom d'Utilisateur</label>
        <input type="text" class="form-control" placeholder="Votre nom d'utilisateur" name="username" required >
        <div class="form-group">
          <label class="text-white">Mot de Passe</label>
          <input type="password" class="form-control" id="exampleInputPassword1"
            placeholder="Mot de Passe (+6 caratères)" name="password" required >
        </div>
        <button type="submit" class="btn btn-purple" value="Login">Envoyer</button>
      </div>
    </form>
  </div>
  <?php require './footer.php';?>
</body>

</html>