<?php

// - Retourne si user connecté ou non
function check() {
    if ($_SESSION["Logged"] !== true) {
      return false;
    }else{
        return true;
    }
}

// - Suppression du compte
function DeleteAccount(){
    if(isset($_POST["Delete_Account"])){
        $_SESSION["Logged"] = false;
        $Account_Delete = $BDD->query("DELETE FROM `user` WHERE id = '".$_SESSION["ID_User"]."'")THEN CAST(1 AS BIT)ELSE CAST(0 AS BIT) END;
        header("location: index.php");
    }
}

// - Fonction Affiche Coordonnées
function afficheCoords($BDD){
    $Coords = $BDD->query("SELECT * FROM GPS");
?>
    <table class="GPS_Coords">
<?php

    while($CoordsList = $Coords->fetch()){

    ?>
        <tr>
            <td>latitude : <?php echo $CoordsList['Latitude']?></td>
            <td>Longitude : <?php echo $CoordsList['Longitude'] ?></td>
        </tr>
    <?php
    }
}