<?php 
// On démarre la session 
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
        <title>BIENVENUE DANS VOTRE ESPACE CLIENT</title>
    </head>
   

<?php
$datejour=date("Y-m-d");

?>

  <body>
  <header>
    	<h1>BANQUECY <FONT color="#eaf50f">Espace Client</FONT> </h1>
      <h2>VOS SERVICES - Commander un nouveau chéquier </h2> </br/>
  </header>

  <div> Vous souhaitez commander un nouveau chéquier ? </div>
  <div> Faites en la demande en cliquant ci-dessous. Le chéquier sera livré directement chez vous. </div> 
  <br>
    

    
 <a href="commande_chequier.php?<?php echo"id=".$datejour.''?>"> ==> Commander un chequier.
<br><br/>
<div class="nav"> <a href="../../page_part.php"><span>Revenir &agrave; votre Espace Client </span></div>


</body>

<?php
  include("../../footer.html"); 
    $mysqli->close();
?>


</html>
