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
        <title>ESPACE GESTIONNAIRE</title>
    </head>

    <?php
        $query = "SELECT * FROM employe WHERE prenom_employe = '".$_SESSION['prenom_employe']."'";
        $result = $mysqli->query($query);
        $row = $result->fetch_array();
    ?>    
    
    <body>
        <header>
            <div class="banniere_image"></div>
            <h1>BANQUECY <FONT color="#eaf50f">Espace Gestionnaire</FONT> </h1>
            <h2> Bonjour <?php echo $row['prenom_employe'];?> <?php echo $row['nom_employe'];?> </h2> </br>
        </header>

        <br>
        <nav>
            <ul id="sous_menu">
                <li> <a href="acces_clients.php" > Comptes clients </a></li>
                <li><a href="creation_client/creation_client.php"> Cr&eacute;er une fiche client </a></li>
                <li><a href="inscription/valider_inscription.php"> Demande d'inscription client </a></li>
                <li><a href="creation_compte/creation_compte.php"> Ouvrir un compte </a></li>
                <li><a href="beneficiaire/valider_beneficiaire.php"> B&eacute;n&eacute;ficiaire de virement </a></li>
                <li><a href="ordre/passer_ordre.php"> Passer des ordres </a></li>
                <li><a href="decouvert/Parametrer_decouvert.php"> Autorisations de d&eacute;couvert </a></li>
                <li><a href="virement_differe/virement_differe.php"> Virements diff&eacute;r&eacute;s </a></li>
                
            </ul>
            </nav>
        <br/>
        <p> <a href="../deconnexion.php">Se d&eacute;connecter</a>  </p>
    </body>
</html>
