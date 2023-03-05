<?php
session_set_cookie_params(0);
session_start();
require '../model/Music.php';
use Model\Music;
//Connexion à la base de données pour récupérer toutes les informations d'une musique en renseignant son id depuis la table music .
$con = new SQLite3('../data/data.db');
$sql = $con->prepare('SELECT * from music where id=?');
$sql->bindValue(1, $_GET['id']);
$results = $sql->execute();
$musicelements = array();
while ($res = $results->fetchArray()) {
    array_push(
        $musicelements,
        new Music(
            $res['id'], $res['title'], $res['time'], $res['nol'], $res['artist'], $res['genre'], $res['album']
            , $res['albumtime'], $res['year'], $res['nom'], $res['BPM'], $res['key'], $res['interpreter'], $res['compositor'], $res['productor']
        )
    );
}

?>
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
    <!-- Affiche l'id de ma musique récupéré en GET-->
    <h1 class="text-white">Music n°
        <?php echo $_GET['id'] ?>
    </h1>
    <div class="container">
        <!-- Formulaire permettant de modifier les caractéritiques de la musique -->
        <form action="verification.php" method="post" enctype="multipart/form-data">
            <div class="row justify-content-center">
                <div class="col-6">
                    <h3 class="text-white">Image</h3>
                    <img src="./cover/<?php echo $_GET['id'] ?>.jpg" width="500" height="500"
                        alt="Couverture de l'album">
                    <div class="form-control">
                        <label>Sélectionner le fichier à envoyer</label>
                        <input type="file" name="fichier" accept=".jpg, .jpeg">
                    </div>
                    <h3 class="text-white">Audio</h3>
                    <div class="audiodiv">
                        <audio controls>
                            <source src="./audio/<?php echo $_GET['id'] ?>.mp3" type="audio/mpeg">
                        </audio>
                    </div>
                    <div class="form-control">
                        <label>Sélectionner le fichier audio à envoyer</label>
                        <input type="file" name="fichieraudio" accept=".mp3">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form group">
      <!-- Utilisation d'une boucle foreach pour afficher toutes les caractéristiques de la musique dans le tableau en utilisant les accesseurs-->
      <!-- Chaque caractéristiques est pré-inscrite dans le formulaire avec l'utilisation de l'attribut value -->
                        <?php foreach ($musicelements as $music) { ?>
                            <div class="form-floating mb-2">
                                <input class="form-control" type="text" name="values[title]" placeholder="Title"
                                    value="<?php echo $music->getTitle() ?>">
                                <label>Title</label>
                            </div>
                            <div class="form-floating mb-2">
                                <input name="values[time]" type="time" class="form-control"
                                    value="<?php echo $music->getTime() ?>">
                                <label>Time</label>
                            </div>
                            <div class="form-floating mb-2">
                                <input name="values[nol]" type="text" class="form-control" placeholder="Number of Listening"
                                    value="<?php echo $music->getNumberOfListening() ?>">
                                <label>Number of Listening</label>
                            </div>
                            <div class="form-floating mb-2">
                                <input name="values[artist]" type="text" class="form-control" placeholder="Artist"
                                    value="<?php echo $music->getArtist() ?>">
                                <label>Artist</label>
                            </div>
                            <div class="form-floating mb-2">
                                <input name="values[genre]" type="text" class="form-control" placeholder="Genre"
                                    value="<?php echo $music->getGenre() ?>">
                                <label>Genre</label>
                            </div>
                            <div class="form-floating mb-2">
                                <input name="values[album]" type="text" class="form-control" placeholder="Album"
                                    value="<?php echo $music->getAlbum() ?>">
                                <label>Album</label>
                            </div>
                            <div class="form-floating mb-2">
                                <input name="values[albumtime]" type="text" class="form-control" placeholder="Album Time"
                                    value="<?php echo $music->getAlbumTime() ?>">
                                <label>AlbumTime</label>
                            </div>
                            <div class="form-floating mb-2">
                                <input name="values[year]" type="number" class="form-control" placeholder="Year"
                                    value="<?php echo $music->getYear() ?>">
                                <label>Year</label>
                            </div>
                            <div class="form-floating mb-2">
                                <input name="values[nom]" type="number" class="form-control" placeholder="Number of Music"
                                    value="<?php echo $music->getNumberOfMusic() ?>">
                                <label>Number of Music</label>
                            </div>
                            <div class="form-floating mb-2">
                                <input name="values[BPM]" type="number" class="form-control"
                                    placeholder="BPM" value="<?php echo $music->getBPM() ?>">
                                <label>BPM</label>
                            </div>
                            <div class="form-floating mb-2">
                                <input name="values[key]" type="text" class="form-control" placeholder="Key"
                                    value="<?php echo $music->getKey() ?>">
                                <label>Key</label>
                            </div>
                            <div class="form-floating mb-2">
                                <input name="values[interpreter]" type="text" class="form-control" placeholder="Interpreter"
                                    value="<?php echo $music->getInterpreter() ?>">
                                <label>Interpreter</label>
                            </div>
                            <div class="form-floating mb-2">
                                <input name="values[compositor]" type="text" class="form-control" placeholder="Compositor"
                                    value="<?php echo $music->getCompositor() ?>">
                                <label>Compositor</label>
                            </div>
                            <div class="form-floating mb-2">
                                <input name="values[productor]" type="text" class="form-control" placeholder="Productor"
                                    value="<?php echo $music->getProductor() ?>">
                                <label>Productor</label>
                            </div>
                            <div class="form-floating mb-2">
                                <input type="submit" class="btn btn-dark" value="Submit">
                            </div>
                            <input name="values[id]" type="hidden" value="<?php echo $_GET['id'] ?>">
                        <?php } ?>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- Inclusion du fichier footer.php pour affichier le footer de la page -->
    <?php require './footer.php';?>
</body>

</html>