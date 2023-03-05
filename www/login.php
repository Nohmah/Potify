<!DOCTYPE html>
<html lang="<?php echo substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);?>">

<head><!-- Début de l'en tete -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style/bootstrap.css">
  <link rel="stylesheet" href="style/style.css">
  <script src="style/bootstrap.js"></script>
  <title>Connexion</title>
  <link rel="icon" type="image/x-con" href="./style/logo.png">
</head><!-- Fin de l'en tete -->

<body>
  <!-- Création de la navbar permettant uniquement de retourner à la page d'accueil-->
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
  <!-- -Titre de la page -->
  <h1 class="text-white">Se Connecter</h1>
  <div class="container logdiv">
    <!-- Formulaire pour se connecter renvoyant à la page du fichier validlogin.php-->
    <form action="validlogin.php" method="post">
      <div class="form-group">
        <label class="text-white">Nom d'utilisateur</label>
        <input type="text" class="form-control" placeholder="Entrez votre nom d'utilisateur." name="username" required>
        <div class="form-group">
          <label class="text-white">Mot de Passe</label>
          <input type="password" class="form-control" id="exampleInputPassword1"
            placeholder="Entrez votre mot de Passe." name="password" required>
        </div>
        <button type="submit" class="btn btn-purple" value="Login">Se Connecter</button>
        <!-- Lien renvoyant vers la page d'inscription-->
        <h5 class="text-white"><a class="text-white" href="./register.php">Vous n'avez pas de compte ? Cliquer ici pour
            vous inscrire !</a></h5>
      </div>
    </form>
  </div>
  <?php require './footer.php';?>
</body>

</html>