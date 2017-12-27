<?php
    function affichageHistoriqueVirement($id_compte){

      $sql="select DATE_FORMAT(date_mouvement,'%d/%m/%Y'),libelle,montant,sens from v_mouvements_comptes where numero_compte_id=".$id_compte." and type_mouvement='V'";
      $requete = executeQuery($sql);
      $nbLignes=mysqli_num_rows($requete);
      if($nbLignes>0){
        echo '<table id="historiqueCompte" class="table table-striped table-bordered" cellspacing="0" width="100%">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Date</th>';
        echo '<th>Libell&eacute;</th>';
        echo '<th>D&eacute;bit (en €)</th>';
        echo '<th>Cr&eacute;dit (en €)</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tfoot>';
        echo '<tr>';
        echo '<th>Date</th>';
        echo '<th>Libell&eacute;</th>';
        echo '<th>D&eacute;bit (en €)</th>';
        echo '<th>Cr&eacute;dit (en €)</th>';
        echo '</tr>';
        echo '</tfoot>';
        echo '<tbody>';
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
        echo '</tbody>';
        echo '</table>';
      }
      else {
        echo "<h4>Aucun virement pour ce compte</h4>";
      }
    }
?>
