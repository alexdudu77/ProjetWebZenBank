<?php
  function executeQuery($sql){
      $c = new mysqli("localhost", "root", "root", "zenbanque", 3306);
      if($c->connect_errno){
              //si erreur de connection
          return "Pb BDD";
      }
      $res = $c->query($sql);
      $c->close();
      return $res;
    }

    function testExistanceClient($email){
      $sql = "select id from individus where email = '".$email."'";
      $requete = executeQuery($sql);
      $count = mysqli_num_rows($requete);
      return $count == 1;
    }

    function connexionMonCompte($email, $mdp){
      $sql = "SELECT id FROM individus WHERE email = '$email' and mot_de_passe = '$mdp'";
      $result = executeQuery($sql);
      $count = mysqli_num_rows($result);
      return $count == 1;
    }

    function generationMDP($email){
      $sql = "select genere_mot_de_passe((select id from individus where email ='".$email."')) as mdp";
      $requete = executeQuery($sql);
      $count = mysqli_num_rows($requete);
      return $count == 1;
    }

    function nouveauClient($titre, $nom, $prenom, $datenaissance, $email, $portable, $fixe, $adresse, $cp, $ville){
      $sql = "select creation_individu('".$titre."', '".$nom."', '', '".$prenom."', '".$datenaissance."', '".$email."', '".$portable."', '".$fixe."', '".$adresse."', ".$cp.", '".$ville."')";
      $requete = executeQuery($sql);
      $count = mysqli_num_rows($requete);
      return $count == 1;
    }

    function nouveauCompte($id, $libelle_compte, $type_compte){
      $sql = "select creation_compte(".$id.",'".$libelle_compte."','".$type_compte."')";
      $requete = executeQuery($sql);
      $count = mysqli_num_rows($requete);
      return $count == 1;
    }
?>
