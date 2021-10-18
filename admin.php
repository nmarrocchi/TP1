<!DOCTYPE html>
<html lang="fr">
<?php
    
    session_start();   // Ouverture de la session
    include("session.php"); // Appel de la page de session

    if($_SESSION["Connected"] == true){
        ?>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Adminstration</title>
            <link rel="icon" type="image/png" href="src/img/icon.png">
            <link rel='stylesheet' type='text/css' href='src/css/style.css'>
            <link rel='stylesheet' type='text/css' href='src/css/adminpanel.css'>
            <link rel='stylesheet' type='text/css' href='src/css/formulaire.css'>
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
        </head>
        <body>
            <?php
                include("menu.php");
            ?>
            <div class="back">
                <h2>Adminstration</h2>
                <?php
                    $admin = $user->getAdmin();
                    if($admin == 1){
                        ?>
                        <div class="settingUser">
                            <div class="form">  
                                <h3>Paramètre Utilisateur</h3>
                                <div class="insertUser">
                                    <h4>Ajouter un utilisateur</h4>
                                    <?php
                                        $user->insertUser();
                                    ?>
                                </div>
                            </div>
                            <?php
                                $user->selectUser();
                            ?>
                        </div>
                        <div class="settingBoat">
                            <h3>Paramètre Bateau</h3>
                            <div class="form">  
                                <div class="insertBoat">
                                    <h4>Ajouter un bateau</h4>
                                    <?php
                                        $boat->insertBoat();
                                    ?>
                                </div>
                            </div>
                            <?php
                                $boat->selectBoat();
                            ?>
                        </div>
                        <?php
                    }else{
                        ?>
                            <div class="return">
                                <p> Vous n'avez pas les autorisations requises pour accéder à cette page </p>
                                <button class="return-button">
                                    <a href="index.php"> Retour à la page d'accueil </a>
                                </button>
                            </div>
                        <?php
                    }
                ?>
            </div>
        </body> 
    <?php
    }
?>            
</html>