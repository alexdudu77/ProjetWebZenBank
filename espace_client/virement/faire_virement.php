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
  <h1>BANQUECY <FONT color="#eaf50f">Espace Client</FONT> </h1>
  <h2> VIREMENT </h2>
  </header>
  <body>



<?php 
  // Je créé mes variables $emetteur et $recepteur à partir des $_POST que j'ai récupéré sur la page virement_compte.php. Les valeurs sont l'IBAN des comtes. 
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

  $datevir = "";
  if (isset($_POST["date_vir"]))
    {
    $datevir = $_POST["date_vir"];
    }






   // Je récupère les informations de mon compte grâce à l'iban et l'id client
      $query = "SELECT * FROM compte WHERE  id_client = '".$_SESSION["id_client"]."' AND iban = '".$emetteur."'";
      $result = $mysqli->query($query);
      $row = $result->fetch_array();
    // je paramétre la date du jour   
      $datejour=date('Y-m-d');

    // je récupère les éléments de mon compte emetteur 
      $query2="SELECT * FROM compte WHERE iban ='".$emetteur."'";
      $result2=$mysqli->query($query2);
      $row2 = $result2->fetch_array();

      



    // vérifie si la date est inférieure à la date du jour
   if ($datevir < $datejour)   
     {
      echo "La date du virement ne peut pas être inférieur à la date du jour";
     }
     
     
     
     
 // SI VIREMENT AUJOURDHUI
    else if ($datevir == $datejour)   
    {

         // je vérifie si mes champs sont vides pour afficher une erreur
        if ((empty($emetteur)) OR (empty($recepteur)) OR (empty($_POST['montant']))) //OR (empty($_POST['date_vir'])
        {
         echo "Veuillez selectionnez deux comptes et rentrer un montant et une date";
        }

        // je vérifie que mes comptes récepteur et emetteur sont bien différents
        else if (!($emetteur != $recepteur))
        {
        echo "Veuillez choisir un compte émetteur différent du compte récepteur";
        }

  
        // Je vérifie si mon compte emetteur est un particulier, si le montant est inférieur à 1001€ et si le solde du compte + autorisation découvert est positif
        else if ((empty($row2['raison_sociale'])) AND ($_POST["montant"] < 10001) AND (($row['autorisation_decouvert']+$row['solde']) >= $_POST["montant"]))
        {

        // SI OK : J'insère mon opération dans la table opérations sur mes deux comptes
       $query3="INSERT INTO operation (type_operation,mouvement,montant_operation,iban,date_operation) 
     VALUES 
        ('virement','-','".$_POST['montant']."','".$emetteur."','".$datevir."'),
        ('virement','+','".$_POST['montant']."','".$recepteur."','".$datevir."')";
        $result3=$mysqli->query($query3);


        // Je mets à jour les soldes des comptes emetteur et recepteur
      $query4= "UPDATE compte SET solde = solde - '".$_POST['montant']."' WHERE iban = '".$emetteur."'";
      $result4 = $mysqli->query($query4);
      $query5= "UPDATE compte SET solde = solde + '".$_POST['montant']."' WHERE iban = '".$recepteur."'";
      $result5 = $mysqli->query($query5);
    
     echo "Le virement a bien été effectué. ";
     } 


      // Je vérifie si mon compte emetteur est un pro et si le solde est positif
      else if ((!(empty($row2['raison_sociale']))) AND (!($row['autorisation_decouvert']+$row['solde']) >= $_POST["montant"]))
        {

       $query5="INSERT INTO operation (type_operation,mouvement,montant_operation,iban,date_operation) 
     VALUES 
    ('virement','-','".$_POST['montant']."','".$emetteur."','".$datevir."'),
    ('virement','+','".$_POST['montant']."','".$recepteur."','".$datevir."')";
   $result5=$mysqli->query($query5);
    
    // Je mets à jour les soldes des comptes emetteur et recepteur
      $query6= "UPDATE compte SET solde = solde - '".$_POST['montant']."' WHERE iban = '".$emetteur."'";
      $result6 = $mysqli->query($query6);


     $query7= "UPDATE compte SET solde = solde + '".$_POST['montant']."' WHERE iban = '".$recepteur."'";
     $result7= $mysqli->query($query7);
      echo "Votre virement a bien été effectué.";
      } 
    else echo "Votre virement ne peut pas être effectué";

   }
    




    // SI VIREMENT DIFFERE 
    else if ($datevir > $datejour) 
    {
       // je vérifie si mes champs sont vides pour afficher une erreur
      if ((empty($emetteur)) OR (empty($recepteur)) OR (empty($_POST['montant']))) //OR (empty($_POST['date_vir'])
     {
     echo "Veuillez selectionnez deux comptes et rentrer un montant et une date";
     }

     // je vérifie que mes comptes récepteur et emetteur sont bien différents
     else if (!($emetteur != $recepteur))
     {
     echo "Votre virement ne peut pas être effectué. Veuillez consulter votre Solde ou vous rapprocher de votre gestionnaire de compte.";
     }

    

// Je vérifie si mon compte emetteur est un particulier, si le montant est inférieur à 1001€ et si le solde du compte + autorisation découvert est positif
     else if ((empty($row2['raison_sociale'])) AND ($_POST["montant"] < 10001) AND (($row['autorisation_decouvert']+$row['solde']) >= $_POST["montant"]))
     {

// SI OK : J'insère mon opération dans la table opérations sur mes deux comptes
      $query3="INSERT INTO operation (type_operation,mouvement,montant_operation,iban,date_operation,commentaire) 
     VALUES 
    ('virement','-','".$_POST['montant']."','".$emetteur."','".$datevir."','a venir'),
    ('virement','+','".$_POST['montant']."','".$recepteur."','".$datevir."','a venir')";
     $result3=$mysqli->query($query3);


    
     echo "Votre demande de virement a bien été prise en compte. Le virement sera effectué le " .$datevir. " par votre gestionnaire.";
     } 


// Je vérifie si mon compte emetteur est un pro et si le solde est positif
     else if ((!(empty($row2['raison_sociale']))) AND (!($row['autorisation_decouvert']+$row['solde']) >= $_POST["montant"]))
        {

     $query5="INSERT INTO operation (type_operation,mouvement,montant_operation,iban,date_operation,,commentaire) 
     VALUES 
    ('virement','-','".$_POST['montant']."','".$emetteur."','".$datevir."','a venir'),
    ('virement','+','".$_POST['montant']."','".$recepteur."','".$datevir."','a venir')";
   $result5=$mysqli->query($query5);
    
      echo "Votre demande de virement a bien été prise en compte. Le virement sera effectué le " .$datevir. " par votre gestionnaire.";
      } 

    else echo "Votre virement ne peut pas être effectué. Veuillez consulter votre Solde ou vous rapprocher de votre gestionnaire de compte.";
    }




    mysqli_close($mysqli);
?>
  <br>	<br/>
  <div class="nav"> <a href="virement_compte.php"><span> Faire un nouveau virement </span> </div>
  <div class="nav"> <a href="../../page_part.php"><span>Revenir à votre Espace Client </span> </div>

<?php
  include("../../footer.html"); 
?>

  </body>
</html>