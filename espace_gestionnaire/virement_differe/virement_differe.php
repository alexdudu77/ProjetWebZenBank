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
     <title>VALIDER VIREMENT</title>
   </head>
 
 
   <header>
  <h1>BANQUECY <FONT color="#eaf50f">Espace Gestionnaire</FONT> </h1>
   <h2> VIREMENTS DU JOUR </h2>

   </header>
   <body>
 
 <table class= "tableau">
             <tr>
              <th> Titulaire du compte</th>
              <th> IBAN </th>
              <th> Montant </th>
              <th> Date du virement </th>
              <th> Valider le virement </th>
            </tr>
             
 <?php

 $query="SELECT operation.date_operation, operation.montant_operation, operation.type_operation, compte.iban, client.nom_client, client.prenom_client
 FROM compte
 JOIN operation
 ON operation.iban = compte.iban
 JOIN client 
 ON compte.id_client = client.id_client
 WHERE date_operation = CURRENT_DATE AND operation.type_operation = 'virement' AND operation.mouvement ='-' AND operation.commentaire='a venir'";
 
 $result = $mysqli->query($query); 
 while ($row = $result->fetch_array()){      
 
         echo "<tr>";
         echo "<td>".$row['prenom_client'].' '.$row['nom_client']. "</td>";
         echo "<td>".$row['iban']."</td>";
         echo "<td>".$row['montant_operation']." €</td>";
         echo "<td>".$row['date_operation']."</td>";
         echo "<td><a href='virement_differe_cible.php?id=".$row['iban']."''class='lien_tableau'> Valider </a></td>";
 }
 $mysqli->close();
 
 ?>
 </table>
 
 <br> <br/>
    <h2> VIREMENTS DIFFERES A VENIR </h2>

 <table class= "tableau">
             <tr>
              <th> Titulaire du compte</th>
              <th> IBAN </th>
              <th> Montant </th>
              <th> Date du virement </th>
            </tr>
             
 <?php
    require("../../mysql.php");
 $query2="SELECT operation.date_operation, operation.montant_operation, operation.type_operation, compte.iban, client.nom_client, client.prenom_client
 FROM compte
 JOIN operation
 ON operation.iban = compte.iban
 JOIN client 
 ON compte.id_client = client.id_client
 WHERE date_operation > CURRENT_DATE AND operation.type_operation = 'virement' AND operation.mouvement ='-' AND operation.commentaire='a venir'";
 
 $result2 = $mysqli->query($query2); 
 while ($row2 = $result2->fetch_array()){      
 
         echo "<tr>";
         echo "<td>".$row2['prenom_client'].' '.$row2['nom_client']. "</td>";
         echo "<td>".$row2['iban']."</td>";
         echo "<td>".$row2['montant_operation']." €</td>";
         echo "<td>".$row2['date_operation']."</td>";

 }
 $mysqli->close();
 
 ?>
 </table>

<br><br/>
<div class="nav"><a href="../page_gestionnaire.php"><span>Revenir &agrave; l'espace gestionnaire </span> </div>
<div class="nav"> <a href="../../deconnexion.php">Se d&eacute;connecter</a>  </div>
 
     </body>
 </html>
