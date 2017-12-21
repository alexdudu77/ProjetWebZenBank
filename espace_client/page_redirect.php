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
            <div id="banniere_image"></div>
            <h1>BANQUECY </h1>

            <?php
            $compte_concerne = "";
            if (isset($_GET["idcpt"]))
            {
                    $compte_concerne = $_GET["idcpt"];
            }
                $query="SELECT client.civilite_client AS civilite, client.identifiant_client AS identifiant_client, client.nom_client AS nom, client.prenom_client AS prenom, compte.iban AS iban, compte.solde AS Solde, operation.id_operation AS Operation, operation.type_operation AS Nom_operation, operation.montant_operation AS Montant_operation
                FROM compte
                JOIN client
                ON compte.id_client = client.id_client
                JOIN operation
                ON compte.iban = operation.iban
                WHERE client.identifiant_client = '".$_SESSION["identifiant_client"]."' AND compte.iban = '".$compte_concerne."'";

            $result = $mysqli->query($query);
            $row = $result->fetch_assoc();
            $date=date("d.m.Y");
            ?>
            
    <caption>  <?php echo $row['civilite']; ?> <?php echo $row['prenom'] ?> <?php echo $row['nom'] ?> <br/></caption>
        <br/>
    <p> <strong> SYNTHESE DES OPERATIONS </strong> </p>
        <p> Solde au <?php echo $date; ?> : <?php echo $row['Solde']; ?> €<br/>
        <table class= "tableau" width=40%>
            <tr>
                <th> Iban </th>
                <th> Op&eacute;ration </th>
                <th> Montant </th>
            </tr>

        <?php 
            $query="SELECT client.identifiant_client, client.nom_client AS nom, client.prenom_client AS prenom, compte.id_compte AS Numero_compte, compte.iban AS iban, compte.solde AS Solde, operation.id_operation AS Operation, operation.type_operation AS Nom_operation, operation.montant_operation AS Montant_operation, operation.mouvement AS mouvement
        FROM compte
        JOIN client
        ON compte.id_client = client.id_client
        JOIN operation
        ON compte.iban = operation.iban
        WHERE identifiant_client = '".$_SESSION["identifiant_client"]."' AND compte.iban = '".$compte_concerne."'";
            $result = $mysqli->query($query);
        while ($row = $result->fetch_array()){      
            echo "<tr>";
            echo "<td>". $row['iban'] ."</td>";
            echo "<td>". $row['Nom_operation'] . "<br/></td>";
            echo "<td>". $row['mouvement'] . ' '. $row['Montant_operation'] . " €<br/></td>";
            echo "</tr>";
        }
        $mysqli->close();
        echo "</table>";
        ?>
    <p> <a href="../page_part.php"><span>Revenir &agrave; votre Espace Client </span> </p>

    <?php
        include("../footer.html"); 
    ?>
    
    </body>
</html>
