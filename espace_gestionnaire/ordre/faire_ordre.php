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
    <title>ESPACE CLIENT : Faire un Virement</title>
  </head>


  <header>
  <h1>BANQUECY <FONT color="#eaf50f">Espace Gestionnaire</FONT> </h1>
  <h2> PASSER UN ORDRE </h2>

  </header>
  <body>





<?php 
  // Je créé mes variables $emetteur et $recepteur à partir des $_POST que j'ai récupéré sur la page passer_ordre.php. Les valeurs sont l'IBAN des comtes. 
  $emetteur = "";
  if (isset($_POST["compte_emetteur"]))
    {
    $emetteur = $_POST["compte_emetteur"];
    }

  $recepteur = "";
  if (isset($_POST["compte_recepteur"]))
    {
    $recepteur = $_POST["compte_recepteur"];
    }
  $datejour=date('Y,m,d');

// je récupère les éléments de mon compte emetteur 
  $query2="SELECT * FROM compte WHERE iban ='".$emetteur."'";
  $result2=$mysqli->query($query2);
  $row2 = $result2->fetch_array();



// je vérifie si mes champs sont vides pour afficher une erreur
    if ((empty($emetteur)) OR (empty($recepteur)) OR (empty($_POST['montant']))) //OR (empty($_POST['date_vir'])
    {
    echo "Veuillez selectionnez deux comptes et rentrer un montant et une date.";
    }

// je vérifie que mes comptes récepteur et emetteur sont bien différents
    else if (!($emetteur != $recepteur))
    {
    echo "Veuillez choisir un compte émetteur diff&eacute;rent du compte r&eacute;cepteur.";
    }

 else if (($row2['autorisation_decouvert']+$row2['solde']) >= $_POST["montant"])
    {

      // SI OK : J'insère mon opération dans la table opérations sur mes deux comptes
    $query3="INSERT INTO operation (type_operation,mouvement,montant_operation,iban,date_operation) 
    VALUES 
    ('virement','-','".$_POST['montant']."','".$emetteur."','".$datejour."'),
    ('virement','+','".$_POST['montant']."','".$recepteur."','".$datejour."')";
    $result3=$mysqli->query($query3);


// Je mets à jour les soldes des comptes emetteur et recepteur
    $query4= "UPDATE compte SET solde = solde - '".$_POST['montant']."' WHERE iban = '".$emetteur."'";
    $result4 = $mysqli->query($query4);
    $query5= "UPDATE compte SET solde = solde + '".$_POST['montant']."' WHERE iban = '".$recepteur."'";
    $result5 = $mysqli->query($query5);
    
    echo "Le virement a bien &eacute;t&eacute; effectu&eacute;.";
    } 

    else echo "Votre virement ne peut pas être effectu&eacute;.";
    mysqli_close($mysqli);
?>


<br><br/>
<div class="nav"> <a href="../page_gestionnaire.php"><span>Revenir &agrave; l'espace gestionnaire </span> </div>
<div class="nav"> <a href="../../deconnexion.php">Se d&eacute;connecter</a>  </div>

  </body>
</html>