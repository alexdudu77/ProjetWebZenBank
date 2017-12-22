<?php

  function afficherComptesClient($id_indiv)
  {
    $sql = "select type_compte, numero_compte, solde from v_soldes_comptes where individu_id=".$id_indiv."";
    $requete = executeQuery($sql);

    while ( $result = $requete->fetch_row() )
    {
        $compte = $result[1];
        $libelle = "interfaceClientHistoriqueCompte.php?compte=".$compte."";
        echo "<div class='compte'>";
        echo "<a href='$libelle'>".$compte."</a> ";
        echo "<span>".$result[2]." €</span>";
        echo "</div>";
      }

  }

?>
