<?php
    include "src/class/user.php";
    include "src/class/bateau.php";

    // - Gestion de la bdd
    $host = "192.168.64.204";
    $dbname = "Lawrence";
    $login = "admin";
    $mdp = "admin";

    /*// - Gestion de la bdd
    $host = "192.168.64.204";
    $dbname = "tp1";
    $login = "admin";
    $mdp = "admin";*/

    $bdd = new PDO('mysql:host='.$host.'; dbname='.$dbname.'; charset=utf8', $login, $mdp);

    $user = new user($bdd);
    //$bateau = new bateau($bdd);

    if($_SERVER['PHP_SELF'] != "/TP2/inscription.php"){
        if (isset($_SESSION["Connected"]) && $_SESSION["Connected"] == true){
            if(isset($_SESSION["_ID"])){
                $user->setUserByID($_SESSION["_ID"]);
            }
        }else{
            $user->connexion();
        }
    }
?>