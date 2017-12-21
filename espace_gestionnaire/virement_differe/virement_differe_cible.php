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
     <title>VALIDER VIREMENT</title>
   </head>
 
 
   <header>
  <h1>BANQUECY <FONT color="#eaf50f">Espace Gestionnaire</FONT> </h1>
   <h2> VALIDER LES VIREMENTS </h2>

   </header>
   <body>

<?php
$_SESSION['iban_emetteur'] = isset($_SESSION['iban_emetteur']) ? $_SESSION['iban_emetteur'] : null;
$_SESSION['iban_emetteur'] = isset($_GET['id']) ? $_GET['id'] : $_SESSION['iban_emetteur'];

// Je récupère l'id de mon opération du compte emetteur
$query="SELECT operation.date_operation, operation.id_operation, operation.montant_operation, operation.type_operation, compte.iban, client.nom_client, client.prenom_client
 FROM compte
 JOIN operation
 ON operation.iban = compte.iban
 JOIN client 
 ON compte.id_client = client.id_client
 WHERE operation.iban= '".$_SESSION['iban_emetteur']."' AND operation.date_operation=CURRENT_DATE";

$result= $mysqli->query($query);
$row = $result->fetch_array();

// Je récupère l'iban du compte récepteur 
$query2="SELECT id_operation, montant_operation FROM operation WHERE id_operation='".$row['id_operation']."' + 1";
$result2= $mysqli->query($query2);
$row2 = $result2->fetch_array();


// Je fais le virement

$query3="UPDATE operation SET commentaire ='virement effectué' WHERE id_operation='".$row['id_operation']."'";
$result3= $mysqli->query($query3);
$query4="UPDATE operation SET commentaire ='virement effectué' WHERE id_operation='".$row2['id_operation']."'";
$result4 = $mysqli->query($query4);


$query5= "UPDATE compte SET solde = solde - '".$row['montant_operation']."' WHERE id_operation='".$row['id_operation']."'";
$result5= $mysqli->query($query5);
$query6= "UPDATE compte SET solde = solde + '".$row2['montant_operation']."' WHERE id_operation='".$row2['id_operation']."'";
$result6= $mysqli->query($query6);

echo "Le virement a bien été effectué.";



?>
<br><br/>
<div class="nav"> <a href="page_gestionnaire.php"><span>Revenir &agrave; l'espace gestionnaire </span> </div>
<div class="nav"> <a href="../../deconnexion.php">Se d&eacute;connecter</a>  </div>
 
     </body>
 </html>
