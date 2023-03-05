<?php
session_set_cookie_params(0);
session_start();
require '../model/Music.php';
use Model\Music;

//effectue une connexion à la base de données et effectue une requête pour récuperer toutes les musiques dans la table music.
$con = new SQLite3('../data/data.db');
$sql = 'select * from music;';
$result = $con->query($sql);
$musicList = array();
while ($res = $result->fetchArray()) {

  array_push(
    $musicList,
    new Music(
      $res['id'], $res['title'], $res['time'], $res['nol'], $res['artist'], $res['genre'], $res['album']
      , $res['albumtime'], $res['year'], $res['nom'], $res['BPM'], $res['key'], $res['interpreter'], $res['compositor'], $res['productor']
    )
  );
}
//session_unset();
ob_start();
?>
<!--Début de la page HTML-->
<!DOCTYPE html>
<html lang="<?php echo substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2); ?>">

<head><!-- Début de l'en tete -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style/bootstrap.css">
  <link rel="stylesheet" href="style/style.css">
  <script src="./style/script.js"></script>
  <script src="style/bootstrap.js"></script>
  <title>Potify</title>
  <link rel="icon" type="image/x-con" href="./style/logo.png">
</head><!-- Fin de l'en tete -->

<body><!-- Début du corps de la page -->
  <!-- Déclaration de la navbar -->
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
                <li class="list-group-item list-group-item-dark"><a class="dropdown-item" href="./index.php">Editer
                    Musique</a></li>
                <li class="list-group-item list-group-item-dark"><a class="dropdown-item" href="./adminaccount.php">Editer
                    Compte</a></li>
                <li class="list-group-item list-group-item-dark"><a class="dropdown-item" href="./addmusic.php">Ajouter
                    Musique</a></li>
              </ul>
            </li>
          <?php } ?>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Fin navbar -->
  <br>
  <!-- Titre de la page affiché sur la page -->
  <h1 class="text-white">Playlist</h1>
  <div class="container">
    <!-- Si l'utilisateur est un administrateur alors un bouton ajouter musique apparait-->
    <?php if (@$_SESSION["right"] == "A") { ?>
      <div class="container d-flex justify-content-center">
        <button class=" btn btn-purple" onclick="window.location.href = './addmusic.php';">Ajouter Musique</button>
      </div>
    <?php } ?>
    <!-- Début tableau -->
    <table class="table table-striped table-dark table-bordered">
      <thead>
        <tr>
          <th>Titre</th>
          <th>Temps</th>
          <th>Nombre d'écoutes</th>
          <th>Artiste</th>
          <th>Album</th>
          <th>Genre</th>
          <th>Année</th>
          <!-- Si admin, deux colonnes en plus pour modifier et supprimer les musiques -->
          <?php if (@$_SESSION["right"] == "A") { ?>
            <th>Editer</th>
            <th>Supprimer</th>
          <?php } ?>
        </tr>
      </thead>
      <tbody>
        <!-- Utilisation d'une boucle  foreach pour afficher chaque musique dans le tableau -->
        <!-- Pour afficher chaque musique à l'aide du fichier contenant la classe Music on utilise les accesseurs-->
        <?php foreach ($musicList as $music): ?>
          <tr data-href="<?php echo "product.php?id=" . $music->getId() ?>">
            <td class="music-title">
              <?php echo $music->getTitle() ?>
            </td>
            <td>
              <?php echo $music->getTime() ?>
            </td>
            <td class="td">
              <?php echo $music->getNumberOfListening() ?>
            </td>
            <td>
              <?php echo $music->getArtist() ?>
            </td>
            <td>
              <?php echo $music->getAlbum() ?>
            </td>
            <td>
              <?php echo $music->getGenre() ?>
            </td>
            <td>
              <?php echo $music->getYear() ?>
            </td>
            <!-- Si admin, deux boutons apparaissent : modifer et supprimer-->
            <?php if (@$_SESSION["right"] == "A") { ?>
              <td><a class="text-white btn btn-purple"
                  href="<?php echo "edit.php?id=" . $music->getId() ?>">Editer</a></td>
              <td><a class="text-white btn btn-danger"
                  href="<?php echo "delete.php?id=" . $music->getId() ?>">Supprimer</a></td>
            <?php } ?>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <!-- Inclusion du ficher footer.php pour afficher le footer de ma page-->
  <?php include "./footer.php"; ?>
</body>

</html>