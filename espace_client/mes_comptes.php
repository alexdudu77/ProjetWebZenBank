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
        <title>ESPACE CLIENT : visualiser vos comptes</title>
    </head>

    <body>
        <header>
            <h1>BANQUECY <FONT color="#eaf50f">Espace Client</FONT> </h1>
            <h2> ACCEDER A VOS COMPTES BANCAIRES </h2>
	 </header>

<?php
    $query = "SELECT * FROM client WHERE identifiant_client = '".$_SESSION["identifiant_client"]."'";
    $result = $mysqli->query($query);
    $row = $result->fetch_array();
?>

    <caption>  <?php echo $row['civilite_client']; ?> <?php echo $row['prenom_client']; ?> <?php echo $row['nom_client']; ?> <br/></caption>
    <p> <strong> SYNTHESE DE VOS COMPTES BANCAIRES </strong> </p> <br/>
    <br>

    <table class= "tableau">
        <tr>
            <th> Type Compte </th>
            <th> Iban </th>
            <th> Solde </th>
            <th> Autorisation de découvert </th>
        </tr>
        
<?php
    $query= "SELECT client.civilite_client AS Civilite_client, client.nom_client AS Nom, client.prenom_client AS Prenom, compte.id_compte AS Numero_compte, type_compte.nom_type AS Type_compte, compte.iban AS iban, compte.solde AS Solde, compte.autorisation_decouvert AS autorisation
                    FROM compte
                    JOIN client
                    ON compte.id_client = client.id_client
                    JOIN type_compte
                    ON compte.id_type_compte = type_compte.id_type_compte
                    WHERE compte.id_client = '".$row['id_client']."'";
    $result = $mysqli->query($query);
    while ($row = $result->fetch_array())
    {      
        echo "<tr>";
        echo "<td>".  $row['Type_compte'] ."</td>";
        echo "<td><a href='page_redirect.php?idcpt=".$row['iban']."'' class ='lien_tableau'>". $row['iban'] ."</a></td>";
        echo "<td>". $row['Solde'] ." €<br/></td>";
        echo "<td>". $row['autorisation'] ." €</td>";
        echo "</tr>";
    }
    $mysqli->close();
?>
     
    </table><br>
    <div class="nav"> <a href="../page_part.php"><span>Revenir &agrave; votre Espace Client </span> </br></div>
	
<?php
include("../footer.html"); 
?>

    </body>
</html>
