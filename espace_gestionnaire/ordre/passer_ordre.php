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
    <title>ESPACE CLIENT : Passer des ordres</title>
  </head>


  <header>
  <h1>BANQUECY <FONT color="#eaf50f">Espace Gestionnaire</FONT> </h1>
  <h2> PASSER DES ORDRES </h2>

  </header>
  <body>


<ul id="faire_virement">

      <li> 1. Compte à débiter </li> <br/>

        <form method="post" action="faire_ordre.php">
        <label for="compte_a_debiter"> Choisissez le Compte à débiter </label> 
        <select name="compte_emetteur" id="compte_emetteur" /><br>


<?php
  $query= "SELECT client.civilite_client AS Civilite, client.nom_client AS Nom, client.prenom_client AS Prenom, compte.id_compte AS Numero_compte, type_compte.nom_type AS Type_compte, compte.solde AS Solde, compte.iban AS iban 
                FROM compte 
                JOIN client
                ON compte.id_client = client.id_client
                JOIN type_compte
                ON compte.id_type_compte = type_compte.id_type_compte WHERE client.actif_client='1'";

  $result1 = $mysqli->query($query);
  while ($row = $result1->fetch_assoc())
  {
?>
        <option name="compte_emetteur" value="<?php echo $row['iban'];?>"><?php echo $row['Type_compte']." N° ".$row['iban']." " .$row['Solde']." €" ;?> </option><br/>
       
<?php
  }
?>         
    
    </select>
          
        <li> 2. Compte à créditer </li> <br/>

        <label for="compte_recepteur"> Choisissez le Compte à créditer </label> 
        <select name="compte_recepteur" id="compte_recepteur" /><br/>

    <?php
        $query= "SELECT client.civilite_client AS Civilite, client.nom_client AS Nom, client.prenom_client AS Prenom, compte.id_compte AS Numero_compte, type_compte.nom_type AS Type_compte, compte.solde AS Solde, compte.iban AS iban 
                FROM compte 
                JOIN client
                ON compte.id_client = client.id_client
                JOIN type_compte
                ON compte.id_type_compte = type_compte.id_type_compte WHERE client.actif_client='1'";

        $result2 = $mysqli->query($query);
        while ($row = $result2->fetch_array())
        {
        ?>
        <option name="compte_recepteur" value="<?php echo $row['iban'];?>"><?php echo $row['Type_compte']." N° ".$row['iban']." " .$row['Solde']." €" ;?> </option>
        <br/>

<?php
        } 
$mysqli->close();
?>         

     </select>
          
      <br/>
      <li> 3. Choisir le montant </li> <br/>
      <label for="montant"> Tapez votre montant </label> : <input type="number" name="montant"/><br>

      <input type="submit" name="action" value="Valider">
      </form>
      </ul> 
       

<br><br/>
<div class="nav"> <a href="../page_gestionnaire.php"><span>Revenir &agrave; l'espace gestionnaire </span> </div>
<div class="nav"> <a href="../../deconnexion.php">Se d&eacute;connecter</a>  </div>

  </body>
</html>