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
                    <title>Trace</title>
                    <link rel="icon" type="image/png" href="src/img/icon.png">
                    <link rel='stylesheet' type='text/css' href='src/css/style.css'>
                    <link rel='stylesheet' type='text/css' href='src/css/trace.css'>
                    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
                    <link href='https://api.mapbox.com/mapbox-gl-js/v2.5.0/mapbox-gl.css' rel='stylesheet' />
                    <script src='https://api.mapbox.com/mapbox-gl-js/v2.5.0/mapbox-gl.js'></script>
                </head>
                <body>
                    <?php
                        include("menu.php");
                    ?>
                    <div class="back">
                        <h2>Trace</h2>
                        <div class="map">
                            <div id='map'></div>
                        </div>
                    </div>
                    <script src='src/js/map.js'></script>
                    <script src='src/js/api.js'></script>
                </body> 
            <?php
        }
    ?>
</html>