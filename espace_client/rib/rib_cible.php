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
        <title> ESPACE CLIENT : éditer un RIB</title>
    </head>

    <body>
     <header>
            <div id="banniere_image"></div>
            <h1>BANQUECY <FONT color="#eaf50f">Espace Client</FONT> </h1>
             <h2> Editer un RIB </h2>

     </header>
<?php
$iban_imprime = "";
if (isset($_GET["id"]))
    {
    $iban_imprime = $_GET["id"];
    }


$query="SELECT iban, SUBSTR(iban, 3, 2) AS cle_iban, SUBSTR(iban, 5, 5) AS code_banque, SUBSTR(iban, 10, 5) AS code_guichet,SUBSTR(iban, 15, 11) AS compte, SUBSTR(iban, 26, 2) AS cle_rib FROM compte WHERE iban = '".$iban_imprime."'";
$result = $mysqli->query($query);
$row = $result->fetch_array();

$query2 ="SELECT client.raison_sociale, client.nom_client, client.prenom_client, adresse.numero_rue, adresse.rue, adresse.CP, adresse.ville, adresse.pays
    FROM adresse
    JOIN habite 
    ON habite.id_adresse = adresse.id_adresse
    JOIN client
    ON client.id_client = habite.id_client
    JOIN compte 
    ON compte.id_client = client.id_client
    WHERE compte.iban = '".$iban_imprime."'";
$result2 = $mysqli->query($query2);
$row2 = $result2->fetch_array();


?>


 <table class= "tableau">
            <tr>
             <th> Titulaire </th>
             <th> Raison Sociale </th>
             <th> Domiciliation </th>
             <th> Iban </th>
             <th> Code Banque </th>
             <th> Code Guichet </th>
             <th> Numero de compte </th>
             <th> Clé Rib </th>
            </tr>
<?php
 echo "<tr>";
                echo "<td>".$row2['prenom_client'].' '. $row2['nom_client'] ."</td>";
                echo "<td>". $row2['raison_sociale']. "</td>";
                echo "<td>".$row2['numero_rue'].' '. $row2['rue'] .' '.$row2['CP'].' '. $row2['ville'] .' '. $row2['pays'] ." </td>";
                echo "<td>". $iban_imprime ."<br/></td>";
                echo "<td>". $row['cle_iban'] ."<br/></td>";
                echo "<td>". $row['code_banque'] ."<br/></td>";
                echo "<td>". $row['code_guichet'] ."<br/></td>";
                echo "<td>". $row['cle_rib'] ."<br/></td>";
                echo "</tr>";
 echo "</tr>";


?>

</table>
<br><br/>
<div class="nav"> <a href="../../page_part.php"><span>Revenir &agrave; votre Espace Client </span> </div>

<?php
  include("../../footer.html"); 
?>
    
    </body>
</html>