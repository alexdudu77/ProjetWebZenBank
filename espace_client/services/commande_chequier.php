<?php 
// On démarre la session 
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
        <title>BIENVENUE DANS VOTRE ESPACE CLIENT</title>
    </head>
   

  <body>

    <header>
    <div class="banniere_image"></div>
    	<h1>BANQUECY <FONT color="#eaf50f">Espace Client</FONT> </h1>
      <h2>VOS SERVICES </h2> </br/>
         



<?php
// Date à laquelle on demande le chéquier (cf formulaire)
  $datecommande = "";
            if (isset($_GET["id"]))
            {
                    $datecommande = $_GET["id"];
            }
?> 
<?php

$query2="SELECT max(chequier.date_commande) AS date_dernier_chequier, client.raison_sociale AS RS FROM chequier JOIN client ON chequier.id_client = client.id_client WHERE client.id_client = '".$_SESSION['id_client']."'";
$result2 = $mysqli->query($query2);
$row = $result2->fetch_assoc();

$query4="SELECT * FROM chequier JOIN client ON chequier.id_client = client.id_client WHERE client.id_client = '".$_SESSION['id_client']."'";
$result4 = $mysqli->query($query4);
$rowcount = mysqli_num_rows($result4);


// Date du dernier chéquier commandé en Base de donnée
$datedernier = $row['date_dernier_chequier'];
// Date du dernier chéquier commandé + 30 jours 
$dateplus = date("Y-m-d", strtotime("$datedernier +30days")); // la variable ne marche pas car avec now ca fonctionne

// requete me permettant de récupérer la 3ème commande de chéquier en partant du bas
$query5="SELECT date_commande FROM chequier WHERE id_client='".$_SESSION['id_client']."' ORDER BY id_chequier DESC LIMIT 2,1";
$result5 = $mysqli->query($query5);
$row5 = $result5->fetch_array();
echo $row5['date_commande'];


// S'il n'a jamais commandé de chéquier : 

if (empty($datedernier))
{ $query="INSERT INTO chequier (date_commande,id_client) VALUES ('".$datecommande."','".$_SESSION['id_client']."')";
  $result = $mysqli->query($query);
 
    echo " Votre demande de chéquier a bien été prise en comtpe. <div>Son traitement est en cours, vous le recevrez directement chez vous. </div>";

}

// Je vérifie que mon client soit un particulier et que la date de la dernière commande de chéquier est supérieure à 30 jours
else if (empty($row['RS']) && ($datecommande > $dateplus))
  {
    echo " Votre demande de chéquier a bien été prise en comtpe. Son traitement est en cours, vous le recevrez directement chez vous";
    $query3="INSERT INTO chequier (date_commande,id_client) VALUES ('".$datecommande."','".$_SESSION['id_client']."')";
  	$result = $mysqli->query($query3);
  }
  
  // Mon client est un professionnel, je vérifie qu'il pas plus de 3 chéquier mais comment gérer la date ?? 
  else if ((!(empty($row['RS'])) && ($result4->num_rows <= 2) && ($datecommande > $row5['date_commande'])))
  {
  echo "Votre demande de chéquier a bien été prise en compte.";
  $query="INSERT INTO chequier (date_commande,id_client) VALUES ('".$datecommande."','".$_SESSION['id_client']."')";
  $result = $mysqli->query($query);
  }
  
  else { echo "Vous avez trop de chéquier en commande.";
  }
    mysqli_close($mysqli);
?>

  </body>
  <p> <a href="../../page_part.php"><span>Revenir &agrave; votre Espace Client </span> </p>
<?php
  include("../../footer.html"); 
?>

</html>