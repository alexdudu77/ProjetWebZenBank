<?php 
    if (session_status() != PHP_SESSION_ACTIVE) {
        session_start();  
    }
    require("mysql.php"); 
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style.css" type="text/css" media="screen"/>
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
            <h1>BANQUECY </h1>
            <h2> Bonjour <?php echo $row['prenom_employe'];?>, bienvenue dans l'espace gestionnaire</h2> </br>
        </header>

        <br>
        <nav>
            <ul id="sous_menu">
                <li> <a href="espace_gestionnaire/comptes_clients.php" > Acc&eacute;der aux comptes clients </a></li>
                <li><a href="espace_gestionnaire/Modifier_info_clients.php"> Modifier les informations clients </a></li>
            </ul>
            </nav>
        <br/>
    </body>
</html>
