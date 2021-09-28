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
                </head>
                <body>
                    <?php
                        include("menu.php");
                    ?>
                    <div class="back">
                        <h2>Trace</h2>
                        <div class="map">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d44220.31334260825!2d6.622076732059168!3d46.15533420337775!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x478c032886d61ced%3A0x3bccd215dc1e5333!2sLes%20Gets!5e0!3m2!1sfr!2sfr!4v1631533352679!5m2!1sfr!2sfr" class="trace" loading="lazy"></iframe>
                        </div>
                    </div>
                </body> 
            <?php
        }
    ?>
</html>