<?php
session_set_cookie_params(0);
session_start();
ob_start();
require '../model/Log.php';
use Model\Log;

?>
<!DOCTYPE html lang="fr">
<html>

<head><!-- Début de l'en tete -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style/bootstrap.css">
    <link rel="stylesheet" href="style/style.css">
    <script src="style/bootstrap.js"></script>
    <title>Validate</title>
</head><!-- Fin de l'en tete -->

<body>
    <?php
    $username = @$_POST["username"];
    $password = @$_POST["password"];

    $username = str_replace("'", "", $username);
    $password = str_replace("'", "", $password);

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
    //echo $username . $password;
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
        header("refresh:3;url=./main.php"); ?>
        <div class="container d-flex justify-content-center div">
        <h2 class="text-white">
            <?php echo "Login successful!"; ?>
        </h2>
    </div>
        <?php
        exit;
        } 
    else {
        header("refresh:2;url=./login.php"); ?>
        <div class="container d-flex justify-content-center div">
        <h2 class="text-white">
            <?php echo "Login failed!"; ?>
    </h2>
    </div>  
    <?php } ?>
</body>

</html>