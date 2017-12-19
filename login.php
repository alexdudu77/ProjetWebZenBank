<?php


   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form
      require "traitement.php";

      $myusername = $_POST['idClient'];
      $mypassword = $_POST['passClient'];

      if (connexionMonCompte($myusername, $mypassword)) {
         $_SESSION['login_user'] = $myusername;
         $p = "location: interfaceClientSyntheseCompte.php?nom=".$myusername."";
         header($p);
      } else {
         $error = "Login ou mot de passe invalide";
      }
   }
?>

<html lang="fr">
   <head>
      <title>Login Page</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <link rel="stylesheet" type="text/css" href="styleIndex.css">
   </head>

   <body bgcolor = "#FFFFFF">

      <div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>

            <div style = "margin:30px">

              <form method="post" action="">
                <div style = "font-size:15px; color:#cc0000; margin-top:10px">
                  <?php
                    if (isset($error)) { echo $error; }
                  ?>
                </div>
              <div class="modal-body">
                <div class="form-group">
                  <label for="idClient">Identifiant client:</label>
                  <input type="text" class="form-control" name="idClient" placeholder="Saisissez votre identifiant">
                </div>
                <div class="form-group">
                  <label for="pwd">Password:</label>
                  <input type="password" class="form-control" name="passClient" placeholder="Saisissez votre mot de passe"><span class="glyphicon glyphicon-keys"></span>
                  <a href="interfaceOubliMDP.php">Mot de passe oubli&eacute;?</a>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button type="submit" class="btn btn-danger" id="btnConnexion"><label>Se connecter</label></button>
              </div>
              </form>
            </div>

         </div>

      </div>

   </body>
</html>
