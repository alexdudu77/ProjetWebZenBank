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

$_SESSION['decouvert'] = isset($_SESSION['decouvert']) ? $_SESSION['decouvert'] : null;
$_SESSION['decouvert'] = isset($_POST['nvx_decouvert']) ? $_POST['nvx_decouvert'] : $_SESSION['decouvert'];


// Si le champs autorisation de découvert n'est pas vide
if (!(empty($_SESSION['decouvert'])))
 {
// je mets à jours le compte en banque avec le nouveau solde 
    $query2= "UPDATE compte SET autorisation_decouvert = '".$_SESSION['decouvert']."' WHERE iban = '".$_SESSION['iban']."'";
    $result2 = $mysqli->query($query2);
    echo "Le Solde du compte a bien été mis à jour. ";
 }
else echo "";

?> 


    </body>
<br>
<br><br/>
<div class="nav"><a href="../page_gestionnaire.php"><span>Revenir &agrave; l'espace gestionnaire </span> </div>

</html>