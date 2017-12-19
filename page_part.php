<?php
    // On démarre la session 
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
        <title>BIENVENUE DANS VOTRE ESPACE CLIENT</title>
    </head>
   
    <?php
        $query = "SELECT * FROM client WHERE identifiant_client = '".$_SESSION["identifiant_client"]."'";
        $result = $mysqli->query($query);
        $row = $result->fetch_array();
    ?>

    <body>
        <header>
            <div class="banniere_image"></div>
            <h1>BANQUECY <FONT color="#eaf50f">Espace Client</FONT> </h1>
            <h2>BIENVENUE DANS VOTRE ESPACE CLIENT <?php echo $_SESSION['civilite_client']. ' ' . $_SESSION['prenom_client']. ' ' . $_SESSION['nom_client'];?></h2> </br/>
        </header>
        <br>
        <?php require("menu_navigation.html");?>
	<br/>
    </body>

    <?php
        include("footer.html"); 
        $mysqli->close();
    ?>
</html>
