<?php
    // connexion à la base de donnée
    $mysqli = mysqli_connect("localhost", "root", "", "EBANKING_PROJET");
    
    if (mysqli_connect_errno($mysqli)) {
        echo "Echec lors de la connexion à MySQL : " . mysqli_connect_error();
    }
?>