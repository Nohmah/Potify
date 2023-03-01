<?php
session_set_cookie_params(0);
session_start();
require '../model/Log.php';
use Model\Log;

$con = new SQLite3('../data/data.db');
$sql = $con->prepare('SELECT * from log where id=?');
$sql->bindValue(1, $_GET['userid']);
$result = $sql->execute();
$logList = array();
while ($res = $result->fetchArray()) {
  array_push($logList, new Log($res['id'], $res['username'], $res['mail'], $res['password'], $res['right'], $res['registration_date']));

}
ob_start()
  ?>
<!DOCTYPE html lang="fr">
<html>

<head><!-- Début de l'en tete -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style/bootstrap.css">
  <link rel="stylesheet" href="style/style.css">
  <script src="style/bootstrap.js"></script>
  <title>Account</title>
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
  <h1 class="text-white">Votre Compte</h1>
  <div class="container">
    <div class="container">
      <table class="table table-striped table-dark">
        </tbody>
        <?php foreach ($logList as $log): ?>
          <tr class="tableproduct">
            <th scope="col">Nom d'Utilisateur</th>
            <td>
              <?php echo $log->getUsername() ?>
            </td>
          </tr>

          <tr class="tableproduct">
            <th scope="col">Mail</th>
            <td>
              <?php echo $log->getMail() ?>
            </td>
          </tr>

          <tr>
            <th scope="col">Droit</th>
            <td>
              <?php if ($log->getRight() =="A") 
              {
                echo "Administrateur";
              }
              else
              {
                echo "Utilisateur";
              }
                ?>
            </td>
          </tr>

          <tr>
            <th scope="col">Date d'Inscription</th>
            <td>
              <?php echo $log->getRegistrationDate() ?>
            </td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
      <div class="container d-flex justify-content-center">

        <button class=" btn btn-purple" onclick="window.location.href = './logout.php';">Se Déconnecter</button>
      </div>
    </div>
  </div>
</body>

</html>