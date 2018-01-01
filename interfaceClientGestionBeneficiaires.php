<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Gestion des b&eacute;n&eacute;ficiaires</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="styleInterfaceClient.css">
</head>
<body>

<?php include("interfaceClientEnTete.php") ?>

<div class="container-fluid text-center">
<!-- Menu latéral accordéon -->
  <div class="row content">
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
          <div id="collapseFour" class="panel-collapse collapse">
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
      <br>
      <div class="col-md-7">
        <!-- Formulaire de gestion des bénéficiaires -->
      <form method="post" action="A MODIFIER.PHP">
        <div class="form-group" id="typeModification">
            <input type="radio" id="ajouterBeneficiaire" name="typeModification" value="ajouterBeneficiaire">
            <label>  Ajouter un b&eacute;n&eacute;ficiaire </label>
            <br>
            <div class="form-group">
              <label for="nomBeneficiaire">Nom du b&eacute;n&eacute;ficiaire</label>
              <input type="text" class="form-control" id="nomBeneficiaire" placeholder="Saisir le nom du b&eacute;n&eacute;ficiaire" size="40" maxlength="30">
            </div>
            <div class="form-group">
              <label for="IBAN b&eacute;n&eacute;ficiaire">IBAN du b&eacute;n&eacute;ficiaire</label>
              <br>
              <input type="text" id="codeBanqueBeneficiaire" size="6" maxlength="5" placeholder="Banque">
              <input type="text" id="codeGuichetBeneficiaire" size="6" maxlength="5" placeholder="Guichet">
              <input type="text" id="numeroCompteBeneficiaire" size="14" maxlength="11" placeholder="Num&eacute;ro compte">
              <input type="text" id="cleRIBBeneficiaire" size="3" maxlength="2" placeholder="RIB">
              <input type="text" id="agenceBeneficiaire" size="30" maxlength="31" placeholder="Agence">
            </div>
            <br>
            <input type="radio" id="supprimerBeneficiaire" name="typeModification" value="supprimerBeneficiaire">
            <label>  Supprimer un b&eacute;n&eacute;ficiaire </label>
             <div class="form-group">
              <br>
              <!-- Charger la liste des bénéficiaires externes -->
              <select name="listeBeneficiare" id="listeBeneficiare">
                <option value="beneficiaire1">beneficiaire1</option>
                <option value="beneficiaire2">beneficiaire2</option>
              </select>
            </div>
          </div>
        <br>
        <br>
        <a href="interfaceClientSyntheseCompte.php"><button type="button" class="btn btn-info">Annuler</button></a>
        <button type="submit" class="btn btn-danger">Valider</button>
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
