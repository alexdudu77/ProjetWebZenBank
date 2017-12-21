<?php 
    if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();  
    }
    require("../mysql.php"); 
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="../style.css" type="text/css" media="screen"/>
        <title>Espace de gestion des clients</title>
    </head>

    <body>
        <header>
            <h1>BANQUECY <FONT color="#eaf50f">Espace gestionnaire</FONT> </h1>
	</header>

        <?php
            //ISSET retourne TRUE si $_POST existe et est NOT NULL. FALSE sinon.
            $QUI = isset($_POST['pro']) ? $_POST['pro']: $_POST['part'];

            $query = "SELECT * FROM client WHERE sirss = $QUI";
             
            $result = $mysqli->query($query);
            $row = $result->fetch_array();
            if (count($row) == 0){
                echo "<p> <font color=e51525 size='6pt'>CLIENT INEXISTANT !</font></p>";
            }
        ?>
        
        <caption>   <?php echo $row['raison_sociale']; ?> <br/>
                    <?php echo $row['civilite_client']; ?>
                    <?php echo $row['prenom_client']; ?>
                    <?php echo $row['nom_client']; ?> <br/>
        </caption>
               
        <p> <strong> SYNTHESE DES COMPTES </strong> </p>

        <table class= "tableau">
            <tr>
                <th> Type Compte </th>
                <th> N° Iban </th>
                <th> Solde </th>
            </tr>
        <?php
            $query= "SELECT
                    client.raison_sociale AS Raison_sociale,
                    client.civilite_client AS Civilite_client,
                    client.nom_client AS Nom, client.prenom_client AS Prenom,
                    compte.id_compte AS Numero_compte,
                    compte.iban AS iban,
                    type_compte.nom_type AS Type_compte,
                    compte.solde AS Solde
                    FROM compte
                    JOIN client
                    ON compte.id_client = client.id_client
                    JOIN type_compte
                    ON compte.id_type_compte = type_compte.id_type_compte
                    WHERE compte.id_client = '".$row['id_client']."'";
            $result = $mysqli->query($query);
            while ($row = $result->fetch_array()){
                echo "<tr>";
                echo "<td>". $row['Type_compte'] ."</td>";
                echo "<td><a href='page_redirect.php?idcpt=".$row['iban']."'' class ='lien_tableau'>".$row['iban']."</a></td>";
                echo "<td>". $row['Solde'] ." €<br/></td>";
                echo "</tr>";
            }
            $mysqli->close();
        ?>
        </table>

        <br/>
        <div> Vous souhaitez modifier les informations clients ? </div>
        
        <div class="container">
            <form method="post" action="modif_client.php">
            <?php
                echo "<input type=\"hidden\" name=\"sirss\" value=\"$QUI\">";
            ?>
            <br/>
            <label for="nouveauNom"> Changer le nom </label> :  <input type="text" name="nouveauNom" /><br/>
            <br/>
            <label for="nouveauPrenom"> Changer le pr&eacute;nom </label> :  <input type="text" name="nouveauPrenom" /><br/>
            <br/>
            <label for="nouvelleDaten"> Changer la date de naissance (aaaa-mm-jj) </label> : <input type="text" name="nouvelleDaten" /><br/>
            <br/>
            <label for="nouveauMail"> Changer l'adresse mail </label> : <input type="text" name="nouveauMail" /><br/>
            <br/>
            <label for="nouveauNumero"> Changer le num&eacute;ro de t&eacute;l&eacute;phone </label> : <input type="text" name="nouveauTel" /><br/>
            <br/>
            <label for="nouvelleAgence"> Changer l'agence de domiciliation </label> : <input type="text" name="nouvelleAgence" /><br/>
            <br/>
            <p> <input type="submit" name="action" value="Valider"> </p>    
            </form>
        </div>

    <p> <a href="page_gestionnaire.php"><span>Revenir &agrave; l'espace gestionnaire </span> </p>
    <p> <a href="../deconnexion.php">Se d&eacute;connecter</a>  </p>
	
    </body>
</html>
