<?php
session_set_cookie_params(0);
session_start();
require '../model/Music.php';
use Model\Music;

$con = new SQLite3('../data/data.db');
$sql = $con->prepare('SELECT * from music where id=?');
$sql->bindValue(1, $_GET['id']);
$results = $sql->execute();
$musicelements = array();
while ($res = $results->fetchArray()) {
  array_push($musicelements, new Music(
    $res['id'], $res['title'], $res['time'], $res['nol'], $res['artist'], $res['genre'], $res['album']
    , $res['albumtime'], $res['year'], $res['nom'], $res['BPM'], $res['key'], $res['interpreter'], $res['compositor'], $res['productor']
  )
  );
}
?>
<!DOCTYPE html lang="fr">
<html>

<head><!-- Début de l'en tete -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style/bootstrap.css">
  <link rel="stylesheet" href="style/style.css">
  <script src="style/bootstrap.js"></script>
  <title>Main</title>
</head><!-- Fin de l'en tete -->

<body class="body"><!-- Début du corps de la page -->
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
                <a class="nav-link" href="./account.php">Mon Compte</a>
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
            <button class="btn btn-outline-purple" type="submit">Search</button>
          </form>
        </div>
    </div>
  </nav>
  <br>
  <h1 class="text-white" align="center">Music n°
    <?php echo $_GET['id'] ?>
  </h1>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-6">
        <img src="./cover/<?php echo $_GET['id'] ?>.jpg" width="500" height="500" alt="Album Cover">
        <div align="center">
          <audio controls>
            <source src="./audio/<?php echo $_GET['id'] ?>.mp3" type="audio/mpeg">
          </audio>
        </div>
      </div>
      <div class="col-6">
        <div class="container">
          <table class="table table-striped table-dark">
            </tbody>
            <?php foreach ($musicelements as $music): ?>
              <tr class="tableproduct">
                <th scope="col">Title</th>
                <td>
                  <?php echo $music->getTitle() ?>
                </td>
              </tr>

              <tr class="tableproduct">
                <th scope="col">Time</th>
                <td>
                  <?php echo $music->getTime() ?>
                </td>
              </tr>

              <tr>
                <th scope="col">Number Of Listening</th>
                <td>
                  <?php echo $music->getNumberOfListening() ?>
                </td>
              </tr>

              <tr>
                <th scope="col">Artist</th>
                <td>
                  <?php echo $music->getArtist() ?>
                </td>
              </tr>

              <tr>
                <th scope="col">Genre</th>
                <td>
                  <?php echo $music->getGenre() ?>
                </td>
              </tr>

              <tr>
                <th scope="col">Album</th>
                <td>
                  <?php echo $music->getAlbum() ?>
                </td>
              </tr>

              <tr>
                <th scope="col">Album Time</th>
                <td>
                  <?php echo $music->getAlbumTime() ?>
                </td>
              </tr>

              <tr>
                <th scope="col">Year</th>
                <td>
                  <?php echo $music->getYear() ?>
                </td>
              </tr>

              <tr>
                <th scope="col">Number of Music</th>
                <td>
                  <?php echo $music->getNumberOfMusic() ?>
                </td>
              </tr>

              <tr>
                <th scope="col">BPM</th>
                <td>
                  <?php echo $music->getBPM() ?>
                </td>
              </tr>

              <tr>
                <th scope="col">Key</th>
                <td>
                  <?php echo $music->getKey() ?>
                </td>
              </tr>

              <tr>
                <th scope="col">Interpreter</th>
                <td>
                  <?php echo $music->getInterpreter() ?>
                </td>
              </tr>

              <tr>
                <th scope="col">Compositor</th>
                <td>
                  <?php echo $music->getCompositor() ?>
                </td>
              </tr>

              <tr>
                <th scope="col">Productor</th>
                <td>
                  <?php echo $music->getProductor() ?>
                </td>
              </tr>

            <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</body>

</html>