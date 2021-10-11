<?php

session_start();
include "session.php";

if($_SESSION["Connected"] == true){
    ?>
        <!DOCTYPE html>
        <html lang="fr">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel='stylesheet' type='text/css' href='src/css/style.css'>
                <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
                <title>Accueil</title>
            </head>
            <body>
                <?php
                    include("menu.php");
                ?>
            </body>
        </html>
    <?php
}
?>