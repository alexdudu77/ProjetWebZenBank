<?php
    require "traitement.php";

    $err = null;
    if (!empty($_POST["email"]) && !empty($_POST["mdp"]))
    {
        $email = $_POST["email"];
        $mdp = $_POST["mdp"];
        $sql = "select id from individus where email='".mysqli_real_escape_string(.$email.)"' and mot_de_passe = '".mysqli_real_escape_string(.$mdp.)"'";
        executeQuery($sql);
				$result = $sql->fetch_row();
				$count = mysqli_num_rows($result);
				if($count == 1) {
					$err = "OK";
				else
					$err "KO";
				}
    }
    else {
      $err = "KO";
    }
    if ($err == "KO") {
      $P = "'Location:index.html?erreur='".$err."'";
      header($P);
    else
      header('Location:nouveauclient.html');
    }
?>
