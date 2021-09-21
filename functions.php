<?php

// - Retourne si user connecté ou non
function check() {
    if ($_SESSION["Logged"] !== true) {
      return false;
    }else{
        return true;
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

// - Select All of user in bdd
function selectAllUsers($BDD){
    $Users = $BDD->query("SELECT * FROM user");
?>

    <table class='User_List'>
        <tr><td colspan="5">List Of Users</td></tr>
        <tr>
            <td>ID</td>
            <td>Username</td>
            <td>Password</td>
            <td>IsAdmin</td>
            <td></td>
        </tr>

<?php
    while($UsersList = $Users->fetch()){
        ?>
            <tr class="userTab" id="<?php echo $UsersList['user']?>">
                <td><?php echo $UsersList['id']?></td>
                <td><?php echo $UsersList['user']?></td>
                <td><?php echo $UsersList['passwd']?></td>
                <td><?php echo $UsersList['IsAdmin']?></td>
                <td><input type="checkbox" id="<?php echo $UsersList['user']?>">
            </tr>
        <?php
    }
}
?>