<?php
  if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      require "traitement.php";
      $email = $_POST['identifiantClient'];
      if (testExistenceClient($email)){
        if (generationMDP($email)) {
          header('Location:interfaceClientInformations.php');
        }
        else {
          $err = "Le login n'existe pas";
        }
      }
      else{
        $err = "Le login n'existe pas";
      }
  }
 ?>

<html lang="fr">
<head>
  <title>Réinitialisation de votre mot de passe</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="styleInterfaceClient.css">
  <style>
    h3{
      text-align: center;
    }
    #error{
      color: red;
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Zen Bank</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="index.php">Home</a></li>
      </ul>
    </div>
  </div>
</nav>
  <div class="container-fluid">
    <div class="col-md-12 text-left">
      <h2>Saisie de votre identifiant</h2>
      <br>
      <div class="col-md-6">
      <form method="post" action="">
        <div id="error">
            <?php
              if (isset($err)){
                echo $err;
              }
            ?>
        </div>
        <div class="form-group">
          <label for="titre">Identifiant *</label>
          <input type="email" name="identifiantClient" id="identifiantClient" placeholder="Saisissez votre identifiant" size="30" required>
        </div>
        <a href="index.php"><button type="button" class="btn btn-info">Annuler</button></a>
        <button type="submit" class="btn btn-danger">R&eacute;initialiser mon mot de passe</button>
      </form>
      </div>
    </div>
  </div>
</div>

<footer class="container-fluid text-center">
  <div class="row">
    &copy; Copyright Zen Bank France 2017 <a href="#"><span class="glyphicon glyphicon-question-sign"></span> Aide</a>
  </div>
</footer>

</body>
</html>
