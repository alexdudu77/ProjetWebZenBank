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
        <title>Modification des donn&eacute;es des clients</title>
    </head>

    <body>
        <header>
            <h1>BANQUECY <FONT color="#eaf50f">Espace gestionnaire</FONT> </h1>
	</header>

        <?php
            $_POST['sirss'];
            $query1 = "UPDATE client SET nom_client = '".$_POST['nouveauNom']."' WHERE sirss = '".$_POST['sirss']."'";
            $query2 = "UPDATE client SET prenom_client = '".$_POST['nouveauPrenom']."' WHERE sirss = '".$_POST['sirss']."'";
            $query3 = "UPDATE client SET date_naissance = '".$_POST['nouvelleDaten']."' WHERE sirss = '".$_POST['sirss']."'";
            $query4 = "UPDATE client SET mail_client = '".$_POST['nouveauMail']."' WHERE sirss = '".$_POST['sirss']."'";
            $query5 = "UPDATE client SET telephone_client = '".$_POST['nouveauTel']."' WHERE sirss = '".$_POST['sirss']."'";
            $query6 = "UPDATE client SET id_agence = '".$_POST['nouvelleAgence']."' WHERE sirss = '".$_POST['sirss']."'";

            if ((!empty ($_POST['nouveauNom'])))
            {
                $result1 = $mysqli->query($query1);
                echo "Le nom a &eacutet&eacute modifi&eacute<br/><br/>";
            }
            if ((!empty ($_POST['nouveauPrenom'])))
            {
                $result2 = $mysqli->query($query2);
                echo "Le pr&eacutenom a &eacutet&eacute modifi&eacute<br/><br/>";
            }
            if ((!empty ($_POST['nouvelleDaten'])))
            {
                $result3 = $mysqli->query($query3);
                echo "La date de naissance a &eacutet&eacute modifi&eacutee<br/><br/>";
            }
            if ((!empty ($_POST['nouveauMail'])))
            {
                $result4 = $mysqli->query($query4);
                echo "L'adresse mail a &eacutet&eacute modifi&eacutee<br/><br/>";
            }
            if ((!empty ($_POST['nouveauTel'])))
            {
                $result5 = $mysqli->query($query5);
                echo "Le num&eacutero de t&eacutel&eacutephone a &eacutet&eacute modifi&eacute<br/><br/>";
            }
            if ((!empty ($_POST['nouvelleAgence'])))
            {
                $result6 = $mysqli->query($query6);
                echo "L'agence du client a &eacutet&eacute modifi&eacutee<br/><br/>";
            }

            $mysqli->close();
        ?>

        <p> <a href="page_gestionnaire.php"><span>Revenir &agrave; l'espace gestionnaire </span> </p>
        <p> <a href="../deconnexion.php">Se d&eacute;connecter</a> </p>
        
    </body>
</html>
