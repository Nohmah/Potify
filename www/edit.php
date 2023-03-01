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
    array_push(
        $musicelements,
        new Music(
            $res['id'], $res['title'], $res['time'], $res['nol'], $res['artist'], $res['genre'], $res['album']
            , $res['albumtime'], $res['year'], $res['nom'], $res['BPM'], $res['key'], $res['interpreter'], $res['compositor'], $res['productor']
        )
    );
}

if (isset($_FILES['fichier'])) {
    //création de deux variables : l'une récupérant le fichier l'autre prend pour valeur le chemin du dossier uploads.
    $chemin_temp = $_FILES['fichier']['tmp_name'];
    $chemin_dest = "./cover/" . $_GET['id'] . ".jpg";
    //Si un fichier et stocké dans le répertoire uploads alors
    //Télécharge le fichier et le déplace dans le repertoire uploads.
    move_uploaded_file($chemin_temp, $chemin_dest);
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
    <title>Edit</title>
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
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
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
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
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
                <h3 class="text-white" align="center">Image</h3>
                <img src="./cover/<?php echo $_GET['id'] ?>.jpg" width="500" height="500">
                <form action="verification.php" method="post">
                    <div class="form-control">
                        <label>Sélectionner le fichier à envoyer</label>
                        <input type="file" name="fichier" accept=".jpg, .jpeg">
                    </div>
                    <h3 class="text-white" align="center">Audio</h3>
                    <div align="center">
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
                    <?php foreach ($musicelements as $music) { ?>
                        <div class="form-floating mb-2">
                            <input class="form-control" type="text" name="values[title]" placeholder="Title"
                                value="<?php echo $music->getTitle() ?>">
                            <label for="floatingInput">Title</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input name="values[time]" type="time" class="form-control" placeholder="Time"
                                value="<?php echo $music->getTime() ?>">
                            <label for="floatingInput">Time</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input name="values[nol]" type="text" class="form-control" placeholder="Number of Listening"
                                value="<?php echo $music->getNumberOfListening() ?>">
                            <label for="floatingInput">Number of Listening</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input name="values[artist]" type="text" class="form-control" placeholder="Artist"
                                value="<?php echo $music->getArtist() ?>">
                            <label for="floatingInput">Artist</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input name="values[genre]" type="text" class="form-control" placeholder="Genre"
                                value="<?php echo $music->getGenre() ?>">
                            <label for="floatingInput">Genre</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input name="values[album]" type="text" class="form-control" placeholder="Album"
                                value="<?php echo $music->getAlbum() ?>">
                            <label for="floatingInput">Album</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input name="values[albumtime]" type="text" class="form-control" placeholder="Album Time"
                                value="<?php echo $music->getAlbumTime() ?>">
                            <label for="floatingInput">AlbumTime</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input name="values[year]" type="number" class="form-control" placeholder="Year"
                                value="<?php echo $music->getYear() ?>">
                            <label for="floatingInput">Year</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input name="values[nom]" type="number" class="form-control" placeholder="Number of Music"
                                value="<?php echo $music->getNumberOfMusic() ?>">
                            <label for="floatingInput">Number of Music</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input name="values[BPM]" name="productor" type="number" class="form-control" placeholder="BPM"
                                value="<?php echo $music->getBPM() ?>">
                            <label for="floatingInput">BPM</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input name="values[key]" type="text" class="form-control" placeholder="Key"
                                value="<?php echo $music->getKey() ?>">
                            <label for="floatingInput">Key</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input name="values[interpreter]" type="text" class="form-control" placeholder="Interpreter"
                                value="<?php echo $music->getInterpreter() ?>">
                            <label for="floatingInput">Interpreter</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input name="values[compositor]" type="text" class="form-control" placeholder="Compositor"
                                value="<?php echo $music->getCompositor() ?>">
                            <label for="floatingInput">Compositor</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input name="values[productor]" type="text" class="form-control" placeholder="Productor"
                                value="<?php echo $music->getProductor() ?>">
                            <label for="floatingInput">Productor</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input type="submit" class="btn btn-dark" value="Submit">
                        </div>
                        <input name="values[id]" type="hidden" value="<?php echo $_GET['id'] ?>">
                    </div>
                <?php } ?>
                </form>
            </div>
        </div>
    </div>
</body>

</html>