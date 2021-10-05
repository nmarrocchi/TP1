<!DOCTYPE html>
<html lang="fr">
<?php
    session_start(); // Ouverture de la session
    include('../../session.php'); // Appel de la page de session
    $user->setUserByID($_GET["user"]);

    if(isset($_POST['save'])){
        $user->updateUser($_GET["user"]);
        header("Refresh:0");
    }
    if(isset($_POST['suppr_confirm'])){
        $user->deleteUser($_GET["user"]);
        header('location: ../../admin.php');
    }

    if( $_SESSION["Connected"] == true ) {
        ?>
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Edit</title>
                <link rel="icon" type="image/png" href="../img/icon.png">
                <link rel='stylesheet' type='text/css' href='../css/style.css'>
                <link rel='stylesheet' type='text/css' href='../css/formulaire.css'>
                <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
            </head>
            <body>
                <div class="back">
                    <button id="retour" class="button"><a href="../../admin.php">Retour</a></button>
                    <h2><?= $user->getLogin(); ?></h2>
                    <div class="form">
                        <h4>Modification du compte</h4>
                        <?php
                            $user->formUser($_GET["user"]);
                        ?>
                    </div>
                </div>
                <script type="text/javascript" src="../js/edit.js"></script>
            </body>
        <?php
    }

?>
</html>