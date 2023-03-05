<?php
session_set_cookie_params(0);
session_start();
?>
<!-- Début page HTML -->
<!DOCTYPE html>
<html lang="<?php echo substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);?>">

<head><!-- Début de l'en tete -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style/bootstrap.css">
    <link rel="stylesheet" href="style/style.css">
    <script src="style/bootstrap.js"></script>
    <title>Ajout Musique</title>
    <link rel="icon" type="image/x-con" href="./style/logo.png">
</head><!-- Fin de l'en tete -->

<body class="body"><!-- Début du corps de la page -->
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
    <!-- Titre de la page-->
    <h1 class="text-white">Nouvelle Musique</h1>
    <!-- Formulaire pour ajouter chaque caractéristique d'une musique, une fois envoyé le form sera envoyé au fichier verification.php-->
    <form action="./verification.php" method="post" enctype="multipart/form-data">
        <div class="container">
            <div class="row justify-content-center">
                <!-- Création d'une div pour séparer le formulaire en deux, l'image et l'audio à gauche, les caractéristiques à droite-->
                <div class="col-6">
                    <h3 class="text-white">Image</h3>
                    <div class="form-control">
                        <label>Sélectionner le fichier à envoyer</label>
                        <input type="file" name="fichier" accept=".jpg, .jpeg">
                    </div>
                    <h3 class="text-white">Audio</h3>
                    <div class="form-control">
                        <label>Sélectionner le fichier audio à envoyer</label>
                        <input type="file" name="fichieraudio" accept=".mp3">
                    </div>
                </div>
                <div class="col-6">
                    <h3 class="text-white">Caractéristiques</h3>
                    <!-- Les valeurs de chaque input sont stockées dans une liste nommée values-->
                    <div class="form group">
                        <div class="form-floating mb-2">
                            <input class="form-control" type="text" name="values[title]" placeholder="Titre">
                            <label>Titre</label>
                        </div>
                        <div class="form-floating mb-2">
                            <!-- Input de type time étant plus adéquat-->
                            <input name="values[time]" type="time" class="form-control">
                            <label>Durée</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input name="values[nol]" type="text" class="form-control"
                                placeholder="Nombre d'écoutes">
                            <label>Nombre d'écoutes</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input name="values[artist]" type="text" class="form-control" placeholder="Artiste">
                            <label>Artiste</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input name="values[genre]" type="text" class="form-control" placeholder="Genre">
                            <label>Genre</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input name="values[album]" type="text" class="form-control" placeholder="Album">
                            <label>Album</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input name="values[albumtime]" type="text" class="form-control" placeholder="Durée album">
                            <label>Durée de l'album</label>
                        </div>
                        <div class="form-floating mb-2">
                            <!-- Input de type number étant plus adéquat-->
                            <input name="values[year]" type="number" class="form-control" placeholder="Année">
                            <label>Année</label>
                        </div>
                        <div class="form-floating mb-2">
                            <!-- Input de type number étant plus adéquat-->
                            <input name="values[nom]" type="number" class="form-control" placeholder="Nombre de musiques">
                            <label>Nombre de musiques</label>
                        </div>
                        <div class="form-floating mb-2">
                            <!-- Input de type number étant plus adéquat-->
                            <input name="values[BPM]" type="number" class="form-control"
                                placeholder="BPM">
                            <label>BPM</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input name="values[key]" type="text" class="form-control" placeholder="Note">
                            <label>Note</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input name="values[interpreter]" type="text" class="form-control"
                                placeholder="Interprète">
                            <label>Interprète</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input name="values[compositor]" type="text" class="form-control" placeholder="Compositeur">
                            <label>Compositeur</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input name="values[productor]" type="text" class="form-control" placeholder="Producteur">
                            <label>Producteur</label>
                        </div>
                        <!-- Bouton pour envoyer le formulaire-->
                        <div class="form-floating mb-2">
                            <input type="submit" class="btn btn-dark" value="Submit">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- Inclusion du fichier footer.php pour affichier le footer de la page -->
    <?php require './footer.php';?>
</body>

</html>