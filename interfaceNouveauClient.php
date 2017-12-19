<!DOCTYPE html>
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
        <li class="active"><a href="#">Home</a></li>
      </ul>
    </div>
  </div>
</nav>
  <div class="container-fluid">
    <div class="col-md-12 text-left"> 
      <h2>Saisie de vos informations personnelles</h2>
      <br>
      <div class="col-md-3">
      <form method="post" action="A MODIFIER.PHP">
        <div class="form-group">
          <label for="titre">Titre *</label>
          <div class="form-group" id="titre">
            <input type="radio" id="monsieur" name="titre">
            <label>  Monsieur </label>
            <input type="radio" id="madame" name="titre">
            <label>  Madame </label>
          </div>
        </div>
        <div class="form-group">
          <label for="nomClient">Nom d'usage *</label>
          <input type="text" class="form-control" id="nomClient" placeholder="Saisissez votre nom" size="40" maxlength="30" required>
        </div>
        <div class="form-group">
          <label for="prenomClient">Pr&eacute;nom *</label>
          <input type="text" class="form-control" id="prenomClient" placeholder="Saisissez votre pr&eacute;nom" size="40" maxlength="30" required>
        </div>
        <div class="form-group">
          <label for="dateNaissanceClient">Date de naissance *</label>
          <input type="date" class="form-control" id="dateNaissanceClient" required>
        </div>
        <div class="form-group">
          <label for="emailClient">E-mail *</label>
          <input type="email" class="form-control" id="emailClient" required>
        </div>
        <h3 id="coordonnees">Vos coordonnées</h3>
        <div class="form-group">
          <label for="adresseClient">Adresse *</label>
          <input type="text" class="form-control" id="adresseClient" required>
        </div>
        <div class="form-group">
          <label for="codePostalClient">Code postal *</label>
          <input type="text" class="form-control" id="codePostalClient" required>
        </div>
        <div class="form-group">
          <label for="villeClient">Ville *</label>
          <input type="text" class="form-control" id="villeClient" required>
        </div>
        <div class="form-group">
          <label for="telephoneMobileClient">T&eacute;l&eacute;phone Mobile</label>
          <input type="tel" class="form-control" id="telephoneMobileClient">
        </div>
        <div class="form-group">
          <label for="telephoneFixeClient">T&eacute;l&eacute;phone Fixe</label>
          <input type="tel" class="form-control" id="telephoneFixeClient">
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

