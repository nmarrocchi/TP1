<!DOCTYPE html>
<html lang="fr">
<?php
    
    session_start();   // Ouverture de la session
    include("session.php"); // Appel de la page de session 

    if(isset($_POST['save'])){
        $user->updateUser($id);
        header("Refresh:0");
    }
    if(isset($_POST['suppr_confirm'])){
        $user->deleteUser($id);
        header('location: index.php');
    }

    if($_SESSION["Connected"] == true){
        ?>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Compte</title>
            <link rel="icon" type="image/png" href="src/img/icon.png">
            <link rel='stylesheet' type='text/css' href='src/css/style.css'>
            <link rel='stylesheet' type='text/css' href='src/css/compte.css'>
            <link rel='stylesheet' type='text/css' href='src/css/formulaire.css'>
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
        </head>
        <body>
            <?php
                include("menu.php");
            ?>
            <div class="back">
                <h2>Compte</h2>
                <?php $id = $user->getID(); ?>
                <div class="form">
                    <h4>Modifier le compte</h4>
                    <?php $user->formUser($id); ?>
                </div>
            </div>
            <script type="text/javascript" src="src/js/edit.js"></script>
        </body> 
    <?php
    }
?>            
</html>