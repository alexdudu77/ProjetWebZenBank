<?php

  function afficherListeComptes($id_indiv)
  {
    $sql = "select type_compte, numero_compte from v_soldes_comptes where individu_id=".$id_indiv."";
    $requete = executeQuery($sql);
    echo "<select name='listeCompte' id='listeCompte'>";
    while ( $result = $requete->fetch_row() )
    {
      echo "<option value='".$result[1]."'>Compte ".$result[1]."</option>";
    }
    echo "</select>";
  }

 ?>
