<?php

    class bateau {

        /* PRIVATE */
        private $_bateauID;
        private $_date;
        private $_heure;
        private $_latitude;
        private $_longitude;
        private $_vitesse;
        private $_vitesmoy;
        private $_bdd;
        private $_req;

        /* METHOD */
        public function __construct($bdd){
            $this->_bdd = $bdd;
        }

        // Affiche les données (bateauID, date, heure, latitude, longitude, vitesse, vitesmoy) du bateau depuis la BDD
        public function selectData(){
            $this->_req = "SELECT * FROM `bateau` WHERE 1";
            $Result = $this->_bdd->query($this->_req);
            ?>
                <table>
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Date</td>
                            <td>Heure</td>
                            <td>Latitude</td>
                            <td>Longitude</td>
                            <td>Vitesse</td>
                            <td>Vitesse Moyenne</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($tab = $Result->fetch()){ ?>
                            <tr>
                                <td><?= $tab['bateauID']; ?></td>
                                <td><?= $tab['date']; ?></td>
                                <td><?= $tab['heure']; ?></td>
                                <td><?= $tab['latitude']; ?></td>
                                <td><?= $tab['longitude']; ?></td>
                                <td><?= $tab['vitesse']; ?></td>
                                <td><?= $tab['vitesmoy']; ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            <?php
        }
    }

?>