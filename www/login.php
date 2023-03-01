<!DOCTYPE html lang="fr">
<html>

<head><!-- Début de l'en tete -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style/bootstrap.css">
  <link rel="stylesheet" href="style/style.css">
  <script src="style/bootstrap.js"></script>
  <title>Log In</title>
</head><!-- Fin de l'en tete -->

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark navbar-inner">
    <div class="container-fluid">
    <a href="./main.php"><img src="./style/logo.png">
        <a class="navbar-brand" href="./main.php">Accueil</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">  
        </ul>
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-purple" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>
  <h1 class="text-white" align="center">Se Connecter</h1>
  <!--<div>
        <form action ="validlogin.php" method="post">
            <label>Username :</label>
            <input type="text" name="username" />
            <label>Password</label>
            <input type="password" name="password" />
            <input type="submit" value="Login" />
        </form>
    </div>-->
  <div align="center" class="container">
    <form action="validlogin.php" method="post">
      <div class="form-group">
        <label class="text-white">Username</label>
        <input type="text" class="form-control" placeholder="Enter your username" name="username" required/>
        <div class="form-group">
          <label class="text-white">Password</label>
          <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password"
            name="password" required/>
        </div>
        <button type="submit" class="btn btn-purple" value="Login">Submit</button>
        <h5 class="text-white" align="center"><a class="text-white" href="./register.php">Vous n'avez pas de compte ? Cliquer ici pour vous inscrire !</h5>
    </form>
  </div>
</body>

</html>