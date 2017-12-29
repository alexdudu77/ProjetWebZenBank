<?php
    function executeQuery($sql){
      $c = new mysqli("localhost", "root", "root", "zenbanque", 3306);
      if($c->connect_errno){
              //si erreur de connection
           exit('Erreur : Problème de connexion à la BDD');
           //return "Pb BDD";
      }
      $c->set_charset("utf8");
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
      $count = mysqli_num_rows($requete);
      if ($count==1){
        $result = $requete->fetch_row();
        initialiseVariablesSession($result[0], $result[1], $result[2]);
      }
      return $count == 1;
    }

    function generationMDP($email){
      $sql = "select generation_mot_de_passe((select id from individus where email ='".$email."')) as mdp";
      $requete = executeQuery($sql);
      $count = mysqli_num_rows($requete);
      $result = $requete->fetch_row();
      $_SESSION['mdp'] = $result[0];
      return $count == 1;
    }

    function nouveauClient($titre, $nom, $prenom, $datenaissance, $email, $portable, $fixe, $adresse, $cp, $ville){
      $sql = "select creation_individu('".$titre."', '".$nom."', '', '".$prenom."', '".$datenaissance."', '".$email."', '".$portable."', '".$fixe."', '".$adresse."', ".$cp.", '".$ville."') as id";
      $requete = executeQuery($sql);
      $count = mysqli_num_rows($requete);
      if ($count==1){
        $result = $requete->fetch_row();
        initialiseVariablesSession($result[0], $nom, $prenom);
        recuperationMDP();
      }
      return $count == 1;
    }

    function nouveauCompte($type_compte){
      $id = $_SESSION['id'];
      $libelle_compte = "";
      $sql = "select creation_compte(".$id.",'".$libelle_compte."','".$type_compte."')";
      $requete = executeQuery($sql);
      $count = mysqli_num_rows($requete);
      return $count == 1;
    }

    function recuperationMDP(){
      $sql = "select mot_de_passe from individus where id =".$_SESSION['id'];
      $requete = executeQuery($sql);
      $result = $requete->fetch_row();
      $_SESSION['mdp'] = $result[0];
    }

    function commandeChequier($id_compte, $nbr){
      $sql = "select commande_chequiers(".$_SESSION['id'].", ".$id_compte."," .$nbr.")";
      $requete = executeQuery($sql);
      $result = $requete->fetch_row();
      return $result[0];
    }

    function demandeVirement($id_compte_source, $id_compte_dest, $montant, $date, $motif){
      $sql = "select demande_virement('".$id_compte_source."', '".$id_compte_dest."',".$montant.", '".$date."', '".$motif."') as erreur";
      $requete = executeQuery($sql);
      $result = $requete->fetch_row();
      return $result[0];
    }

    function miseAJourClient($id, $portable, $fixe, $adresse, $cp, $ville){
      $sql = "update individus set portable = '".$portable."', fixe='".$fixe."', adresse='".$adresse."', code_postal='".$cp."', ville='".$ville."' where id = ".$id."";
      $requete = executeQuery($sql);
      return $requete->error == "";
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
