<?php
  function afficherMesInformations($id_indiv)
  {
    $sql = "select nom, prenom, email, portable, fixe, adresse, code_postal, ville, mot_de_passe from individus where id=".$id_indiv."";
    $requete = executeQuery($sql);

    while ( $result = $requete->fetch_row() )
    {
      echo "<div class='form-group'>";
      echo "<label for='emailClient'>Nom</label>";
      echo "<input type='email' class='form-control' id='nom' value=".$result[0]." readonly>";
      echo "</div>";
      echo "<div class='form-group'>";
      echo "<label for='emailClient'>Prénom</label>";
      echo "<input type='email' class='form-control' id='prenom' value='".$result[1]."' readonly>";
      echo "</div>";
      echo "<div class='form-group'>";
      echo "<label for='emailClient'>E-mail</label>";
      echo "<input type='email' class='form-control' id='emailClient' value='".$result[2]."' readonly>";
      echo "</div>";
      echo "<div class='form-group'>";
      echo "<label for='emailClient'>Mot de passe de connexion</label>";
      echo "<input type='email' class='form-control' id='mdp' value='".$result[8]."' readonly>";
      echo "</div>";
      echo "<div class='form-group'>";
      echo "<label for='adresseClient'>Adresse</label>";
      echo "<input type='text' class='form-control' name='adresseClient' value='".$result[5]."' required>";
      echo "</div>";
      echo "<div class='form-group'>";
      echo "<label for='codePostalClient'>Code postal</label>";
      echo "<input type='text' class='form-control' name='codePostalClient' value='".$result[6]."' pattern='^(([0-8][0-9])|(9[0-5])|(2[ab]))[0-9]{3}$' title='5 chiffres sont attendus' required>";
      echo "</div>";
      echo "<div class='form-group'>";
      echo "<label for='villeClient'>Ville</label>";
      echo "<input type='text' class='form-control' name='villeClient' value='".$result[7]."' required>";
      echo "</div>";
      echo "<div class='form-group'>";
      echo "<label for='telephoneMobileClient'>T&eacute;l&eacute;phone Mobile</label>";
      echo "<input type='tel' class='form-control' name='telephoneMobileClient' value='".$result[3]."' pattern='^(?:0|\(?\+33\)?\s?|0033\s?)[1-79](?:[\.\-\s]?\d\d){4}$' title='10 chiffres sont attendus'>";
      echo "</div>";
      echo "<div class='form-group'>";
      echo "<label for='telephoneFixeClient'>T&eacute;l&eacute;phone Fixe</label>";
      echo "<input type='tel' class='form-control' name='telephoneFixeClient' value='".$result[4]."' pattern='^(?:0|\(?\+33\)?\s?|0033\s?)[1-79](?:[\.\-\s]?\d\d){4}$' title='10 chiffres sont attendus'>";
      echo "</div>";
    }
  }

?>
