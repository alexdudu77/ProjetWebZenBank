<?php 
    if (session_status() != PHP_SESSION_ACTIVE) {
        session_start();	
    }
?>

<!DOCTYPE html>
<html>
    <head>
    <title></title>
    <body>
    <?php
        // Connexion à la base de données
        require("../mysql.php");

        // Vérification des identifiants dans la base de données
        $query = "SELECT * FROM employe
                JOIN agence
                ON employe.id_employe = agence.id_agence
                WHERE employe.identifiant_employe = '".$_POST["identifiant"]."' AND employe.password_employe = '". $_POST["password"] ."'";
        $result = $mysqli->query($query);
    
        // Erreur si la connexion est impossible ou redirection sur l'espace gestionnaire si la connexion est acceptée
        if (!$result){
            echo 'Erreur technique';
        }
        else{
            // On récupère les éléments que l'on souhaite conserver
            $row = $result->fetch_array();
            if ($row['identifiant_employe'] == '' OR $row['password_employe'] = '') 
            echo "<p> <font color=e51525 size='6pt'>Mauvais identifiant ou mot de passe !</font></p>";
            else {
                $_SESSION['identifiant_employe'] = $row['identifiant_employe'];
                $_SESSION['nom_employe'] = $row['nom_employe'];
                $_SESSION['prenom_employe'] = $row['prenom_employe'];
                $_SESSION['civilite_employe'] = $row['civilite_employe'];
                $_SESSION['id_employe'] = $row['id_employe'];
                $_SESSION['password_employe'] = $row['password_employe'];
            echo "<script>window.location.href = 'page_gestionnaire.php'</script>";
            }
        }
        mysqli_close($mysqli);
    ?>
    </body>
</html>
