<?php 
    if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();  
    }
    require("../../mysql.php");


      $idemetteur = "";
  if (isset($_SESSION['id_client']))
    {
    $idemetteur = $_SESSION['id_client'];
    }
  $datejour=date('Y-m-d');
?>


<!DOCTYPE html>
<html>
  <head>
      <meta charset="utf-8" />
      <link rel="stylesheet" href="../../style.css" type="text/css" media="screen"/>
      <title>ESPACE CLIENT : Faire un Virement</title>
  </head>


    <body>
        <header>
            <h1>BANQUECY <FONT color="#eaf50f">Espace Client</FONT> </h1>
            <h2> FAIRE UN VIREMENT </h2>
            <p> Pour effectuer un virement, sélectionnez le compte à débiter puis le compte à créditer.
            <br>
        Vous pourrez ensuite choisir le montant et finaliser le virement.
    </p>
    <br/>

<!-- CHOISIR LE COMPTE EMETTEUR -->
    <ul id="faire_virement">
      <li> 1. Compte à débiter </li> <br/>

        <form method="post" action="faire_virement.php">
        <label for="compte_a_debiter"> Choisissez le Compte à débiter </label> 
        <select name="compte_emetteur" id="compte_emetteur" /><br>
<?php
  $query= "SELECT client.nom_client AS Nom, client.prenom_client AS Prenom, type_compte.nom_type AS Type_compte, compte.solde AS Solde, compte.iban AS iban 
                FROM compte 
                JOIN client
                ON compte.id_client = client.id_client
                JOIN type_compte
                ON compte.id_type_compte = type_compte.id_type_compte
                WHERE compte.id_client = '".$_SESSION['id_client']."'";


  $result1 = $mysqli->query($query);
  while ($row = $result1->fetch_assoc())
  {
  ?>
        <option name="compte_emetteur" value="<?php echo $row['iban'];?>"><?php echo $row['Type_compte']." N° ".$row['iban']." " .$row['Solde']." €" ;?> </option><br/><br>

<?php
  }
?>         
    </select>
   </br>   
   <br></br>




<!-- CHOISIR LE COMPTE RECEPTEUR -->
     <li> 2. Compte à créditer </li> <br/>

        <label for="compte_recepteur"> Choisissez le Compte à créditer </label> 
        <select name="compte_recepteur" id="compte_recepteur" /><br/>


<?php
  $query2= "SELECT beneficiaire.iban_benef AS iban_benef, beneficiaire.nom_benef, beneficiaire.prenom_benef, beneficiaire.valide, beneficiaire.id_client
            FROM beneficiaire
            WHERE beneficiaire.id_client = '".$_SESSION['id_client']."' AND beneficiaire.valide=1";

  $result2 = $mysqli->query($query2);


?>
  <optgroup label="Compte Interne">

  <?php
  $query5="SELECT client.nom_client AS Nom, client.prenom_client AS Prenom, type_compte.nom_type AS Type_compte, compte.solde AS Solde, compte.iban AS iban 
                FROM compte 
                JOIN client
                ON compte.id_client = client.id_client
                JOIN type_compte
                ON compte.id_type_compte = type_compte.id_type_compte
                WHERE compte.id_client = '".$idemetteur."'";
  $result5 = $mysqli->query($query5); 
  while ($row5 = $result5->fetch_array())
  {
 ?> 
  <option name="compte_recepteur" value="<?php echo $row5['iban'];?>"><?php echo $row5['Nom']." ".$row5['Prenom']." ".$row5['iban']." ".$row5['Solde']." €" ;?> </option>
  </optgroup>
  <?php
        } 
?>
  <optgroup label="Compte Externe">
<?php
    while ($row2 = $result2->fetch_array())
  {
 ?> 


      <option name="compte_recepteur" value="<?php echo $row2['iban_benef'];?>"><?php echo $row2['nom_benef']. " ".$row2['iban_benef']."" ;?> </option>
  </optgroup>
  <?php
        } 
?>  
 

 
<?php 
$mysqli->close();
?>      

     </select>
      <br/>
      <br></br>



<!-- CHOISIR LE MONTANT -->
      <li> 3. Choisir le montant </li> <br/>
      <label for="montant"> Tapez votre montant </label> : <input type="number" name="montant" /><br>
<br></br>


<!-- CHOISIR LA DATE -->
      <li> 4. Date du virement </li> <br/>
      <label for="date_vir"> Choisissez la date du virement </label> : <input type="date" name="date_vir" value="<?php echo $datejour;?>"/><br>

<br></br>
      <input type="submit" name="action" value="Valider">
      </form>
      </ul>  

<br></br>
<div class="nav"> <a href="../../page_part.php"><span>Revenir à votre Espace Client </span> </div>

<?php
  include("../../footer.html"); 
?>

  </body>
</html>