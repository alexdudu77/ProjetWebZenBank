<?php
  // On démarre la session
  if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
  }

  require "traitement.php"
?>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">Zen Bank</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="index.php">Home</a></li>
        <li class="active"><a href="interfaceClientSyntheseCompte.php">Mon espace client</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><h2 id="messageBienvenue">Bonjour <?php echo $_SESSION['nom'] . ' ' . $_SESSION['prenom'];  ?></h2></li>
        <li><a href="index.php"><button type="button" class="btn btn-danger">
          Se déconnecter <span class="glyphicon glyphicon-log-out"></span>
        </button></a></li>
      </ul>
    </div>
  </div>
</nav>
