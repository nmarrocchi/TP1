<?php

    class boat {

        /* PRIVATE */
        private $_idboat;
        private $_name;
        private $_color;
        private $_idPins;
        private $_latitude;
        private $_longitude;
        private $_date;
        private $_bdd;
        private $_req;

        /* METHOD */
        public function __construct($bdd){
            $this->_bdd = $bdd;
        }

        // Initialisation des variables
        public function setBoat($idboat, $name, $color, $idPins, $latitude, $longitude, $date){
            $this->_idboat = $idboat;
            $this->_name = $name;
            $this->_color = $color;
            $this->_idPins = $idPins;
            $this->_latitude = $latitude;
            $this->_longitude = $longitude;
            $this->_date = $date;
        }

        // Permet de récupérer les données du bateau en BDD
        public function setBoatID($idboat, $idPins){
            $req = "SELECT * FROM `boats`, `pins` WHERE boats.id = '".$idboat."' AND pins.id = '".$idPins."'";
            $Result = $this->_bdd->query($req);
            while($tab = $Result->fetch()){
                $this->setBoat($tab["boat.id"], $tab["boat.name"], $tab["boat.color"], $tab["pins.id"], $tab["pins.latitude"], $tab["pins.longitude"], $tab["pins.date"]);
            }
        }

        // Retour de la variable $_ID 
        public function getID(){
            return $this->_id;
        }

        // Retour de la variable $_user
        public function getDate(){
            return $this->_date;
        }

        // Retour de la variable $_latitude
        public function getLatitude(){
            return $this->_latitude;
        }

        // Retour de la variable $_longitude
        public function getLongitude(){
            return $this->_longitude;
        }

        // Affiche les données (Nom du bateau, latitude, longitude, date) du bateau depuis la BDD
        public function selectData(){
            $this->_req = "SELECT boats.name, pins.longitude, pins.latitude, pins.date FROM `boats`, `pins` WHERE pins.idBoat = boats.id";
            $Result = $this->_bdd->query($this->_req);
            ?>
                <table>
                    <thead>
                        <tr>
                            <td>Nom</td>
                            <td>Latitude</td>
                            <td>Longitude</td>
                            <td>Date</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            while($tab = $Result->fetch()){ ?>
                                <tr>
                                    <td><?= $tab["name"]; ?></td>
                                    <td><?= $tab["latitude"]; ?></td>
                                    <td><?= $tab["longitude"]; ?></td>
                                    <td><?= $tab["date"]; ?></td>
                                </tr>
                            <?php
                            }
                        ?>
                    </tbody>
                </table>
            <?php
        }

        // Permet d'ajouter un bateau en BDD
        public function insertBoat(){
            if(isset($_POST["name"])){
                $name = $_POST['name'];
                $color = colorBoat();
                $this->_req = "INSERT INTO `boats`(`name`, `color`) VALUES('$name', '$color')";
            }
            ?>
                <form method="post">
                    <div class="name">
                        <input type="text" id="name" name="name" class="login-input" placeholder="Nom du Bateau" autocomplete="off" autocapitalize="off" required></input>
                    </div>
                    <div class="submit-button">
                        <input type="submit" class="button" value="Ajouter"></input>
                    </div>
                </form>
            <?php
        }

        // Permet d'ajouter une coordonnee en BDD
        public function insertCoordonnee($idboat){
            $this->_req = "INSERT INTO `pins`(`idBoat`, `longitude`, `latitude`) VALUES ('$idboat', '$this->_longitude', '$this->_latitude')";
        }

        // Génère une couleur aléatoire en hexadécimal
        public function colorBoat(){
            $hex = '#';
            foreach(array('r', 'g', 'b') as $color){
                $val = mt_rand(0, 255);
                // Convertion de la valeur décimal en hexadécimal
                $dechex = dechex($val);
                if(strlen($dechex) < 2){
                    $dechex = "0" . $dechex;
                }
                $hex .= $dechex;
            }
            return $hex;
        }
    }

?>