<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Template client interface</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="styleInterfaceClient.css">

  <style type="text/css">
    footer{
      margin-top: 10px;
    }
  </style>

</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="index.html">Zen Bank</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="index.html">Home</a></li>
        <li class="active"><a href="interfaceClientSyntheseCompte.html">Mon espace client</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><h2 id="messageBienvenue">Bonjour client</h2></li>
        <li><a href="index.html"><button type="button" class="btn btn-danger">
          Se déconnecter <span class="glyphicon glyphicon-log-out"></span>
        </button></a></li>
      </ul>
    </div>
  </div>
</nav>
  
<div class="container-fluid text-center">    
  <div class="row content">
    <!-- Menu latéral accordéon -->
    <div class="col-md-3 sidenav">
      <div class="panel-group" id="accordion">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><span class="glyphicon glyphicon-info-sign">
                </span> Mes informations</a>
            </h4>
          </div>
          <div id="collapseOne" class="panel-collapse collapse in">
            <div class="panel-body">
              <table class="table">
                <tr>
                  <td>
                    <a href="interfaceClientInformations.html">Mettre à jour de mes informations</a>
                  </td>
                </tr>
              </table>
            </div>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"><span class="glyphicon glyphicon-credit-card">
              </span> R&eacute;sum&eacute; des comptes</a>
            </h4>
          </div>
          <div id="collapseTwo" class="panel-collapse collapse">
            <div class="panel-body">
              <table class="table">
                <tr>
                  <td>
                    <a href="interfaceClientSyntheseCompte.html">Synthèse</a>
                  </td>
                </tr>
                <tr>
                  <td>
                    <a href="interfaceClientHistoriqueCompte.html">Historique des opérations</a>
                  </td>
                </tr>
                <tr>
                  <td>
                    <a href="interfaceClientRIB.html">RIB</a>
                  </td>
                </tr>
              </table>
            </div>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree"><span class="glyphicon glyphicon-share">
              </span> Virements</a>
            </h4>
          </div>
          <div id="collapseThree" class="panel-collapse collapse">
            <div class="panel-body">
              <table class="table">
                <tr>
                  <td>
                    <a href="interfaceClientHistoriqueVirement.html">Historique des virements</a>
                  </td>
                </tr>
                <tr>
                  <td>
                    <a href="interfaceClientNouveauVirement.html">Nouveau virement</a>
                  </td>
                </tr>
                <tr>
                  <td>
                    <a href="interfaceClientGestionBeneficiaires.html">Gérer mes bénéficiaires</a>
                  </td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour"><span class="glyphicon glyphicon-briefcase">
              </span> Mes services</a>
            </h4>
          </div>
          <div id="collapseFour" class="panel-collapse collapse">
            <div class="panel-body">
              <table class="table">
                <tr>
                  <td>
                    <a href="interfaceClientNouveauCompte.html">Ouverture d'un nouveau compte</a>
                  </td>
                </tr>
                <tr>
                  <td>
                    <a href="interfaceClientCommandeChequier.html">Commande de nouveau chéquier</a>
                  </td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-9 text-left"> 
      <h2>Mise à jour de vos informations personnelles</h2>
      <br>
      <div class="col-md-6">
      <form method="post" action="A MODIFIER.PHP">
        <!-- Formulaire de modification des informations personnelles -->
        <!-- Charger les informations du client -->
        <div class="form-group">
          <label for="emailClient">E-mail</label>
          <input type="email" class="form-control" id="emailClient">
        </div>
        <h3 id="coordonnees">Vos coordonnées</h3>
        <div class="form-group">
          <label for="adresseClient">Adresse</label>
          <input type="text" class="form-control" id="adresseClient">
        </div>
        <div class="form-group">
          <label for="codePostalClient">Code postal</label>
          <input type="text" class="form-control" id="codePostalClient">
        </div>
        <div class="form-group">
          <label for="villeClient">Ville</label>
          <input type="text" class="form-control" id="villeClient">
        </div>
        <div class="form-group">
          <label for="telephoneMobileClient">T&eacute;l&eacute;phone Mobile</label>
          <input type="tel" class="form-control" id="telephoneMobileClient">
        </div>
        <div class="form-group">
          <label for="telephoneFixeClient">T&eacute;l&eacute;phone Fixe</label>
          <input type="tel" class="form-control" id="telephoneFixeClient">
        </div>
        <a href="interfaceClientSyntheseCompte.html"><button type="button" class="btn btn-info">Annuler</button></a>
        <button type="submit" class="btn btn-danger">Mettre à jour</button>
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

