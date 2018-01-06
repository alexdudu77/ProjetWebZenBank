<?php

  function afficherListeBeneficiaires($id_indiv)
  {
    //On récupère les bénéficiaires via la requête
    $sql = "select id,libelle from beneficiaires where individu_source_id=".$id_indiv."";
    $requete = executeQuery($sql);
    echo "<select name='listeBeneficiaire'>";
   // On charge le résultat de la requête dans la liste déroulante
    while ( $result = $requete->fetch_row() )
    {
      echo "<option value='".$result[0]."'>".$result[1]."</option>";
    }
    echo "</select>";
  }

?>
