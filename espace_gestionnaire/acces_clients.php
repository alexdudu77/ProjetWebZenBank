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
        <title>Menu de s&eacute;lection des clients</title>
    </head>

    <body>
        <header>
            <div id="banniere_image"></div>
                <h1>BANQUECY <FONT color="#eaf50f">Espace gestionnaire</FONT></h1>
                <h2> Merci de s&eacute;lectionner le client </h2>
	</header>

            <?php
            //$query1 = "SELECT * FROM client WHERE raison_sociale != 'NULL' ORDER BY raison_sociale ASC";
            $query1 = "SELECT sirss, raison_sociale FROM client WHERE type_client = 'ENT' ORDER BY raison_sociale ASC";
            $result1 = $mysqli->query($query1);
            ?>
            <form method="post" action="compte_client.php">
                <select name="pro">
                    <option value>Client entreprise : s&eacute;lectionner la raison sociale</option>
                    <?php
                        while ($row = $result1->fetch_assoc()){
                        echo "<option value=\"{$row['sirss']}\"> {$row['raison_sociale']}</option>";
                        }
                    ?>
                </select>
                <input type="submit" value="Valider" />
            </form>
            <br> <br>
            
            <?php
            $query2 = "SELECT sirss, nom_client FROM client WHERE type_client = 'PART' ORDER BY nom_client ASC";
            $result2 = $mysqli->query($query2);
            ?>
            <form method="post" action="compte_client.php">
                <select name="part">
                    <option value="">Client particulier : s&eacute;lectionner le nom</option>
                    <?php
                        while ($row = $result2->fetch_assoc()){
                        echo "<option value=\"{$row['sirss']}\"> {$row['nom_client']}</option>";
                        }
                    ?>
                </select>
                <input type="submit" value="Valider" />
            </form>
            <br>

    </body>
</html>
