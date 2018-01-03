<?php
  if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Controle sur la civilité qui ne peut être mise sur le composant directement
    if (!isset($_POST["titre"])){
      $err = "La civilité est obligatoire";
    }elseif ((!isset($_POST["telephoneMobileClient"]) && !isset($_POST["telephoneFixeClient"]))
      || ($_POST["telephoneMobileClient"] == null && $_POST["telephoneFixeClient"] == null)
    ) {
      $err = "Un mobile ou un fixe est obligatoire";
    }

    if (!isset($err)){
      if (isset($_POST["emailClient"])){
        require "traitement.php";

        $email = $_POST["emailClient"];
        if (!testExistanceClient($email)) {
          $titre = $_POST["titre"];
          $nom =  $_POST["nomClient"];
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
          }else{
            $fixe="";
          }

    			if (nouveauclient($titre, $nom, $prenom, $datenaissance, $email, $portable, $fixe, $adresse, $cp, $ville)) {
              header('Location:interfaceClientSyntheseCompte.php?id='.$_SESSION['id']);
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
        <br>
        <div class="form-group">
          <label for="titre">Titre *</label>
          <div class="form-group" id="titre">
            <input type="radio" id="monsieur" name="titre" value="M"
            <?php if(isset($_POST['titre']) && ($_POST['titre'])=="M"){
              echo "checked";
            }?>/>
            <label>  Monsieur </label>
            <input type="radio" id="madame" name="titre" value="MME"
            <?php if(isset($_POST['titre']) && ($_POST['titre'])=="MME"){
              echo "checked";
            }?>/>
            <label>  Madame </label>
          </div>
        </div>
        <div class="form-group">
          <label for="nomClient">Nom d'usage *</label>
          <input type="text" class="form-control" name="nomClient" placeholder="Saisissez votre nom" size="40" maxlength="30" required
          <?php if (isset($_POST['nomClient'])) {
            echo 'value="'.$_POST['nomClient'].'"';
          }?>/>
        </div>
        <div class="form-group">
          <label for="prenomClient">Pr&eacute;nom *</label>
          <input type="text" class="form-control" name="prenomClient" placeholder="Saisissez votre pr&eacute;nom" size="40" maxlength="30" required
          <?php if (isset($_POST['prenomClient'])) {
            echo 'value="'.$_POST['prenomClient'].'"';
          }?>/>
        </div>
        <div class="form-group">
          <label for="dateNaissanceClient">Date de naissance *</label>
          <input type="date" class="form-control" name="dateNaissanceClient" required
          <?php if (isset($_POST['dateNaissanceClient'])) {
            echo 'value="'.$_POST['dateNaissanceClient'].'"';
          }?>/>
        </div>
        <div class="form-group">
          <label for="emailClient">E-mail *</label>
          <input type="email" class="form-control" name="emailClient" required
          <?php if (isset($_POST['emailClient'])) {
            echo 'value="'.$_POST['emailClient'].'"';
          }?>/>
        </div>
        <h3 id="coordonnees">Vos coordonnées</h3>
        <div class="form-group">
          <label for="adresseClient">Adresse *</label>
          <input type="text" class="form-control" name="adresseClient" required
          <?php if (isset($_POST['adresseClient'])) {
            echo 'value="'.$_POST['adresseClient'].'"';
          }?>/>
        </div>
        <div class="form-group">
          <label for="codePostalClient">Code postal *</label>
          <input type="text" class="form-control" name="codePostalClient" pattern="^(([0-8][0-9])|(9[0-5])|(2[ab]))[0-9]{3}$" title="5 chiffres sont attendus" required
          <?php if (isset($_POST['codePostalClient'])) {
            echo 'value="'.$_POST['codePostalClient'].'"';
          }?>/>
        </div>
        <div class="form-group">
          <label for="villeClient">Ville *</label>
          <input type="text" class="form-control" name="villeClient" required
          <?php if (isset($_POST['villeClient'])) {
            echo 'value="'.$_POST['villeClient'].'"';
          }?>/>
        </div>
        <div class="form-group">
          <label for="telephoneMobileClient">T&eacute;l&eacute;phone Mobile</label>
          <input type="tel" class="form-control" name="telephoneMobileClient" pattern="^(?:0|\(?\+33\)?\s?|0033\s?)[1-79](?:[\.\-\s]?\d\d){4}$" title="10 chiffres sont attendus"
          <?php if (isset($_POST['telephoneMobileClient'])) {
            echo 'value="'.$_POST['telephoneMobileClient'].'"';
          }?>/>
        </div>
        <div class="form-group">
          <label for="telephoneFixeClient">T&eacute;l&eacute;phone Fixe</label>
          <input type="tel" class="form-control" name="telephoneFixeClient" pattern="^(?:0|\(?\+33\)?\s?|0033\s?)[1-79](?:[\.\-\s]?\d\d){4}$" title="10 chiffres sont attendus"
          <?php if (isset($_POST['telephoneFixeClient'])) {
            echo 'value="'.$_POST['telephoneFixeClient'].'"';
          }?>/>
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
