<?php 
    if (session_status() != PHP_SESSION_ACTIVE) {
	session_start();	
    }
    require('mysql.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <title></title>
    </head>
    
    <body>
        <?php
            // Vérification des identifiants dans la base de données
            $query = "SELECT client.raison_sociale, client.identifiant_client, client.nom_client, client.prenom_client, client.civilite_client, client.id_client, client.date_naissance, client.mail_client, client.telephone_client, compte.id_compte
                FROM client
                JOIN compte
                ON client.id_client = compte.id_client
                WHERE client.identifiant_client = '".$_POST["identifiant_client"]."' AND client.password_client = '". $_POST["password_client"] ."'";
            $result = $mysqli->query($query);

            // Condition pour afficher un message d'erreur si connexion impossible ou rediriger vers la page client si la connexion est acceptée
            if (!$result){
                echo 'Erreur Technique';
            }
            else{
                // On récupère tous les éléments que l'on souhaite avoir dans la BDD
                $row = $result->fetch_array();
                if ($row['identifiant_client'] == '' OR $row['password_client'] = ''){
                echo "<p> <font color=e51525 size='6pt'>Mauvais identifiant ou mot de passe !</font></p>";
                }
                else {
                    $_SESSION['identifiant_client'] = $row['identifiant_client'];
                    $_SESSION['nom_client'] = $row['nom_client'];
                    $_SESSION['prenom_client'] = $row["prenom_client"];
                    $_SESSION['civilite_client'] = $row['civilite_client'];
                    $_SESSION['id_client'] = $row['id_client'];
                    $_SESSION['id_compte'] = $row['id_compte'];
                    $_SESSION['date_naissance'] = $row['date_naissance'];
                    $_SESSION['mail_client'] = $row['mail_client'];
                    $_SESSION['telephone_client'] = $row['telephone_client'];
                    $_SESSION['raison_sociale']= $row['raison_sociale'];
            
                    echo "<script>window.location.href = 'page_part.php'</script>";
                }
            }
            mysqli_close($mysqli);
        ?>
   </body>
</html>
