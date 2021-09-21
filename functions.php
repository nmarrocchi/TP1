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
if(isset($_POST["Delete_Account"])){
    $_SESSION["Logged"] = false;
    $Account_Delete = $BDD->query("DELETE FROM `user` WHERE id = '".$_SESSION["ID_User"]."'");
    header("location: index.php");
}