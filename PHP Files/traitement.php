<?php
  function executeQuery($sql){
      $c = new mysqli("localhost", "root", "root", "zenbanque", 3306);
      if($c->connect_errno){
              //si erreur de connection
          return "Pb BDD";
      }
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

  ?>
