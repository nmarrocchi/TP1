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
                <link rel="icon" type="image/png" href="src/img/icon.png">
                <link rel='stylesheet' type='text/css' href='src/css/style.css'>
                <link rel='stylesheet' type='text/css' href='src/css/index.css'>
                <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
                <title>Accueil</title>
            </head>
            <body>
                <?php
                    include("menu.php");
                ?>
                <div class="back">
                    <h2>Accueil</h2>
                    <div class="text">
                        <p>
                            Le but du projet est de réaliser un site internet de la station de géolocalisation M56i. 
                            Il faut stocker les données récupérées sur le GPS en base de données. Les <a href="data.php">données</a> seront affichées 
                            sur une page dédiée et le <a href="trace.php">tracé</a> sera sur une autre page de l’application.
                        </p>
                    </div>
                </div>
            </body>
        </html>
    <?php
}
?>