<?php
session_set_cookie_params(0);
session_start();
ob_start();
require '../model/Log.php';
use Model\Log;
?>
<!DOCTYPE html>
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
    $mail= @$_POST["mail"];
    $username = @$_POST["username"];
    $password = @$_POST["password"];

    $username = str_replace("'", "", $username);
    $password = str_replace("'", "", $password);
    $mail = str_replace("'", "",$mail);
    $db = new SQLite3('../data/data.db');
    Log::VerifMail($mail);
    if (!preg_match("/^[a-zA-Z-0-9'\s]+$/", $username)) {
      echo "Votre nom d'utilisateur n'est pas accepté.";
      exit;
  }
    //echo $username . $password;
    $db = new SQLite3('../data/data.db');
    $sql = $db->prepare("INSERT INTO log(id,username,mail,password,right) VALUES(?,?,?,?,?);");
    $sql->bindValue(1,null);
    $sql->bindValue(2, $username);
    $sql->bindValue(3, $mail);
    $sql->bindValue(4,$password);
    $sql->bindValue(5,"U");
    $sql->execute();

    $idrequest = 'select max(id) from log';
    $result = $db->query($idrequest);
    while ($res = $result->fetchArray()) {
      $userid=$res['max(id)'];
}

    $_SESSION["username"]=$username;
    $_SESSION["right"]="U";
    $_SESSION["userid"]=$userid;
    header("refresh:3;url=./main.php"); ?>
    <h2 class="text-white"> <?php echo "Register successful!"; ?></h2>
</body>

</html>