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
        <title>Autorisation de découvert</title>
    </head>
    <header>
    
    <h1>BANQUECY <FONT color="#eaf50f">Espace Gestionnaire</FONT></h1>
    <h2> AUTORISATION DE DECOUVERT DES CLIENTS </h2>
    </header>

    <body>
        <table class= "tableau">
            <tr>
                <th> Nom </th>
                <th> Prénom </th>
                <th> Raison Sociale </th>
                <th> Iban </th>
                <th> Autorisation de découvert </th>
                <th> Solde </th>
                <th> Modifier </th>
            </tr>

        <?php 
        // je récupère tous les comtpes clients validés, pro et part
            $query="SELECT client.raison_sociale AS rs,client.civilite_client AS civilite,client.nom_client AS nom,client.prenom_client AS prenom,client.mail_client AS mail,client.telephone_client AS telephone,compte.solde AS solde,compte.autorisation_decouvert AS auto,compte.iban AS iban
                    FROM client
                    JOIN compte
                    ON client.id_client=compte.id_client";
            $result = $mysqli->query($query);
            while ($row = $result->fetch_array())
            {
                echo "<tr>";
                echo "<td>". $row['nom'] ."</td>";
                echo "<td>". $row['prenom']."</td>";
                echo "<td>". $row['rs']. "</td>";
                echo "<td>". $row['iban']. "</td>";
                echo "<td>". $row['auto']. " €<br/></td>";
                echo "<td>". $row['solde']. " €</td>";
               // echo "<td>". $row['auto']. "</td>";
                echo "<td><a href='validation_decouvert.php?id=".$row['iban']."''>Valider</a></td>";
                echo "</tr>";
            }
        // On r�cup�re le compte dont on souhaite changer l'autorisation via l'iban
        ?>

        </table>
    </body>
    <br>
<br><br/>
<div class="nav"><a href="../page_gestionnaire.php"><span>Revenir &agrave; l'espace gestionnaire </span> </div>
<div class="nav"> <a href="../../deconnexion.php">Se d&eacute;connecter</a>  </div>

</html>