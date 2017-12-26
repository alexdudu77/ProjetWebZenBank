<?php

  function afficherListeComptesBeneficiaires($id_indiv)
  {
    $sql = "select numero_compte, libelle from v_comptes_beneficiaires where individu_source_id=".$id_indiv;
    $requete = executeQuery($sql);
    echo "<select name='listeBeneficiaire' id='listeBeneficiaire'>";
    while ( $result = $requete->fetch_row() )
    {
      echo "<option value='".$result[0]."'>Compte ".$result[1]."</option>";
    }
    echo "</select>";
  }

  function afficherListeMesComptes($id_indiv)
  {
    $sql = "select numero_compte from v_soldes_comptes where type_compte='C' and individu_id=".$id_indiv;
    $requete = executeQuery($sql);
    echo "<select name='listeCompte' id='listeCompte'>";
    while ( $result = $requete->fetch_row() )
    {
      echo "<option value='".$result[0]."'>Compte ".$result[0]."</option>";
    }
    echo "</select>";
  }

 ?>
