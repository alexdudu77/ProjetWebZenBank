<?php

function afficherRIBComptes($id_indiv, $num_compte)
{
    $sql = "select individu_id, numero_compte, code_agence, code_banque, cle_rib, libelle_agence from v_listes_comptes where individu_id=".$id_indiv." and numero_compte ='".$num_compte."'";
    $requete = executeQuery($sql);
    /* En tête du tableau */
    echo("<thead>");
      echo("<tr>");
        echo("<th>Banque</th>");
        echo("<th>Guichet</th>");
        echo("<th>Compte</th>");
        echo("<th>RIB</th>");
        echo("<th>Agence</th>");
      echo("</tr>");
    echo("</thead>");
    echo("<tbody>");
    /* Contenu du tableau */ 
    while ( $result = $requete->fetch_row() )
    {
        echo("<tr>");
        echo("<td>".$result[3]."</td>");
        echo("<td>".$result[2]."</td>");
        echo("<td>".$result[1]."</td>");
        echo("<td>".$result[4]."</td>");
        echo("<td>".$result[5]."</td>");
        echo("</tr>");
    }
    echo("</tbody>");
}

?>
