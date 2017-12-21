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
    <h2> OUVRIR UN COMPTE </h2>
    </header>
<body>


<p> Selectionner le client </p>

 <body>

        <table class= "tableau">
            <tr>
                <th> Nom </th>
                <th> Prénom </th>
                <th> Identifiant </th>
                <th> Raison Sociale </th>
                <th> Validation </th>
            </tr>

            <form method="post" action="creation_compte_cible.php">

        <?php
            $query="SELECT * FROM client WHERE actif_client='1'";
            $result = $mysqli->query($query);
            while ($row = $result->fetch_array())
            {
                echo "<tr>";
                echo "<td>". $row['nom_client'] ."</td>";
                echo "<td>". $row['prenom_client']."</td>";
                echo "<td>". $row['identifiant_client']. "</td>";
                echo "<td>". $row['raison_sociale']. "</td>";
                echo "<td><a href='creation_compte_cible.php?id=".$row['identifiant_client']."''> Ouvrir un compte </a></td>";
                echo "</tr>";
            }
        ?>                  
        </table>


    </body>
    <br>

    <br><br/>
<div class="nav"> <a href="../page_gestionnaire.php"><span>Revenir &agrave; l'espace gestionnaire </span> </div>
<div class="nav"> <a href="../../deconnexion.php">Se d&eacute;connecter</a>  </div>

</html>