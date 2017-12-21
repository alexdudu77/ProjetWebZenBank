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
        <title> ESPACE CLIENT : éditer un RIB</title>
    </head>

    <body>
     <header>
            <div id="banniere_image"></div>
            <h1>BANQUECY <FONT color="#eaf50f">Espace Client</FONT> </h1>
             <h2> Editer un RIB </h2>

     </header>

<?php



require('fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'Hello World !');
$pdf->Output();
?>




</table>
<p> <a href="../page_part.php"><span>Revenir &agrave; votre Espace Client </span> </p>

<?php
  include("../footer.html"); 
?>
    
    </body>
</html>