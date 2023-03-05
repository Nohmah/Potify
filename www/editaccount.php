<?php
session_set_cookie_params(0);
session_start();
require '../model/Log.php';
use Model\Log;
//Connexion à la base de données pour récupérer tous les informations du compte dont l'id est renseigné en GET ,depuis la table log.

$con = new SQLite3('../data/data.db');
$sql = $con->prepare('SELECT * from log where id=?');
$sql->bindValue(1, $_GET['userid']);
$results = $sql->execute();
$logelements = array();
while ($res = $results->fetchArray()) {
    array_push(
        $logelements,
        new Log($res['id'], $res['username'], $res['mail'], $res['password'], $res['right'], $res['registration_date'])
    );
} ?>
<!DOCTYPE html>
<html lang="<?php echo substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);?>">

<head><!-- Début de l'en tete -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style/bootstrap.css">
    <link rel="stylesheet" href="style/style.css">
    <script src="style/bootstrap.js"></script>
    <title>Edit</title>
    <link rel="icon" type="image/x-con" href="./style/logo.png">
</head><!-- Fin de l'en tete -->

<body><!-- Début du corps de la page -->
<!-- Début de ma navbar-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a href="./index.php"><img src="./style/logo.png" alt="Logo du site"></a>
      <?php if (isset($_SESSION["username"])) { ?>
        <a class="navbar-brand" href="./index.php">Bonjour,
          <?php echo $_SESSION["username"] ?>
        </a>
      <?php } else {
        ?>
        <a class="navbar-brand" href="./index.php">Accueil</a>
      <?php } ?>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <!-- Si l'utilisateur la session est vide, alors aucun utilisateur n'est connecter. Cela affiche l'option se connecter-->
            <?php if ($_SESSION == null) { ?>
              <a class="nav-link" href="./login.php">Se Connecter</a>
              <!-- Si l'utilisateur est connecté la session contient ses informations, si la session n'est pas vide alors l'option Mon Compte apparaît-->
            <?php } else { ?>
              <a class="nav-link" href="./account.php">Mon Compte</a>
            <?php } ?>
          </li>
          <!-- Vérifie que l'utilisateur connecter est un Administrateur, si il l'est le panneau d'administration s'affiche-->
          <?php if (@$_SESSION["right"] == "A") { ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                Panneau d'administration
              </a>
              <ul class="dropdown-menu " aria-labelledby="navbarDropdown">
                <li class="list-group-item list-group-item-dark"><a class="dropdown-item" href="./index.php">Editer Musique</a></li>
                <li class="list-group-item list-group-item-dark"><a class="dropdown-item" href="./adminaccount.php">Editer Compte</a></li>
                <li class="list-group-item list-group-item-dark"><a class="dropdown-item" href="./addmusic.php">Ajouter Musique</a></li>
              </ul>
            </li>
          <?php } ?>
        </ul>
      </div>
    </div>
  </nav>
  <!-- fin navbar -->
    <br>
    <!--Si l'utilisateur est un admin alors-->
    <?php if(@$_SESSION["right"] =="A") {?>
    <h1 class="text-white">Compte n°
        <?php echo $_GET['userid'] ?>
    </h1>
    <div class="container">
        <!-- Formulaire pour modifier les infos du compte qui renverra vers le fichier verification.php-->
        <!-- Chaque input est pré-renseigné en utilisant les accesseurs de la classe Log-->
        <form action="verification.php" method="post">
            <div class="row justify-content-center">
                <div class="col-6">
                    <div class="form group">
                        <?php foreach ($logelements as $log) { ?>
                            <div class="form-floating mb-2">
                                <input class="form-control" type="text" name="accountvalues[username]" placeholder="Nom d'Utilisateur"
                                    value="<?php echo $log->getUsername() ?>">
                                <label>Nom d'utilisateur</label>
                            </div>
                            <div class="form-floating mb-2">
                                <input name="accountvalues[mail]" type="text" class="form-control" placeholder="Mail"
                                    value="<?php echo $log->getMail() ?>">
                                <label>Mail</label>
                            </div>
                            <div class="form-floating mb-2">
                                <input name="accountvalues[password]" type="text" class="form-control" placeholder="Mot de Passe"
                                    value="<?php echo $log->getPassword() ?>">
                                <label>Mot de Passe</label>
                            </div>
                            <div class="form-floating mb-2">
                                <input name="accountvalues[right]" type="text" class="form-control" placeholder="Droit"
                                    value="<?php echo $log->getRight() ?>">
                                <label>Droit</label>
                            </div>
                            <div class="form-floating mb-2">
                                <input name="accountvalues[registrationdate]" type="text" class="form-control" placeholder="Date d'inscription"
                                    value="<?php echo $log->getRegistrationDate() ?>">
                                <label>Date d'inscription</label>
                            </div>
                            <div class="form-floating mb-2">
                                <input type="submit" class="btn btn-dark" value="Submit">
                            </div>
                            <input name="accountvalues[userid]" type="hidden" value="<?php echo $_GET['userid'] ?>">
                        <?php } ?>
                    </div>
                </div>
            </div>
        </form>
        <?php }
        else {?>
        <!-- Si l'utilisateur n'est pas un admin alors un message d'erreur saffiche et renvoie l'utilisateur à la page d'accueil-->
        <h2 class="text-white">Vous n'avez pas les permissions pour acceder à cette fonctionnalité</h2>
        <?php } ?>
    </div>
    <?php require './footer.php';?>
</body>

</html>