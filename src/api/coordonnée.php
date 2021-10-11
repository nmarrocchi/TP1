<?php

    include('../../session.php');

    $coordonnee[0] = $boat->getLatitude();
    $coordonnee[1] = $boat->getLongitude();
    echo json_encode($coordonnee);

?>