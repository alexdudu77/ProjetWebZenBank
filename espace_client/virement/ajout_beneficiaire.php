<?php 
  if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();  
  }
require("../../mysql.php"); 
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="../../style.css" type="text/css" media="screen"/>
        <title>ESPACE CLIENT : ajouter un bénéficiaire </title>
    </head>
    <header>
      <h1>BANQUECY <FONT color="#eaf50f">Espace Client</FONT> </h1>
      <h2> AJOUTER UN BENEFICIAIRE </h2>
    </header>

<?php 

$iban_benef = "";
  if (isset($_GET["id"]))
    {
    $iban_benef = $_GET["id"];
    }


  $query = "SELECT beneficiaire.iban_benef
                FROM compte
                JOIN beneficiaire 
                ON compte.id_client = beneficiaire.id_client WHERE beneficiaire.id_client = '".$_SESSION["id_client"]."' AND beneficiaire.iban_benef = '" .$iban_benef."'";

  $result = $mysqli->query($query);
  $row = $result->fetch_array();
  $rowcount = mysqli_num_rows($result);

// je récupère les informations de mon futur bénéficiaire
$query2 = "SELECT client.nom_client AS nom_benef, client.prenom_client AS prenom_benef, compte.iban FROM client JOIN compte ON client.id_client = compte.id_client WHERE compte.iban = '".$iban_benef."'";
$result2 = $mysqli->query($query2);
$row2 = $result2->fetch_array();


  if (($result->num_rows == 0) AND (empty($_SESSION['raison_sociale'])))
    { 
      echo "Nous avons bien pris en compte votre demande d'ajout bénéficiaire. Celui-ci sera validé sous 48h par le gestionnaire de votre compte. ";

    $query2= "INSERT INTO beneficiaire (iban_benef,id_client,prenom_benef,nom_benef,valide) 
             VALUES ('".$iban_benef."','".$_SESSION["id_client"]."','".$row2['prenom_benef']."','".$row2['nom_benef']."','0')";

    $result2 = $mysqli->query($query2);
    }
    

      else if (($result->num_rows == 0) AND (!(empty($_SESSION['raison_sociale']))))
      {
      echo "Nous avons bien pris en compte votre demande d'ajout bénéficiaire. Celui-ci sera effectif sous 48h.";

      $query3= "INSERT INTO beneficiaire (iban_benef,id_client,prenom_benef,nom_benef,valide) 
                VALUES ('".$iban_benef."','".$_SESSION["id_client"]."','".$row2['prenom_benef']."','".$row2['nom_benef']."','1')";
                $result3 = $mysqli->query($query3);
      }
            
   
      else 
      {
        echo "Ce compte fait déjà partie de vos bénéficiaires";
      }
            
 


  mysqli_close($mysqli);
?>
<br><br/>
<div class="nav"> <a href="../../page_part.php"><span>Revenir à votre Espace Client </span> </div>
<?php
  include("../../footer.html"); 
?>

  </body>
</html>