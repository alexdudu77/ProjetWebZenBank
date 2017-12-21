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
    <h2> VALIDATION DES BENEFICIAIRES </h2>
    </header>
<body>

<?php

require("../../mysql.php"); 


$_SESSION['iban_benef_v'] = isset($_SESSION['iban_benef_v']) ? $_SESSION['iban_benef_v'] : null;
$_SESSION['iban_benef_v'] = isset($_GET['id']) ? $_GET['id'] : $_SESSION['iban_benef_v'];


// Validation du bénéficiaire 
$query1="UPDATE beneficiaire SET valide ='1' WHERE iban_benef = '".$_SESSION['iban_benef_v']."'";
$result1 = $mysqli->query($query1);
echo "Le bénéficiaire a bien &eacute;t&eacute; valid&eacute;. Le client peut d&eacute;sormais r&eacute;aliser un virement."; 

?>

</body>
<br>
<br><br/>
<div class="nav"> <a href="../page_gestionnaire.php"><span>Revenir &agrave; l'espace gestionnaire </span> </div>

</html>