<?php
    // connexion � la base de donn�e
    $mysqli = mysqli_connect("localhost", "root", "", "EBANKING_PROJET");
    
    if (mysqli_connect_errno($mysqli)) {
        echo "Echec lors de la connexion � MySQL : " . mysqli_connect_error();
    }
?>