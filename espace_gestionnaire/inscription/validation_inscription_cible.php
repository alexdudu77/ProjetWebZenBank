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

require("../../mysql.php"); 
$_SESSION['id_nvx_client'] = isset($_SESSION['id_nvx_client']) ? $_SESSION['id_nvx_client'] : null;
$_SESSION['id_nvx_client'] = isset($_GET['id']) ? $_GET['id'] : $_SESSION['id_nvx_client'];
echo $_SESSION['id_nvx_client'];

/*
$query5="SELECT * FROM client WHERE identifiant_client = '".$_SESSION['id_nvx_client']."'";
$result5= $mysqli->query($query5);
$row = $result5->fetch_assoc();
*/
// Le gestionnaire ajoute manuellement l'iBAN et l'autorisation de découvert


// Je viens valider le compte client en modifiant le paramètre actif_client de 0 à 1
$query1="UPDATE client SET actif_client ='1' WHERE identifiant_client='".$_SESSION['id_nvx_client']."'";
$result1 = $mysqli->query($query1);


echo "<br> Le client a bien été créé. </br>";

mysqli_close($mysqli);
?>


<br><br/>
<div class="nav"> <a href="creation_compte/creation_compte.php?id2="><span> Pour ouvrir un compte en banque au client, cliquez-ici </span> </div>

</body>

<div class="nav"> <a href="../page_gestionnaire.php"><span>Revenir &agrave; l'espace gestionnaire </span> </div>

</html>