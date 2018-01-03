<?php

  function afficherComptesClient($id_indiv)
  {
    $sql = "select libelle_type_compte, numero_compte, solde from v_soldes_comptes where individu_id=".$id_indiv."";
    $requete = executeQuery($sql);
    while ( $result = $requete->fetch_row() )
    {
        $compte = $result[1];
        $libelle = "interfaceClientHistoriqueCompte.php?compte=".$compte."";
        echo "<div class='compte'>";
        echo "<a href='$libelle'>".$result[0]."</a> ";
        echo "<span>".$compte."</span> ";
        echo "<span>".$result[2]." € </span>";
        echo("<td><a href=interfaceClientRIB.php?numcompte=".$compte."><input type='button' name='action' value='Editer RIB'/></a></td>");
        echo "</div>";
      }
      
      $sql = "select sum(solde) as solde_total from v_soldes_comptes where individu_id=".$id_indiv." group by individu_id";
      $requete = executeQuery($sql);
      $result = $requete->fetch_row();
      echo "<div id='totalSolde'>";
      echo "<h3>Total Solde</h3>";
      echo "<span>".$result[0]." €</span>";
      echo "</div>";

  }

?>
