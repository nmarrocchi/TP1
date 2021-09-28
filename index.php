<?php

session_start();
include "session.php";

if($_SESSION["Connected"] == true){
    ?>
        <!DOCTYPE html>
        <html lang="fr">
            <head>
                <meta charset="UTF-8">
                <link rel='stylesheet' type='text/css' href='src/css/index.css'>
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Accueil</title>
            </head>
            <body>
            </body>
        </html>
    <?php
}
?>