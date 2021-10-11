<?php

    class boat {

        /* PRIVATE */
        private $_id;
        private $_date;
        private $_latitude;
        private $_longitude;
        private $_bdd;
        private $_req;

        /* METHOD */
        public function __construct($bdd){
            $this->_bdd = $bdd;
        }

        // Initialisation des variables
        public function setBoat($id, $date, $latitude, $longitude){
            $this->_id = $id;
            $this->_date = $date;
            $this->_latitude = $latitude;
            $this->_longitude = $longitude;
        }

        // Permet de récupérer les données de l'utilisateur en BDD
        public function setBoatID($id){
            $req = "SELECT * FROM `boats` WHERE `id`='".$id."'";
            $Result = $this->_bdd->query($req);
            while($tab = $Result->fetch()){
                $this->setBateau($tab["id"], $tab["date"], $tab["latitude"], $tab["longitude"]);
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

        // Affiche les données (bateauID, date, heure, latitude, longitude, vitesse, vitesmoy) du bateau depuis la BDD
        public function selectData(){
            ?>
                <table>
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Date</td>
                            <td>Latitude</td>
                            <td>Longitude</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($tab = $Result->fetch()){ ?>
                            <tr>
                                <td><?= $this->_id; ?></td>
                                <td><?= $this->_date; ?></td>
                                <td><?= $this->_lantitude; ?></td>
                                <td><?= $this->_longitude; ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            <?php
        }

        public function insertCoordonnee(){
            
        }
    }

?>