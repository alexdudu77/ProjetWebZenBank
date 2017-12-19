<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Accueil Zen Bank</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="styleIndex.css">
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
      <ul class="nav navbar-nav navbar-right">
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#connexionModal">
          Connexion <span class="glyphicon glyphicon-log-in"></span>
        </button>

        <!-- Fenêtre de connexion -->
        <div class="modal fade" id="connexionModal" tabindex="-1" role="dialog" aria-labelledby="connexionModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="connexionModalLabel">Connexion à votre compte client</h5>
              </div>
              <form method="post" action="connexion.php">
              <div class="modal-body">
                <div class="form-group">
                  <label for="idClient">Identifiant client:</label>
                  <input type="text" class="form-control" id="idClient" placeholder="Saisissez votre identifiant">
                </div>
                <div class="form-group">
                  <label for="pwd">Password:</label>
                  <input type="password" class="form-control" id="passClient" placeholder="Saisissez votre mot de passe"><span class="glyphicon glyphicon-keys"></span>
                  <a href="interfaceOubliMDP.html">Mot de passe oubli&eacute;?</a>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button type="submit" class="btn btn-danger" id="btnConnexion"><label>Se connecter</label></button>
              </div>
            </form>
          </div>
        </div>
      </div>
      </ul>
    </div>
  </div>
</nav>

<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indices des slides -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Contenu des slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <img src="images/zen-meditation-relaxation.jpg" alt="Devenir client">
        <div class="carousel-caption">
          <h3>Soyez Zen, on s'occupe de tout</h3>
          <a href="interfaceNouveauClient.html" class="btn btn-info">Devenir client <span class="glyphicon glyphicon-chevron-right"></span></a>
        </div>      
      </div>

      <div class="item">
        <img src="images/HongKong.jpg" alt="Une banque internationale">
        <div class="carousel-caption">
          <h3>Une banque pr&eacute;sente partout dans le monde</h3>
          <p>Choisir Zen Bank, c'est se sentir chez soi partout dans le monde</p>
        </div>      
      </div>

      <div class="item">
        <img src="images/gift.jpg" alt="Cadeau de bienvenue">
        <div class="carousel-caption">
          <h3>100 € offerts</h3>
          <p>Si vous ouvrez un compte chez Zen Bank, vous recevrez 100€ de bienvenue</p>
        </div>      
      </div>
    </div>

    <!-- Boutons du caroussel -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
</div>
  
<div class="container text-center">    
  <div class="row">
    <div class="col-sm-4">
      <h3>Offre &eacute;tudiant</h3><br>
      <img src="images/student.jpg" class="img-responsive" style="width:100%" alt="Image">
      <p>B&eacute;n&eacute;ficiez de 50€ supplémentaire pour une ouverture de compte étudiant.</p>
    </div>
    <div class="col-sm-4">
      <h3>Cr&eacute;dit immobilier</h3><br>
      <img src="images/house.jpg" class="img-responsive" style="width:100%" alt="Image">
      <p>Profitez des taux les plus bas du march&eacute pour acheter votre bien immobilier.</p>    
    </div>
    <div class="col-sm-4">
      <br>
      <div class="well">
        <h3><a href="#">Se prot&eacute;ger contre la fraude</a></h3>
        <p>Tous nos conseils pour &eacute;viter les arnaques sur internet.</p>
      </div>
      <div class="well">
       <h3><a href="#">Partir à l'étranger</a></h3>
        <p>Nos astuces pour utiliser vos moyens de paiement durant vos voyages.</p>
      </div>
    </div>
  </div>
</div><br>

<footer class="container-fluid text-center">
  <div class="row">
    &copy; Copyright Zen Bank France 2017 <a href="#"><span class="glyphicon glyphicon-question-sign"></span> Aide</a>
  </div>
</footer>

</body>
</html>