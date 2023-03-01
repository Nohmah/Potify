<?php
session_set_cookie_params(0);
session_start();
require '../model/Music.php';
use Model\Music;

$con = new SQLite3('../data/data.db');
$sql = 'select * from music;';
$result = $con->query($sql);
$musicList = array();
while ($res = $result->fetchArray()) {

  array_push($musicList, new Music(
    $res['id'], $res['title'], $res['time'], $res['nol'], $res['artist'], $res['genre'], $res['album']
    , $res['albumtime'], $res['year'], $res['nom'], $res['BPM'], $res['key'], $res['interpreter'], $res['compositor'], $res['productor']
  )
  );
}
//session_unset();
ob_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head><!-- Début de l'en tete -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style/bootstrap.css">
  <link rel="stylesheet" href="style/style.css">
  <script src="./style/test.js"></script>
  <script src="style/bootstrap.js"></script>
  <title>Main</title>
</head><!-- Fin de l'en tete -->

<body><!-- Début du corps de la page -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a href="./main.php"><img src="./style/logo.png">
        <?php if (isset($_SESSION["username"])) { ?>
          <a class="navbar-brand" href="./main.php">Bonjour,
            <?php echo $_SESSION["username"] ?>
          </a>
        <?php } else {
          ?>
          <a class="navbar-brand" href="./main.php">Accueil</a>
        <?php } ?>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <?php if ($_SESSION == null) { ?>
                <a class="nav-link" href="./login.php">Se Connecter</a>
              <?php } else { ?>
                <a class="nav-link" href="./account.php?userid=<?php echo $_SESSION["userid"]?>">Mon Compte</a>
              <?php } ?>
            </li>
            <?php if (isset($_SESSION["username"])) {
              ?>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  Mes playlist
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li>
                    <hr class="dropdown-divider">
                  </li>
                  <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
              </li>
            <?php } ?>
          </ul>
          <form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-purple text-white" type="submit">Search</button>
          </form>
        </div>
    </div>
  </nav>
  <br>
  <h1 class="text-white">Playlist</h1>
  <div class="container">
    <?php if (@$_SESSION["right"] == "A") {?>
      <div class="container d-flex justify-content-center">
        <button class=" btn btn-purple" onclick="window.location.href = './addmusic.php';">Add Music</button>
      </div>
    <?php }?>
    <table class="table table-striped table-dark table-bordered table-respo,s">
      <thread>
        <tr>
          <th scope="col">Titre</th>
          <th scope="col">Temps</th>
          <th scope="col">Nombre d'écoutes</th>
          <th scope="col">Artiste</th>
          <th scope="col">Album</th>
          <th scope="col">Genre</th>
          <th scope="col">Année</th>
          <?php if (@$_SESSION["right"] == "A") { ?>
            <th scope="col">Editer</th>
            <th scope="col">Supprimer</th>
          <?php } ?>
        </tr>
      </thread>
      </tbody>
      <?php foreach ($musicList as $music): ?>
        <tr data-href="<?php echo "product.php?id=" . $music->getId() ?>">
          <td>
            <?php echo $music->getTitle() ?>
          </td>
          <td>
            <?php echo $music->getTime() ?>
          </td> 
          <td align="right">
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
          <?php if (@$_SESSION["right"] == "A") { ?>
            <td scope="row"><a class="text-white" href="<?php echo "edit.php?id=" . $music->getId() ?>">Editer</td>
            <td scope="row"><a class="text-danger" href="<?php echo "delete.php?id=" . $music->getId() ?>">Supprimer</td>
              <?php } ?>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</body>

</html>