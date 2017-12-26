<?php
    function affichageHistoriqueCompte($id_compte){
      $sql="select DATE_FORMAT(date_mouvement,'%d/%m/%Y'),libelle,montant,sens from v_mouvements_comptes where numero_compte_id=".$id_compte."";
      $requete = executeQuery($sql);
      while ($result = $requete->fetch_row()){
        if ($result[3]=='D') {
          echo "<tr>";
          echo "<td>".$result[0]."</td>";
          echo "<td>".$result[1]."</td>";
          echo "<td>".$result[2]."</td>";
          echo "<td></td>";
          echo "</tr>";
        }
        elseif ($result[3]=='C') {
          echo "<tr>";
          echo "<td>".$result[0]."</td>";
          echo "<td>".$result[1]."</td>";
          echo "<td></td>";
          echo "<td>".$result[2]."</td>";
          echo "</tr>";
        }
        else {
          echo "Erreur de traitement de Base de Données";
        }
      }
    }
?>
