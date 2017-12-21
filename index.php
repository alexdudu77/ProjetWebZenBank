<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Page d'accueil du site de la banque COLAS-YOU" />
        <meta name="author" content="Pauline et Olivier" />
        <!-- link rel appelle la feuille de style et href="style.css" indique le chemin de la feuille de style -->
        <link rel="stylesheet" href="style.css" type="text/css" media="screen"/>
        <title>BANQUE COLASYOU</title>
    </head>
    
    <header>
    </header>
    
    <body>
        <div id="banniere_image">
        <div id="banniere_description">
        <h1>BANQUECY</h1>
        <h2>LA BANQUE PARTOUT, <FONT color="#eaf50f">POUR VOUS</FONT></h2><br/>

        <!-- Boutons de choix de profil A adapter avec les balises NAV ci-dessous --> 
        <nav>
            <a href="inscription/inscription_part_1.html" class="button"><span class="inscription">Demande d'ouverture de compte</span></a>
            <a href="connect_part.html" class="button"><span class="page_part">Espace Client</span></a>
            <a href="espace_gestionnaire/connect_gestionnaire.html" class="button"><span class="backoffice">Gestionnaires</span></a>
       
        </nav>
    </body>
        
    <footer>
        <div id="contact"><a href="mailto:mabanque@colasyou.com">Nous contacter par mail</a> </div>
        <br/>
        <div id="copyright">  &copy; Colas-You - Tous droits r&eacute;serv&eacute;s </div>
    </footer>
</html>
