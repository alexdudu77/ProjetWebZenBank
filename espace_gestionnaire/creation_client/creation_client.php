<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="../../style.css" type="text/css" media="screen"/>

        <title>Cr&eacute;ation d'un client </title>
    </head>


   <body>

    <header>
      <h1>BANQUECY <FONT color="#eaf50f">Espace Gestionnaire</FONT></h1>
      <h2> FORMULAIRE DE CREATION D'UN CLIENT </h2>


<p>
   
    Veuillez remplir les champs ci-dessous pour cr&eacute;er un client : 
</p>

<?php
require("../../mysql.php"); 
$query="SELECT * FROM agence";
$result = $mysqli->query($query);



?>
<form action="creation_part_verification.php" method="post">
<p>
	Veuillez choisir la civilité :<br />
       <input type="radio" name="civilite_client[]" value="Mme" id="Mme" /> <label for="Mme">Madame</label><br />
       <input type="radio" name="civilite_client[]" value="Mr" id="Mr" /> <label for="Mr">Monsieur</label><br />
   </p>
   	<label for="nom_client"> Nom </label> :  <input type="text" name="nom_client" /><br>
   	<label for="prenom_client"> Prenom</label> :  <input type="text" name="prenom_client" /><br>
   	<label for="date_naissance"> Date de Naissance (format aaaa-mm-dd)</label> :  <input type="date" name="date_naissance" /><br>
        <label for="mail_client"> E.mail </label> :  <input type="email" name="mail_client" /><br>
        <label for="telephone_client"> Téléphone </label> :  <input type="int" name="telephone_client" /><br>
   	<label for="password_client"> Mot de passe </label> : <input type="password_client" name="password_client" /><br>
	<label for="identifiant_client"> Identifiant </label> :  <input type="text" name="identifiant_client" /><br>
        <label for="raison_sociale"> Raison Sociale (pour les Professionnels) </label> :  <input type="text" name="raison_sociale" /><br>
        
        <label for="sirss"> SIREN ou num&eacute;ro de s&eacute;curit&eacute; sociale </label> :  <input type="varchar" name="sirss" /><br>
        <label for="type_client"> Type de client (ENT ou PART) </label> :  <input type="enum" name="type_client" /><br>
 
        <label for="id_agence"> Agence </label> : 
        <select name="id_agence" id="id_agence">
       
<?php
while ($row = $result->fetch_array())
{
 ?>
        <option value="<?php echo $row['id_agence'];?>""><?php echo $row['nom_agence'];?></option>

<?php           
}
$mysqli->close();
?>
       </select>
   </p>


    <input type="submit" value="Valider" />

</form>

    <br><br/>
    <div class="nav"> 
   <a href="../page_gestionnaire.php"><span>Revenir &agrave; l'espace gestionnaire </span> </div>
    <div class="nav"> <a href="../../deconnexion.php">Se d&eacute;connecter</a>  </div>
	
    </body>
</html>

