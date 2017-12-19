<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Historique de compte</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link src="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css"/> 
  <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
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
          <div id="collapseOne" class="panel-collapse collapse">
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
          <div id="collapseThree" class="panel-collapse collapse in">
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
      <br>
      <!-- A MODIFIER -->
      <form method="post" action="traitement.php">
        <p>
        <!-- Charger la liste des comptes du client -->
        <label for="commpte">Choisissez un compte</label><br />
        <select name="compte" id="compte">
          <option value="compte1">compte1</option>
          <option value="compte2">compte2</option>
        </select>
        </p>
      </form>
      <table id="historiqueCompte" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Date</th>
                <th>Libell&eacute;</th>
                <th>Montant (en €)</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Date</th>
                <th>Libell&eacute;</th>
                <th>Montant (en €)</th>
            </tr>
        </tfoot>
        <tbody>
          <!-- Lignes du tableau / A INCLURE DANS CODE PHP -->
            <tr>
                <td>12/10/2017</td>
                <td>Operation1</td>
                <td>23,4</td>
            </tr>
            <tr>
                <td>14/10/2017</td>
                <td>Operation2</td>
                <td>104</td>
            </tr>
            <tr>
                <td>14/10/2017</td>
                <td>Operation3</td>
                <td>34,6</td>
            </tr>
            <tr>
                <td>15/10/2017</td>
                <td>Operation4</td>
                <td>22</td>
            </tr>
            <tr>
                <td>16/10/2017</td>
                <td>Operation5</td>
                <td>2789,86</td>
            </tr>
            <tr>
                <td>16/10/2017</td>
                <td>Operation6</td>
                <td>23</td>
            </tr>
            <tr>
                <td>16/10/2017</td>
                <td>Operation7</td>
                <td>100</td>
            </tr>
            <tr>
                <td>17/10/2017</td>
                <td>Operation8</td>
                <td>56,9</td>
            </tr>
            <tr>
                <td>17/10/2017</td>
                <td>Operation9</td>
                <td>64,8</td>
            </tr>
            <tr>
                <td>17/10/2017</td>
                <td>Operation10</td>
                <td>45,9</td>
            </tr>
            <tr>
                <td>20/10/2017</td>
                <td>Operation11</td>
                <td>38,8</td>
            </tr>
            <tr>
                <td>21/10/2017</td>
                <td>Operation12</td>
                <td>102</td>
            </tr>
            <!-- Fin lignes tableau -->
        </tbody>
      </table>
      <!-- JQuery permettant la pagination -->
      <script type="text/javascript">
        $(document).ready(function() {
          $('#historiqueCompte').DataTable( {
          "pagingType": "full_numbers"
          } );
        } );
      </script>
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

