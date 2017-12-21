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

	 <body>
   	<header>
    	  <h1>BANQUECY <FONT color="#eaf50f">Espace Client</FONT> </h1>
        <h2> AJOUTER UN BENEFICIAIRE </h2>
		</header>

  <p>
      Vous pouvez ajouter un bénéficiaire afin d’effectuer des virements vers d'autres clients de la BANQUECY.
    </br>
      L'ajout d’un bénéficiaire peut nécessiter un délai de 48h (hors week-ends et jours fériés).
    </br>
    </br>
    Veuillez sélectionner un client parmi la liste ci-dessous : 
  </p>


    <?php
// Je récupère les clients différents de mon client et qui sont bien validés. 
      $query = "SELECT client.nom_client, client.prenom_client, compte.iban FROM client JOIN compte ON client.id_client = compte.id_client WHERE client. identifiant_client != '".$_SESSION["identifiant_client"]."' AND client.actif_client ='1'";
      $result = $mysqli->query($query);

      $row = $result->fetch_array();
    ?>

<table class= "tableau">
            <tr>
                <th> Titulaire </th>
                <th> IBAN </th>
            </tr>

<?php 
       while ($row = $result->fetch_array()){      
                echo "<tr>";
                echo "<td>".$row['prenom_client'].' '.$row['nom_client']."</td>";
                echo "<td><a href='ajout_beneficiaire.php?id=".$row['iban']."'' class ='lien_tableau'>". $row['iban'] ."</a></td>";
                echo "</tr>";
            }
            $mysqli->close();
        ?>
     
</table>


		<br/>
		<div class="nav"><a href="../../page_part.php"><span>Revenir à votre Espace Client </span> </div>
	

<?php
  include("../../footer.html"); 
?>
      </body>
</html>
