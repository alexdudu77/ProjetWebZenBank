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
        <title>Autorisation de découvert</title>
    </head>
    <header>
    
    <h1>BANQUECY <FONT color="#eaf50f">Espace Gestionnaire</FONT></h1>
    <h2> AUTORISATION DE DECOUVERT DES CLIENTS </h2>
    </header>

    <body>

    <?php
$_SESSION['iban'] = isset($_SESSION['iban']) ? $_SESSION['iban'] : null;
$_SESSION['iban'] = isset($_GET['id']) ? $_GET['id'] : $_SESSION['iban'];

// Je récupère les coordonnées du client via l'iban 
$query="SELECT client.raison_sociale AS rs,client.civilite_client AS civilite,client.nom_client AS nom,client.prenom_client AS prenom,client.mail_client AS mail,client.telephone_client AS telephone,compte.solde AS solde,compte.autorisation_decouvert AS auto,compte.iban AS iban
FROM client
JOIN compte
ON client.id_client=compte.id_client WHERE iban ='".$_SESSION['iban']."'";

$result = $mysqli->query($query);
$row = $result->fetch_array();


?>
    <p>Modification de l'autorisation de découvert de <?php echo $row['civilite']. ' ' . $row['prenom']. ' ' . $row['nom'];?></p>
    <form method="post" action="validation_decouvert2.php">
    <label for='nvx_decouvert'> Nouveau découvert </label> :  <input type='text' name='nvx_decouvert' />
    <input type="submit" value="Valider" />


<?php

// Si le champs autorisation de découvert n'est pas vide
if (!(empty($_POST['nvx_decouvert'])))
 {
// je mets à jours le compte en banque avec le nouveau solde 
    $query2= "UPDATE compte SET autorisation_decouvert = '".$_POST['nvx_decouvert']."' WHERE iban = '".$_SESSION['iban']."'";
    $result2 = $mysqli->query($query2);
    echo "Le Solde du compte a bien &eacute;t&eacute; mis à jour. ";
 }
else echo "";

?> 
        </body>
<br><br/>
<div class="nav"> <a href="../page_gestionnaire.php"><span>Revenir &agrave; l'espace gestionnaire </span> </div>

</html>