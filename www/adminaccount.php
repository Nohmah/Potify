<?php
session_set_cookie_params(0);
session_start();
require '../model/Log.php';
use Model\Log;
//Connexion à la base de données pour récupérer tous les comptes de la table log.
$con = new SQLite3('../data/data.db');
$sql = 'select * from log;';
$result = $con->query($sql);
$logList = array();
while ($res = $result->fetchArray()) {
  array_push($logList, new Log($res['id'], $res['username'], $res['mail'], $res['password'], $res['right'], $res['registration_date']));

}
ob_start()
  ?>
<!DOCTYPE html>
<html lang="<?php echo substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2); ?>">

<head><!-- Début de l'en tete -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style/bootstrap.css">
  <link rel="stylesheet" href="style/style.css">
  <script src="style/bootstrap.js"></script>
  <script src="style/script.js"></script>
  <title>Gestion des Compte</title>
  <link rel="icon" type="image/x-con" href="./style/logo.png">
</head><!-- Fin de l'en tete -->

<body>
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
  <!-- Titre de la page-->
  <h1 class="text-white">Gestion de Comptes</h1>
  <div class="container">
    <!-- Création tableau-->
    <table class="table table-striped table-dark table-bordered table-respo,s">
      <thead>
        <tr>
          <th>Nom d'Utilisateur</th>
          <th>Mail</th>
          <th>Droit</th>
          <th>Date de Création</th>
          <?php if (@$_SESSION["right"] == "A") { ?>
            <th>Editer</th>
            <th>Supprimer</th>
          <?php } ?>
        </tr>
      </thead>
      <tbody>
      <!-- Utilisation d'une boucle foreach pour afficher tout les comptes dans le tableau en utilisant les accesseurs-->
      <?php foreach ($logList as $log): ?>
        <tr data-href="<?php echo "listaccount.php?userid=" . $log->getId() ?>">
          <td>
            <?php echo $log->getUsername() ?>
          </td>
          <td>
            <?php echo $log->getMail() ?>
          </td>
          <td>
            <?php echo $log->getRight() ?>
          </td>
          <td>
            <?php echo $log->getRegistrationDate() ?>
          </td>
          <!-- Au cas ou un utilisateur tombe sur cette page, les boutons modifier et supprimer sont afficher uniquement si l'utilisateur est un admin-->
          <?php if (@$_SESSION["right"] == "A") { ?>
            <td ><a class="text-white" href="<?php echo "editaccount.php?userid=" . $log->getId() ?>">Editer</a></td>
            <td ><a class="text-danger" href="<?php echo "delete.php?userid=" . $log->getId() ?>">Supprimer</a></td>
          <?php } ?>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <!-- Inclusion du fichier footer.php pour affichier le footer de la page -->
  <?php require './footer.php';?>
</body>

</html>