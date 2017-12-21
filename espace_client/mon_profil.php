<?php 
  if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();  
  }

require("../mysql.php"); 

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="../style.css" type="text/css" media="screen"/>
        <title>ESPACE CLIENT : Votre Profil </title>
    </head>




    <body>

    <header>
    <div id="banniere_image"></div>
    
    	<h1>BANQUECY <FONT color="#eaf50f">Espace Client</FONT> </h1>
        <h2> VOTRE PROFIL </h2>
	</header>
 
    <h3> Informations et Coordonnées </h3>

<!-- J'affiche les informations personnelles du clients -->

    <?php 

        echo $_SESSION['civilite_client']. ' '. $_SESSION['prenom_client']. ' ' .$_SESSION['nom_client'];
    ?>
  
    <?php 


    $query ="SELECT adresse.numero_rue, adresse.rue, adresse.CP, adresse.ville, client.telephone_client AS telephone_client, client.mail_client AS mail_client
    FROM adresse
    JOIN habite 
    ON habite.id_adresse = adresse.id_adresse
    JOIN client
    ON client.id_client = habite.id_client
    WHERE client.identifiant_client = '".$_SESSION["identifiant_client"]."'";



    $result = $mysqli->query($query);
    $row = $result->fetch_array();


    ?>

    <ul class="menu_information">
    <li> Né(e) le : <?php echo $_SESSION['date_naissance']; ?> </li>
    <li> Mail : <?php echo $_SESSION['mail_client']; ?>  <span class="modifier"> <a href=page_modif_profil.php?Id=<?php echo $row['mail_client'];?>> ==> Modifier </a><br/></span></li>
    <br><li> Téléphone : <?php echo $_SESSION['telephone_client']; ?> <span class="modifier"> <a href=page_modif_profil.php?Id=<?php echo $row['telephone_client'];?>> ==> Modifier </a></span></li>

	<br><br/>
    <p> Adresse : </p>
    <li> N° et Rue : <?php echo $row['numero_rue'].' '. $row['rue']; ?> </li>
    <li> CP : <?php echo $row['CP']; ?> </li>
    <li> Ville : <?php echo $row['ville']; ?></li>

    </ul>

<br><br/>
<div class="nav"> 
<a href="../page_part.php"><span>Revenir à votre Espace Client </span> </div>

<?php
  include("../footer.html"); 
?>


    </body>

</html>