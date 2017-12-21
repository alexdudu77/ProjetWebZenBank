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
        <title>ESPACE CLIENT : Modifier votre profil </title>
    </head>


    <body>

    <header>
    <div id="banniere_image"></div>
    
    <h1>BANQUECY <FONT color="#eaf50f">Espace Client</FONT> </h1>
    <h2> Modifier vos informations de contact </h2>
	</header>



        <?php 

        echo $_SESSION['civilite_client']. ' '. $_SESSION['prenom_client']. ' ' .$_SESSION['nom_client'];
    ?>
    </div>
    <?php 


    $query ="SELECT mail_client,telephone_client FROM client WHERE identifiant_client = '".$_SESSION["identifiant_client"]."'";

    $result = $mysqli->query($query);

    	while ($row = $result->fetch_array())
    {
    	// Formulaire avec les champs pré-établis
    ?>


<p>	
<form action="modifier_post.php" method="post" id="modif_article">

<label for="mail_client">Votre Mail</label><br/>

	<input type="text" name="mail_client" value="<?php echo $row['mail_client'];?>" /><br/>

<label for="telephone_client">Votre Téléphone</label><br/>

	<input type="text" name="telephone_client" value="<?php echo $row['telephone_client'];?>" tabindex="20"/><br/>
 	<input type="submit" value="Valider" />

	      <?php
    
	     
// Fin de la boucle pour l'affichage des donnée dans la base de donnée
       $mysqli->close();
}

?>
</form>


<br><br/>
<div class="nav">  
<a href="../page_part.php"><span>Revenir à votre Espace Client </span> </div>

<?php
  include("../footer.html"); 
?>


    </body>

</html>