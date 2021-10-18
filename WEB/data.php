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
            <title>Data</title>
            <link rel="icon" type="image/png" href="src/img/icon.png">
            <link rel='stylesheet' type='text/css' href='src/css/style.css'>
            <link rel='stylesheet' type='text/css' href='src/css/data.css'>
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
        </head>
        <body>
            <?php
                include("menu.php");
            ?>
            <div class="back">
                <h2>Data</h2>
                <div class="datatable">
                    <?php $boat->selectData(); ?>
                </div>
            </div>
        </body> 
        <?php
    }
?>
</html>