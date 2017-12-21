<?php 
require("../mysql.php"); 
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="../style.css" type="text/css" media="screen"/>
        <title>Page de connexion</title>
    </head>
    <header>

    
    <h1>BANQUECY <FONT color="#eaf50f">Demande d'Ouverture</FONT> </h1>
      <h2> FORMULAIRE D'INSCRIPTION </h2>
    </header>
    <body>


<?php 
  require("../mysql.php");
  $query = "SELECT *
             FROM client WHERE identifiant_client = '" .$_POST['identifiant_client']."'";

  $result = $mysqli->query($query);
  $row = $result->fetch_array();
  $rowcount = mysqli_num_rows($result)  ;

// On récupère les valeurs du champs civilité 
   if(!empty($_POST['civilite_client']))
    {
    //on déclare une variable
    $choix ='';
    //on boucle
    for ($i=0;$i<count($_POST['civilite_client']);$i++)
     {
    //on concatène
    $choix .= $_POST['civilite_client'][$i];
     }
    }


	else
	{
  echo 'Veuillez s&eacute;lectionner une civilit&eacute;';
  }

?>
<?php 
  if(isset($_POST['nom_client']))      $nom=$_POST['nom_client'];
    else      $nom="";

  if(isset($_POST['prenom_client']))      $prenom=$_POST['prenom_client'];
    else      $prenom="";

  if(isset($_POST['mail_client']))      $mail=$_POST['mail_client'];
    else      $mail="";

  if(isset($_POST['identifiant_client']))      $identifiant=$_POST['identifiant_client'];
    else      $identifiant="";

  if(isset($_POST['telephone_client']))      $tel=$_POST['telephone_client'];
    else      $tel="";

  if(isset($_POST['raison_sociale']))      $rs=$_POST['raison_sociale'];
    else      $rs="";

  if(isset($_POST['date_naissance']))      $date_n=$_POST['date_naissance'];
    else      $date_n="";

  if(isset($_POST['password_client']))      $pdw=$_POST['password_client'];
    else      $pdw="";

// On vérifie si les champs sont vides 
  if(empty($nom) OR empty($prenom) OR empty($mail) OR empty($identifiant) OR empty($tel)) 
        { 
        echo 'Tous les champs doivent être remplis'; 

        } 

// Aucun champ n'est vide, on peut enregistrer dans la table 
    else      
      { 
        if ($result->num_rows == 0)
          { 
             echo "<div>Nous avons bien pris en compte votre demande de création de compte. </div>
             <div> Un gestionnaire prendra contact avec vous une fois votre inscription validée. </div>
             Merci d'avoir choisi BANQUECY pour vous accompager dans vos projets.";
          

             $query2= "INSERT INTO client (civilite_client,raison_sociale,date_naissance,telephone_client,password_client,mail_client,identifiant_client,nom_client,prenom_client,actif_client) 
                      VALUES ('".$choix."','".$rs."','".$date_n."','".$tel."','".$pdw."','".$mail."','".$identifiant."','".$nom."','".$prenom."','0')";

              $result2 = $mysqli->query($query2);         
          }

           else 
           {
            echo "Vous avez déjà fait une demande d'inscription. Veuillez nous contacter pour plus d'information.";
              echo $date_n;
           }
      }

mysqli_close($mysqli);
?>
<p> <a href="../index.php"><span>Revenir à la page d'accueil </span> </p>
    
<?php
include("../footer.html"); 
?>
</body>

</html>
