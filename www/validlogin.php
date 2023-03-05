<?php
session_set_cookie_params(0);
session_start();
ob_start();
require '../model/Log.php';
use Model\Log;

?>
<!DOCTYPE html>
<html lang="<?php echo substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);?>">

<head><!-- Début de l'en tete -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style/bootstrap.css">
    <link rel="stylesheet" href="style/style.css">
    <script src="style/bootstrap.js"></script>
    <title>Validation de Connexion</title>
    <link rel="icon" type="image/x-con" href="./style/logo.png">
</head><!-- Fin de l'en tete -->

<body>
    <?php
    //Récupère les saisies avec la méthode POST
    $username = @$_POST["username"];
    $password = @$_POST["password"];
    // Enlève les simple quote des saisies pour éviter les injections sql
    $username = str_replace("'", "", $username);
    $password = str_replace("'", "", $password);
    //Si les saisies sont vides alors un message d'erreur apparaît
    if (
        empty($username) || empty($password)
    ) { ?>
        <div class="container d-flex justify-content-center div">
            <h3 class="text-white">Veuillez remplir tout les champs.</h3>
        </div>
        <?php
        header("refresh:2;url=./login.php");
        exit;
    }
    //connection à la base de données pour vérifier qu'un compte existe
    $db = new SQLite3('../data/data.db');
    $sql = $db->prepare("SELECT * FROM log WHERE username = ? AND password = ?");
    $sql->bindValue(1, $username);
    $sql->bindValue(2, $password);
    $results = $sql->execute();
    $log = array();
    while ($res = $results->fetchArray()) {
        array_push($log, new Log($res['id'],$res['username'], $res['mail'], $res['password'], $res['right'],$res['registration_date']));
    }
    //fetchArray récupère un jeu de résultats sous la forme d'un tableau associatif
    if ($results->fetchArray() != null) {
        foreach ($log as $objt_log) {
            $_SESSION["username"] = $objt_log->getUsername();
            $_SESSION["right"] = $objt_log->getRight();
            $_SESSION["userid"]= $objt_log->getId();
        }
        //Si le résultat de la requête n'est pas vide alors la connexion est réussite et le nom d'utilisateur,le droit et l'id passent en session.
        header("refresh:3;url=./index.php"); ?>
        <div class="container d-flex justify-content-center div">
        <h2 class="text-white">
            <?php echo "Connexion Réussie !"; ?>
        </h2>
    </div>
        <?php
        exit;
        } 
    else {
        header("refresh:2;url=./login.php"); ?>
        <div class="container d-flex justify-content-center div">
        <h2 class="text-white">
            <?php echo "Connexion Echouée!"; ?>
    </h2>
    </div>  
    <?php } ?>
</body>

</html>