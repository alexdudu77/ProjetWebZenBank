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
        <title>Inscription en attente de validation</title>
    </head>
    <header>
    
    <h1>BANQUECY <FONT color="#eaf50f">Espace Gestionnaire</FONT></h1>
    <h2> DEMANDE D'OUVERTURE DE COMPTE EN ATTENTE </h2>
    </header>
<body>


<?php

// je récupère les informations de mon client
$query5="SELECT * FROM client WHERE identifiant_client = '".$_SESSION['id_nvx_client']."'";
$result5= $mysqli->query($query5);
$row = $result5->fetch_assoc();
// je viens récupérer toutes les informations de mon client, notamment l'id_client auto_incrément 

if (empty($_POST['iban']) OR (empty($_POST['autorisation_decouvert']))) 
{
  echo "<br> Tous les champs doivent être remplis pour valider la création du compte. </br>";
}

else { 

// Je créer un compte chèque au client 
$query3="INSERT INTO compte (id_client,id_type_compte,solde,iban,autorisation_decouvert) VALUES ('".$row['id_client']."','".$_POST['id_type_compte']."','0','".$_POST['iban']."','".$_POST['autorisation_decouvert']."')";

$result3 = $mysqli->query($query3);


echo "Le compte a bien été ouvert.";
}

mysqli_close($mysqli);
?>
    </body>
    <br>
<br><br/>
<div class="nav"> <a href="../page_gestionnaire.php"><span>Revenir &agrave; l'espace gestionnaire </span> </div>
<div class="nav"> <a href="../../deconnexion.php">Se d&eacute;connecter</a>  </div>
</html>