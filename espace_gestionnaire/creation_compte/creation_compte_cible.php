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
//echo $_SESSION['id_nvx_client'];

// je récupère les informations de mon client
$query5="SELECT * FROM client WHERE identifiant_client = '".$_SESSION['id_nvx_client']."'";
$result5= $mysqli->query($query5);
$row = $result5->fetch_assoc();

echo " <br> Vous êtes sur le point d'ouvrir compte pour ".$row['prenom_client'].' '.$row['nom_client']."</br>";
?>


<br> <form method="post" action="creation_compte_cible_cible.php"> <br/>
<label for="iban"> IBAN </label> :  <input type="text" name="iban" /><br />

<label for="autorisation_decouvert"> Autorisation de découvert </label> : <input type="text" name="autorisation_decouvert" /><br />



<label for="id_type_compte"> Type de compte </label> : 
       <select name="id_type_compte" id="id_type_compte">
       


<?php
$query="SELECT * FROM type_compte";
$result= $mysqli->query($query);

while ($row = $result->fetch_array())
{
 ?>

<option value="<?php echo $row['id_type_compte'];?>""><?php echo $row['nom_type'];?></option>

<?php           
}
$mysqli->close();
?>
<br> <input type="submit" name="action" value="Valider le compte"> </form></br>
    </body>
    <br>
<br><br/>
<div class="nav"> <a href="../page_gestionnaire.php"><span>Revenir &agrave; l'espace gestionnaire </span> </div>
<div class="nav"> <a href="../../deconnexion.php">Se d&eacute;connecter</a>  </div>
</html>