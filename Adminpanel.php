<?php

  include "session.php";
  include "Class/User.php";
  include "functions.php";

  if (!isset($_SESSION['id'])){
    header("Location: index.php");
  }

  $user = new User($BDD);

      // - Check user is Admin
      if ($user->admin($BDD) == 0){
        header("Location: compte.php");
      }
      else if( ($user->admin($BDD) != 0) && ($user->admin($BDD) != 1)  )
      {
        header("Location: index.php");
      }
      

?>

<!DOCTYPE html>
<html lang="fr">
  <head>
      <meta charset="UTF-8">
      <link rel="stylesheet" href="CSS/style.css" type="text/css">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="CSS/adminpanel.css">
      <title>Accueil</title>
  </head>
  <body>

    <div class="Contenu">

      <form action="" method="post">
        <input type="submit" name="déco" value="Déconnexion">
        <input type="submit" name="=Coords" value="Coordonnées">
      </form>

    </div>
    
    <?php 

      // - Bouton de déconnexion
      if(isset($_POST['déco']))
      {
        $user->SeDeconnecter();
      }

      if(isset($_POST['Coords']))
      {
        header("location: compte.php");
      }

      selectAllUsers($BDD);

      ?>
  </body>
</html>