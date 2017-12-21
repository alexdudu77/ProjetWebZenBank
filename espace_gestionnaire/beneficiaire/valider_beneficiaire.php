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
        <title>Bénéficiaires de virement en attente de validation</title>
    </head>

    <header>
        <h1>BANQUECY <FONT color="#eaf50f">Espace Gestionnaire</FONT></h1>
        <h2> BENEFICIAIRES DE VIREMENT </h2>
        <p> Demande d'ajout en attente de validation</p>
    </header>

    <body>
        <table class= "tableau">
            <tr>
                <th> Nom du titulaire du compte</th>
                <th> Prénom du titulaire du compte </th>
                <th> IBAN </th>
                <th> Validation </th>
            </tr>
        <form method="post" action="validation_beneficiaire_cible.php">

    <?php
        $query="SELECT * FROM beneficiaire WHERE valide ='0'";
        $result = $mysqli->query($query);
        while ($row = $result->fetch_array())
            {
            echo "<tr>";
            echo "<td>". $row['nom_benef'] ."</td>";
            echo "<td>". $row['prenom_benef']."</td>";
            echo "<td>". $row['iban_benef']. "</td>";
            echo "<td><a href='validation_beneficiaire_cible.php?id=".$row['iban_benef']."''>Valider le bénéficiaire </a></td>";
            echo "</tr>";
            }
    ?>
    </table>
    
    <br>
 <br><br/>
<div class="nav"> <a href="../page_gestionnaire.php"><span>Revenir &agrave; l'espace gestionnaire </span> </div>
<div class="nav"> <a href="../../deconnexion.php">Se d&eacute;connecter</a>  </div>

    </body>
</html>
