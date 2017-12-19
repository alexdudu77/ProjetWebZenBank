<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Commande de ch&eacute;quier</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="styleInterfaceClient.css">
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
      <a class="navbar-brand" href="index.php">Zen Bank</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="index.php">Home</a></li>
        <li class="active"><a href="interfaceClientSyntheseCompte.php">Mon espace client</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><h2 id="messageBienvenue">Bonjour client</h2></li>
        <li><a href="index.php"><button type="button" class="btn btn-danger">
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
          <div id="collapseOne" class="panel-collapse collapse">
            <div class="panel-body">
              <table class="table">
                <tr>
                  <td>
                    <a href="interfaceClientInformations.php">Mettre à jour de mes informations</a>
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
                    <a href="interfaceClientSyntheseCompte.php">Synthèse</a>
                  </td>
                </tr>
                <tr>
                  <td>
                    <a href="interfaceClientHistoriqueCompte.php">Historique des opérations</a>
                  </td>
                </tr>
                <tr>
                  <td>
                    <a href="interfaceClientRIB.php">RIB</a>
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
                    <a href="interfaceClientHistoriqueVirement.php">Historique des virements</a>
                  </td>
                </tr>
                <tr>
                  <td>
                    <a href="interfaceClientNouveauVirement.php">Nouveau virement</a>
                  </td>
                </tr>
                <tr>
                  <td>
                    <a href="interfaceClientGestionBeneficiaires.php">Gérer mes bénéficiaires</a>
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
          <div id="collapseFour" class="panel-collapse collapse in">
            <div class="panel-body">
              <table class="table">
                <tr>
                  <td>
                    <a href="interfaceClientNouveauCompte.php">Ouverture d'un nouveau compte</a>
                  </td>
                </tr>
                <tr>
                  <td>
                    <a href="interfaceClientCommandeChequier.php">Commande de nouveau chéquier</a>
                  </td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-9 text-left">
      <!-- Formulaire de commande chéquier -->
      <form method="post" action="A MODIFIER.PHP">
        <div class="form-group">
          <label for="compteChequier">S&eacute;lectionnez le compte rattach&eacute; au ch&eacute;quier</label>
          <br>
          <!-- Charger la liste des comptes courants -->
          <select name="listeCompte" id="listeCompte">
            <option value="compte1">compte1</option>
            <option value="compte2">compte2</option>
          </select>
        </div>
        <div class="form-group">
          <label for="nombreChequier">Nombre de ch&eacute;quier </label>
          <br>
          <input type="number" id="nombreChequier" min="0" max="2" size="3">
        </div>
        <br>
        <div class="form-group">
          <label for="formatChequier">Format de ch&eacute;quier d&eacute;sir&eacute;</label>
          <div class="input-group">
            <input type="radio" id="chequierSimple" name="formatChequier">
            <label for="formatChequier">Format Simple </label>
          </div>
          <div class="input-group">
            <input type="radio" id="chequierPorteFeuille" name="formatChequier">
            <label for="formatChequier">Format Porte-feuille </label>
          </div>
        </div>
        <br>
        <div class="form-group">
          <label for="lieuLivraisonChequier">Lieu o&ugrave; je souhaite &ecirc;tre livr&eacute;</label>
          <div class="input-group">
            <input type="radio" id="monAgence" name="lieuLivraisonChequier">
            <label for="lieuLivraisonChequier">Mon agence </label>
          </div>
          <div class="input-group">
            <input type="radio" id="domicile" name="lieuLivraisonChequier">
            <label for="lieuLivraisonChequier">A mon domicile </label>
          </div>
        </div>
        <a href="interfaceClientSyntheseCompte.html"><button type="button" class="btn btn-info">Annuler</button></a>
        <button type="submit" class="btn btn-danger">Valider commande</button>
      </form>
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