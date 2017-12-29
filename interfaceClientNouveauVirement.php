<html lang="fr">
<head>
  <title>Nouveau virement</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="styleInterfaceClient.css">
</head>
<body>

<?php
  include("interfaceClientEnTete.php");
  // Le code est ici car le start session et le require sont dans le php d'en tête ci dessus
  require "interfaceClientNouveauVirementTraitement.php";
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $err = demandeVirement($_POST['listeCompte'], $_POST['listeBeneficiaire'], $_POST['montantVirement'], $_POST['dateVirement'], $_POST['motifVirement']);
    if ($err == "") {
        header("location:interfaceClientHistoriqueVirement.php?numerocompte=".$_POST['listeCompte']);
    }
  }
?>

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
      <!-- Formulaire de nouveau virement -->
      <br>
      <div class="col-md-3">
      <form method="post" action="">
        <div style="color:red">
          <?php
            if (isset($err)){
              echo $err;
            }
          ?>
        </br>
        </div>
        <div class="form-group">
          <label for="compteADebiter">Compte &agrave; d&eacute;biter</label>
          <br>
          <!-- Charger la liste des comptes du client -->
          <?php afficherListeMesComptes($_SESSION['id']); ?>
        </div>
        <div class="form-group">
          <!-- Charger la liste des bénéficiaires -->
          <label for="compteACrediter">B&eacute;n&eacute;ficiaire</label>
          <br>
          <?php afficherListeComptesBeneficiaires($_SESSION['id']); ?>
        </div>
        <div class="form-group">
          <label for="dateVirement">Date de virement </label>
          <input type="date" class="form-control" name="dateVirement" required>
        </div>
        <div class="form-group">
          <label for="montantVirement">Montant du virement </label>
          <div class="input-group">
            <input type="number" class="form-control" aria-label="Montant en €" name="montantVirement" min="1" max="1000" required>
            <span class="input-group-addon">€</span>
          </div>
        </div>
        <div class="form-group">
          <label for="motifVirement">Motif du virement </label>
          <input type="text" class="form-control" name="motifVirement" required>
        </div>
        <a href="interfaceClientSyntheseCompte.php"><button type="button" class="btn btn-info">Annuler</button></a>
        <button type="submit" class="btn btn-danger">Envoyer virement</button>
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
