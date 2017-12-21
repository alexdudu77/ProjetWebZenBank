<?php 

require("../../mysql.php"); 
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="../../style.css" type="text/css" media="screen"/>
        <title>Page de connexion</title>
    </head>
    <header>

    
      <h1>BANQUECY <FONT color="#eaf50f">Espace Gestionnaire</FONT></h1>
        <h2> FORMULAIRE DE CREATION DE COMPTE </h2>
    </header>
    <body>


<?php 
  require("../../mysql.php");

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

    if(isset($_POST['id_agence']))      $agence=$_POST['id_agence'];
    else      $agence="";

    if(isset($_POST['sirss']))      $sirss=$_POST['sirss'];
    else      $sirss="";
    
    if(isset($_POST['type_client']))      $type_client=$_POST['type_client'];
    else      $type_client="";


// On v�rifie si les champs sont vides 
    if(empty($nom) OR empty($prenom) OR empty($mail) OR empty($identifiant) OR empty($tel) OR empty($sirss) OR empty($type_client)) 
        { 
        echo 'Tous les champs doivent être remplis'; 
        } 

// Aucun champ n'est vide, on peut enregistrer dans la table 
        else      
            { 

            if ($result->num_rows == 0)

             { 
             echo "<div>Le client a bien été inscrit.</div>";
          

            $query2= "INSERT INTO client (civilite_client,raison_sociale,date_naissance,telephone_client,password_client,mail_client,identifiant_client,nom_client,prenom_client,actif_client,id_agence,sirss,type_client)
                      VALUES ('".$choix."','".$rs."','".$date_n."','".$tel."','".$pdw."','".$mail."','".$identifiant."','".$nom."','".$prenom."','1','".$agence."','".$sirss."','".$type_client."')";

            $result2 = $mysqli->query($query2);         
            }

           else 
           {
            echo "Le client est d&eacute;jà inscrit";
           }

         }

    mysqli_close($mysqli);
?>
<br><br/>
<div class="nav">  
 <a href="../creation_compte/creation_compte.php"><span> Pour ouvrir un compte en banque au client, cliquez-ici </span> </div>
<div class="nav"> <a href="../page_gestionnaire.php"><span>Revenir &agrave; l'espace gestionnaire </span> </div>


</body>

</html>
