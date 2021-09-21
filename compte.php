<?php

  include "session.php";
  include "Class/User.php";

  if (!isset($_SESSION['id'])){
    header("Location: index.php");
  }

  $user = new User($BDD);

?>

<!DOCTYPE html>
<html lang="fr">
  <head>
      <meta charset="UTF-8">
      <link rel="stylesheet" href="CSS/style.css" type="text/css">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="CSS/compte.css">
      <title>Accueil</title>
  </head>
  <body>

    <div class="Contenu">

      <form action="" method="post">
        <input type="submit" name="déco" value="Déconnexion">
      </form>

    </div>
    
    <?php 

    $user->afficheCoords();


      // - Bouton de déconnexion
      if(isset($_POST['déco']))
      {
        $user->SeDeconnecter();
      }
      ?>
  </body>
</html>