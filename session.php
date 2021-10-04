<?php
    include "src/class/user.php";

    $host = "127.0.0.1";
    $dbname = "tp2";
    $login = "root";
    $mdp = "";

    /*// - Gestion de la bdd
    $host = "192.168.64.204";
    $dbname = "tp1";
    $login = "admin";
    $mdp = "admin";*/

    $bdd = new PDO('mysql:host='.$host.'; dbname='.$dbname.'; charset=utf8', $login, $mdp);

    $user = new user($bdd);

    //$fonction = new fonction($bdd);

    if (isset($_SESSION["Connected"]) && $_SESSION["Connected"] == true){
        if(isset($_SESSION["userID"])){
            $user->setUserByID($_SESSION["userID"]);
        }
    }else{
        $user->connexion();
    }
?>