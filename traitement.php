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
      $sql = "SELECT id, nom, prenom FROM individus WHERE email = '".$email."' and mot_de_passe = '".$mdp."'";
      $requete = executeQuery($sql);
      //$count = mysqli_num_rows($requete);
      //if ($count==1){
      $result = $requete->fetch_row();
      initialiseVariablesSession($result[0], $result[1], $result[2]);
      //}
      return $result[0] != null;
    }

    function generationMDP($email){
      $sql = "select genere_mot_de_passe((select id from individus where email ='".$email."')) as mdp";
      $requete = executeQuery($sql);
      $count = mysqli_num_rows($requete);
      $result = $requete->file_fletch();
      $_SESSION['mdp'] = $result[0];
      return $count == 1;
    }

    function nouveauClient($titre, $nom, $prenom, $datenaissance, $email, $portable, $fixe, $adresse, $cp, $ville){
      $sql = "select creation_individu('".$titre."', '".$nom."', '', '".$prenom."', '".$datenaissance."', '".$email."', '".$portable."', '".$fixe."', '".$adresse."', ".$cp.", '".$ville."') as id";
      $_SESSION['nom'] = $nom;
      $_SESSION['prenom'] = $prenom;
      $requete = executeQuery($sql);
      $count = mysqli_num_rows($requete);
      if ($count==1){
        $result = $requete->fetch_row();
        initialiseVariablesSession($result[0], null, null);
      }
      return $count == 1;
    }

    function nouveauCompte($id, $libelle_compte, $type_compte){
      $sql = "select creation_compte(".$id.",'".$libelle_compte."','".$type_compte."')";
      $requete = executeQuery($sql);
      $count = mysqli_num_rows($requete);
      return $count == 1;
    }

    function initialiseVariablesSession($id, $nom, $prenom){
      if($id != null){
        $_SESSION['id'] = $id;
      }
      if($nom != null){
        $_SESSION['nom'] = $nom;
      }
      if($prenom != null){
        $_SESSION['prenom'] = $prenom;
      }
    }
?>
