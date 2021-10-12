<?php

    //include('../../session.php');
    $host = "localhost";
    $dbname = "Lawrence";
    $login = "root";
    $mdp = "";

    $bdd = new PDO('mysql:host='.$host.'; dbname='.$dbname.'; charset=utf8', $login, $mdp);

    $req = "SELECT pins.id, pins.longitude, pins.latitude, pins.date, boats.color FROM `boats`, `pins` WHERE pins.idBoat = boats.id";
    $Result = $bdd->query($req);
    echo json_encode($Result->fetchAll());
?>