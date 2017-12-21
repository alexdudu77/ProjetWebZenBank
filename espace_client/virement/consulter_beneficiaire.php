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
      <h2> CONSULTER MES BENEFICIAIRES </h2>
		 </header>


<table class= "tableau">
  <tr>
    <th> Titulaire </th>
    <th> IBAN </th>
  </tr>

<?php 

  $query= "SELECT * from beneficiaire where valide='1' AND id_client = '".$_SESSION['id_client']."'";
  $result = $mysqli->query($query);
  while ($row = $result->fetch_array())
  {      
    echo "<tr>";
    echo "<td>".$row['prenom_benef'] ." ".$row['nom_benef']. " <br/></td>";
    echo "<td>".$row['iban_benef']. "</a></td>";
    echo "</tr>";
   }

    $mysqli->close();

     
  ?>
      </table>





	<br><br/>
    <div class="nav"><a href="virement.php"><span>Revenir aux Virements</span> </div>
    <div class="nav"><a href="../../page_part.php"><span>Revenir à votre Espace Client </span> </div>

  
    <?php
    include("../../footer.html"); 
    ?>

      </body>

</html>