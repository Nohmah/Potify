<?php
session_set_cookie_params(0);
session_start();
?>
<!DOCTYPE html lang="fr">
<html>

<head><!-- Début de l'en tete -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style/bootstrap.css">
    <link rel="stylesheet" href="style/style.css">
    <script src="style/bootstrap.js"></script>
    <title>Add Music</title>
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
    <h1 class="text-white" align="center">New Music</h1>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <form action="./verification.php" method="post" enctype="multipart/form-data">
                    <h3 class="text-white" align="center">Image</h3>
                    <div class="form-control">
                        <label>Sélectionner le fichier à envoyer</label>
                        <input type="file" name="fichier" accept=".jpg, .jpeg">
                    </div>
                    <h3 class="text-white" align="center">Audio</h3>
                    <div class="form-control">
                        <label>Sélectionner le fichier audio à envoyer</label>
                        <input type="file" name="fichieraudio" accept=".mp3">
                    </div>
                    <!--<button class="btn btn-secondary">Envoyer</button>-->
            </div>
            <div class="col-6">
                <h3 class="text-white" align="center">Caractéristiques</h3>
                <div class="form group">
                    <div class="form-floating mb-2">
                        <input class="form-control" type="text" name="values[title]" placeholder="Title">
                        <label for="floatingInput">Title</label>
                    </div>
                    <div class="form-floating mb-2">
                        <input name="values[time]" type="time" class="form-control" placeholder="Time">
                        <label for="floatingInput">Time</label>
                    </div>
                    <div class="form-floating mb-2">
                        <input name="values[nol]" type="text" class="form-control" placeholder="Number of Listening">
                        <label for="floatingInput">Number of Listening</label>
                    </div>
                    <div class="form-floating mb-2">
                        <input name="values[artist]" type="text" class="form-control" placeholder="Artist">
                        <label for="floatingInput">Artist</label>
                    </div>
                    <div class="form-floating mb-2">
                        <input name="values[genre]" type="text" class="form-control" placeholder="Genre"">
                                <label for=" floatingInput">Genre</label>
                    </div>
                    <div class="form-floating mb-2">
                        <input name="values[album]" type="text" class="form-control" placeholder="Album">
                        <label for="floatingInput">Album</label>
                    </div>
                    <div class="form-floating mb-2">
                        <input name="values[albumtime]" type="text" class="form-control" placeholder="Album Time">
                        <label for="floatingInput">AlbumTime</label>
                    </div>
                    <div class="form-floating mb-2">
                        <input name="values[year]" type="number" class="form-control" placeholder="Year">
                        <label for="floatingInput">Year</label>
                    </div>
                    <div class="form-floating mb-2">
                        <input name="values[nom]" type="number" class="form-control" placeholder="Number of Music">
                        <label for="floatingInput">Number of Music</label>
                    </div>
                    <div class="form-floating mb-2">
                        <input name="values[BPM]" name="productor" type="number" class="form-control" placeholder="BPM">
                        <label for="floatingInput">BPM</label>
                    </div>
                    <div class="form-floating mb-2">
                        <input name="values[key]" type="text" class="form-control" placeholder="Key">
                        <label for="floatingInput">Key</label>
                    </div>
                    <div class="form-floating mb-2">
                        <input name="values[interpreter]" type="text" class="form-control" placeholder="Interpreter">
                        <label for="floatingInput">Interpreter</label>
                    </div>
                    <div class="form-floating mb-2">
                        <input name="values[compositor]" type="text" class="form-control" placeholder="Compositor">
                        <label for="floatingInput">Compositor</label>
                    </div>
                    <div class="form-floating mb-2">
                        <input name="values[productor]" type="text" class="form-control" placeholder="Productor">
                        <label for="floatingInput">Productor</label>
                    </div>
                    <div class="form-floating mb-2">
                        <input type="submit" class="btn btn-dark" value="Submit">
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>