<?php
session_set_cookie_params(0);
session_start();
require '../model/Log.php';
use Model\Log;

$con = new SQLite3('../data/data.db');
$sql = 'select * from log;';
$result = $con->query($sql);
$logList = array();
while ($res = $result->fetchArray()) {
  array_push($logList, new Log($res['id'],$res['username'], $res['mail'], $res['password'],$res['right'],$res['registration_date']));

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
  <title>Main</title>
</head><!-- Fin de l'en tete -->

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark navbar-inner">
    <div class="container-fluid">
    <a href="./main.php"><img src="./style/logo.png">      <a class="navbar-brand" href="./main.php">Accueil</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        </ul>
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-purple" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>
  <div class="container d-flex justify-content-center div">

    <button class=" btn btn-purple" onclick="window.location.href = './logout.php';">Se Déconnecter</button>
  </div>
  <table class="table table-striped table-dark table-bordered table-respo,s">
      <thread>
        <tr>
          <th scope="col">Nom d'Utilisateur</th>
          <th scope="col">Mail</th>
          <th scope="col">Droit</th>
          <th scope="col">Date de Création</th>
        </tr>
      </thread>
      </tbody>
      <?php foreach ($logList as $log): ?>
        <tr data-href="<?php echo "product.php?id=" . $log->getId() ?>">
          <td>
            <?php echo $log->getUsername() ?>
          </td>
          <td>
            <?php echo $log->getMail() ?>
          </td>
          <td align="right">
            <?php echo $log->getRight() ?>
          </td>
          <td>
            <?php echo $log->getRegistrationDate() ?>
          </td>
          <?php if (@$_SESSION["right"] == "A") { ?>
            <td scope="row"><a class="text-white" href="<?php echo "edit.php?id=" . $log->getId() ?>">Editer</td>
            <td scope="row"><a class="text-danger" href="<?php echo "delete.php?id=" . $log->getId() ?>">Supprimer</td>
              <?php } ?>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</body>

</html>
</body>

</html>