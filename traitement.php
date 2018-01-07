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

    function testExistenceBeneficiaire($id_beneficiaire, $id_source, $numero_compte){
      $sql = "SELECT libelle
              FROM v_comptes_beneficiaires
              WHERE individu_beneficiaire_id = ".$id_beneficiaire."
                and individu_source_id = ".$id_source."
                and numero_compte = '".$numero_compte."'";
      $requete = executeQuery($sql);
      $result = $requete->fetch_row();
      return $result[0];
    }

    function testExistenceCompteBeneficiaire($numero_compte, $code_banque, $cle_rib, $code_guichet){
      $sql = "SELECT individu_id from v_listes_comptes where numero_compte = '".$numero_compte."'
														and code_agence = '".$code_guichet."'
														and cle_rib = '".$cle_rib."'
                            and code_banque = '".$code_banque."'";
      $requete = executeQuery($sql);
      $result = $requete->fetch_row();
      return $result[0];
    }

    function creationBeneficiaire($libelle,$id_source,$id_beneficiaire,$num_compte){
      $sql = "INSERT into beneficiaires (libelle, individu_source_id, individu_beneficiaire_id, numero_compte_id)
              values ('".$libelle."', ".$id_source.",".$id_beneficiaire.", '".$num_compte."')";
      $requete = executeQuery($sql);
    }

    function suppressionBeneficiaire($id){
      $sql = "DELETE from beneficiaires where id=".$id."";
            $requete = executeQuery($sql);
    }

    function testExistenceClient($email){
      $sql = "SELECT id, nom, prenom from individus where email = '".$email."'";
      $requete = executeQuery($sql);
      $count = mysqli_num_rows($requete);
      if ($count==1){
        $result = $requete->fetch_row();
        initialiseVariablesSession($result[0], $result[1], $result[2]);
      }
      return $count == 1;
    }

    function connexionMonCompte($email, $mdp){
      $sql = "SELECT id, nom, prenom FROM individus WHERE email = '".$email."' and mot_de_passe = '".$mdp."'";
      $requete = executeQuery($sql);
      $count = mysqli_num_rows($requete);
      if ($count==1){
        $result = $requete->fetch_row();
        initialiseVariablesSession($result[0], $result[1], $result[2]);
        /* Historisation de la connexion */
        $sql = "call historisation(".$result[0].", concat('Connexion de ', '".$result[1]."',' ', '".$result[2]."'))";
        $requete = executeQuery($sql);
      }
      return $count == 1;
    }

    function generationMDP($email){
      $sql = "SELECT id from individus where email ='".$email."'";
      $requete = executeQuery($sql);
      $result = $requete->fetch_row();
      $id = $result[0];
      if ($id != null) {
        $sql = "UPDATE individus set
                mot_de_passe = generation_mot_de_passe(".$id.")
                where id = (".$id.")";
        $requete = executeQuery($sql);
      }
      return $id != null;
    }

    function nouveauClient($titre, $nom, $prenom, $datenaissance, $email, $portable, $fixe, $adresse, $cp, $ville){
      $sql = "SELECT creation_individu('".$titre."', '".$nom."', '', '".$prenom."', '".$datenaissance."', '".$email."', '".$portable."', '".$fixe."', '".$adresse."', ".$cp.", '".$ville."') as id";
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
      $sql = "SELECT creation_compte(".$id.",'".$libelle_compte."','".$type_compte."')";
      $requete = executeQuery($sql);
      $count = mysqli_num_rows($requete);
      return $count == 1;
    }

    function recuperationMDP(){
      $sql = "SELECT mot_de_passe from individus where id =".$_SESSION['id'];
      $requete = executeQuery($sql);
      $result = $requete->fetch_row();
      $_SESSION['mdp'] = $result[0];
    }

    function commandeChequier($id_compte, $nbr){
      $sql = "SELECT commande_chequiers(".$_SESSION['id'].", ".$id_compte."," .$nbr.")";
      $requete = executeQuery($sql);
      $result = $requete->fetch_row();
      return $result[0];
    }

    function demandeVirement($id_compte_source, $id_compte_dest, $montant, $date, $motif){
      $sql = "SELECT demande_virement('".$id_compte_source."', '".$id_compte_dest."',".$montant.", DATE_FORMAT('".$date."','%Y-%m-%d'), '".$motif."') as erreur";
      $requete = executeQuery($sql);
      $result = $requete->fetch_row();
      return $result[0];
    }

    function miseAJourClient($id, $portable, $fixe, $adresse, $cp, $ville){
      $sql = "UPDATE individus set portable = '".$portable."', fixe='".$fixe."', adresse='".$adresse."', code_postal='".$cp."', ville='".$ville."' where id = ".$id."";
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
