
<html lang="fr">
<head>
  <title>Vos informations</title>
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

<?php
  include("interfaceClientEnTete.php");
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Controle sur la civilité qui ne peut être mise sur le composant directement
    if ((!isset($_POST["telephoneMobileClient"]) && !isset($_POST["telephoneFixeClient"]))
      || ($_POST["telephoneMobileClient"] == null && $_POST["telephoneFixeClient"] == null)
    ) {
      $err = "Un mobile ou un fixe est obligatoire";
    }

    if (!isset($err)){

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

			if (miseAJourClient($_SESSION['id'], $portable, $fixe, $adresse, $cp, $ville)) {
          header('Location:interfaceClientSyntheseCompte.php?id='.$_SESSION['id']);
			}
      else{
        $err = "Erreur SQL";
			}

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
          <div id="collapseOne" class="panel-collapse collapse in">
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
      <h2>Mise à jour de vos informations personnelles</h2>
      <br>
      <div class="col-md-6">
      <form method="post" action="">
        <div style="color:red">
          <?php  if (isset($err)) { echo $err; } ?>
        </div>
        <br>
        <!-- Formulaire de modification des informations personnelles -->
        <!-- Charger les informations du client -->
        <?php
          require "interfaceClientInformationsTraitement.php";
          afficherMesInformations($_SESSION['id']);
        ?>
        <a href="interfaceClientSyntheseCompte.php"><button type="button" class="btn btn-info">Annuler</button></a>
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
