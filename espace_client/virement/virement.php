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
        <title>ESPACE CLIENT : Virements</title>
    </head>


	<body>

    <header>
    
    	 <h1>BANQUECY <FONT color="#eaf50f">Espace Client</FONT> </h1>
            <h2> VIREMENTS </h2>



             <ul id="menu_virement"> 
    	

  		  <li><a href="beneficiaire.php">  Ajouter un bénéficiaire </a></li> <br />
  			
  			<li> <a href="consulter_beneficiaire.php" > Consulter mes bénéficiaires </a></li>  <br />

  			<li> <a href="virement_compte.php" > Faire un virement </a></li>  <br />
		
  		
  	
        </ul>


   <div class="nav"> <a href="../../page_part.php"><span>Revenir à votre Espace Client </span> </div>
	
  <?php
  include("../../footer.html"); 
  ?>

 	</body>

</html>