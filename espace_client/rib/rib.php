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
        <title>ESPACE CLIENT : éditer un RIB </title>
    </head>
    
<body>
   	<header>
    	<h1>BANQUECY <FONT color="#eaf50f">Espace Client</FONT> </h1>
        <h2> Editer un RIB </h2>
	</header>
<p> Selectionner le compte dont vous souhaitez éditer le RIB : </p>

 <table class= "tableau">
            <tr>
                 <th> Titulaire </th>
                 <th> Raison Sociale </th>
                 <th> IBAN </th>
                 <th> Solde </th>
                
            </tr>
            
            
<?php
	require("../../mysql.php"); 
    $query="SELECT client.nom_client AS nom,client.prenom_client AS prenom, client.raison_sociale AS RS, compte.solde AS solde, compte.iban AS iban
FROM client
JOIN compte 
ON client.id_client=compte.id_client
WHERE client.actif_client = '1' AND compte.id_client = '".$_SESSION['id_client']."'";

    $result = $mysqli->query($query);

    while ($row = $result->fetch_array())
    {
        echo "<tr>";
                echo "<td>".$row['prenom'].' '. $row['nom'] ."</td>";
                echo "<td>". $row['RS']. "</td>";
                echo "<td><a href='rib_cible.php?id=".$row['iban']."'' class='lien_tableau'>". $row['iban'] ."</a></td>";
                echo "<td>". $row['solde'] ."<br/></td>";
                echo "</tr>";
    }
?>                  
    </table>

<br><br/>
<div class="nav"><a href="../../page_part.php"><span>Revenir à votre Espace Client </span> </div>
	
<?php
  include("../../footer.html"); 
?>

</body>

</html>