<?php

    //include('../../session.php');
    /*$host = "localhost";
    $dbname = "Lawrence";
    $login = "root";
    $mdp = "";*/

    $host = "192.168.64.204";
    $dbname = "Lawrence";
    $login = "admin";
    $mdp = "admin";

    $bdd = new PDO('mysql:host='.$host.'; dbname='.$dbname.'; charset=utf8', $login, $mdp);

    $req = "SELECT pins.id, pins.idBoat, pins.longitude, pins.latitude, pins.date, boats.name, boats.color FROM `boats`, `pins` WHERE pins.idBoat = boats.id";
    $Result = $bdd->query($req);
    echo json_encode($Result->fetchAll());
?>