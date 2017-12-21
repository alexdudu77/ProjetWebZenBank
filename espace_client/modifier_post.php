<?php 
  if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();  
  }


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

require("../mysql.php"); 

/*Si le champ "mail_client" est rempli*/
  
if (isset($_POST['mail_client']) AND $_POST['mail_client'] !== "")
    {  
  
/*Ensuite si le champ "telephone_client" est rempli*/

     if (isset($_POST['telephone_client']) AND $_POST['telephone_client'] !== "") 

       {
                               
/*On modifie que si c'est pas vide*/

        
    $query="UPDATE CLIENT SET mail_client = '".$_POST['mail_client']."',telephone_client = '".$_POST['telephone_client']."' WHERE identifiant_client = '".$_SESSION['identifiant_client']."'";

    $result = $mysqli->query($query);

    echo "Les Champs ont bien été modifiés.";
  
        }
 
 else
  
    {   
    echo '<p>Vous n\'avez pas remplis touts les champs demandés</p>';
       
    }
          }

    $mysqli->close();
?>


<p> <br>
<a href="../page_part.php"><span>Revenir à votre Espace Client </span> </p>

<?php
  include("../footer.html"); 
?>


    </body>

</html>