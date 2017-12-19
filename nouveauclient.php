<?php

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Controle sur la civilité qui ne peut être mise sur le composant directement
    if (!isset($_POST["monsieur"]) && !isset($_POST["madame"])){
      $err = "La civilité est obligatoire";
    }elseif (!isset($_POST["telephoneMobileClient"]) && !isset($_POST["telephoneFixeClient"])) {
      $err = "Un mobile ou un fixe est obligatoire";
    }


    if (!isset($err)){
      if (isset($_POST["emailClient"])){
        require "fonctions/traitement.php";

        $email = $_POST["emailClient"];
        if (!testExistanceClient($email)) {
          if (isset($_POST["monsieur"])){$titre = "M";}
          if (isset($_POST["madame"])){$titre = "MME";}

          $nom = $_POST["nomClient"];
          $prenom = $_POST["prenomClient"];
          $datenaissance = $_POST["dateNaissanceClient"];
          $adresse = $_POST["adresseClient"];
          $cp = $_POST["codePostalClient"];
          $ville = $_POST["villeClient"];
          if (isset($_POST["telephoneMobileClient"])){
            $portable = $_POST["telephoneMobileClient"];
          }else{$portable="";}
          if (isset($_POST["telephoneMobileClient"])){
            $fixe = $_POST["telephoneFixeClient"];
          }else{$fixe="";}

          $sql = "select creation_individu('".$titre."', '".$nom."', null, '".$prenom."', '".$datenaissance."', '".$email."', '".$portable."', '".$fixe."', '".$adresse."', ".$cp.", '".$ville."')";
          //$sql = "select id from individus where email='".mysqli_real_escape_string(.$email.)"' and mot_de_passe = '".mysqli_real_escape_string(.$mdp.)"'";
          $requete = executeQuery($sql);
          $count = mysqli_num_rows($requete);
    			if ($count == 1) {
            //$result = $requete->fetch_row();
            //$_SESSION['id_user'] = .$result[0].;
    				header('Location:index.php');
    			}
          else{
            $err = "Erreur SQL";
    			}
        } else {
            $err = "L'individu existe déjà";
        }
      }else{
        $err = "Email obligatoire";
      }
    }
  }
?>

<html lang="fr">
<head>
  <title>Rejoindre Zen Bank</title>
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
      <h2>Saisie de vos informations personnelles</h2>
      <br>
      <div class="col-md-3">
        <form method="post" action="">
          <div style="color:red">
            <?php  if (isset($err)) { echo $err; } ?>
          </div>
          </br>

          <div class="form-group">
            <label for="titre">Titre *</label>
            <div class="form-group" id="titre">
              <input type="radio" name="monsieur" name="titre">
              <label>  Monsieur </label>
              <input type="radio" name="madame" name="titre">
              <label>  Madame </label>
            </div>
          </div>
          <div class="form-group">
            <label for="nomClient">Nom d'usage *</label>
            <input type="text" required="required" class="form-control" name="nomClient" placeholder="Saisissez votre nom" size="40" maxlength="30">
          </div>
          <div class="form-group">
            <label for="prenomClient" >Pr&eacute;nom *</label>
            <input type="text" required="required" class="form-control" name="prenomClient" placeholder="Saisissez votre pr&eacute;nom" size="40" maxlength="30">
          </div>
          <div class="form-group">
            <label for="dateNaissanceClient" >Date de naissance *</label>
            <input type="date" required="required" class="form-control" name="dateNaissanceClient">
          </div>
          <div class="form-group">
            <label for="emailClient">E-mail *</label>
            <input type="email" required="required" class="form-control" name="emailClient">
          </div>
          <h3 id="coordonnees">Vos coordonnées</h3>
          <div class="form-group">
            <label for="adresseClient">Adresse *</label>
            <input type="text" required="required" class="form-control" name="adresseClient">
          </div>
          <div class="form-group">
            <label for="codePostalClient">Code postal *</label>
            <input type="number" required="required" class="form-control" name="codePostalClient">
          </div>
          <div class="form-group">
            <label for="villeClient">Ville *</label>
            <input type="text" required="required" class="form-control" name="villeClient">
          </div>
          <div class="form-group">
            <label for="telephoneMobileClient">T&eacute;l&eacute;phone Mobile</label>
            <input type="tel" class="form-control" name="telephoneMobileClient">
          </div>
          <div class="form-group">
            <label for="telephoneFixeClient">T&eacute;l&eacute;phone Fixe</label>
            <input type="tel" class="form-control" name="telephoneFixeClient">
          </div>
          <a href="index.php"><button type="button" class="btn btn-info">Annuler</button></a>
          <button type="submit" class="btn btn-danger">Envoyer ma demande</button>
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
