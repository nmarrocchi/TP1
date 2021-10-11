<?php
    include "src/class/user.php";
    include "src/class/boat.php";

    /*// - Gestion de la bdd VM
    $host = "192.168.64.204";
    $dbname = "Lawrence";
    $login = "admin";
    $mdp = "admin";*/

    // - Gestion de la bdd locale
    $host = "localhost";
    $dbname = "Lawrence";
    $login = "root";
    $mdp = "";

    $bdd = new PDO('mysql:host='.$host.'; dbname='.$dbname.'; charset=utf8', $login, $mdp);

    $user = new user($bdd);
    $boat = new boat($bdd);

    if($_SERVER['PHP_SELF'] != "/TP2/inscription.php"){
        if (isset($_SESSION["Connected"]) && $_SESSION["Connected"] == true){
            if(isset($_SESSION["id"])){
                $user->setUserByID($_SESSION["id"]);
            }
        }else{
            $user->connexion();
        }
    }
?>