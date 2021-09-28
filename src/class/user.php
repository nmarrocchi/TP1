<?php
    class user{

        // - Propriétés
        private $_id;
        private $_user;
        private $_passwd;
        private $_admin;
        private $_bdd;
        private $_req;

        // - Méthodes
        public function __construct($bdd){
            $this->_bdd = $bdd;
        }

        // Initialisation des variables
        public function setUser($id, $user, $_passwd, $admin){
            $this->_id = $id;
            $this->_user = $user;
            $this->_passwd = $_passwd;
            $this->_admin = $admin;
        }

        // Permet de récupérer les données de l'utilisateur en BDD
        public function setUserByID($id){
            $req = "SELECT * FROM `user` WHERE `id`='".$id."'";
            $Result = $this->_bdd->query($req);
            while($tab = $Result->fetch()){
                $this->setUser($tab["id"], $tab["user"], $tab["passwd"], $tab["admin"]);
            }
        }

        // Retour de la variable $_id
        public function getID(){
            return $this->_id;
        }

        // Retour de la variable $_user
        public function getuser(){
            return $this->_user;
        }

        // Retour de la variable $_admin
        public function getAdmin(){
            return $this->_admin;
        }
       
        //Fonction inscrire et insérer les données dans la bdd
        public function inscription(){
            $afficheForm = true;
            $error1 = false;
            $error2 = false;
            $_SESSION["Connected"] = false;
            if(isset($_POST["user"]) && isset($_POST["passwd"]) && isset($_POST["conf-passwd"])){
                if($_POST["passwd"] == $_POST["conf-passwd"]){
                    $this->_req = "SELECT COUNT(*) FROM `user` WHERE `user`='".$_POST['user']."' AND `passwd` = '".$_POST['passwd']."'";
                    $Result = $this->_bdd->query($this->_req);
                    $nbr = $Result->fetch();
                    if($nbr['COUNT(*)'] == 0){
                        $user = $_POST['user']; $passwd = $_POST['passwd']; $admin = 0;
                        $this->_req = "INSERT INTO `user`(`user`, `passwd`, `admin`) VALUES('$user', '$passwd', '$admin')";
                        $Result = $this->_bdd->query($this->_req);
                        $this->_req = "SELECT * FROM `user` WHERE `user`='".$_POST['user']."' AND `passwd` = '".$_POST['passwd']."'";
                        $Result = $this->_bdd->query($this->_req);
                        if($tab = $Result->fetch()){
                            $this->setUserByID($tab["id"]);
                            $_SESSION["id"] = $tab["id"];
                            $_SESSION["Connected"] = true;
                            $afficheForm = false;
                            header("location: index.php");
                        }
                    }else{
                        $error2 = true;
                    }
                }else{
                    $error1 = true;
                }
            }else{
                $afficheForm = true;
            }

            if($afficheForm == true){
                ?>
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>Inscription</title>
                        <link rel="icon" type="image/png" href="src/img/icon.png">
                        <link rel='stylesheet' type='text/css' href='src/css/index.css'>
                        <link rel='stylesheet' type='text/css' href='src/css/formulaire.css'>
                    </head>
                    <body>
                        <div class="back">
                            <div class="form-user">
                                <h2>Inscription</h2>
                                <form method="post">
                                    <?php
                                        if($error1 == true){
                                            ?><div class="erreur">Veuillez confirmer le même mot de passe</div><?php
                                        }
                                        if($error2 == true){
                                            ?><div class="erreur">Compte déjà existant</div><?php
                                        }
                                    ?>
                                    <div class="user">
                                        <input type="text" id="user" name="user" class="user-input" placeholder="Votre user" autocomplete="off" autocapitalize="off" required></input>
                                    </div>
                                    <div class="passwd">
                                        <input type="password" id="passwd" name="passwd" class="passwd-input" placeholder="Votre mot de passe" autocomplete="off" autocapitalize="off" required></input>
                                    </div>
                                    <div class="conf-passwd">
                                        <input type="password" id="conf-passwd" name="conf-passwd" class="conf-passwd-input" placeholder="Confirmer votre mot de passe" autocomplete="off" autocapitalize="off" required></input>
                                    </div>
                                    <div class="submit-button">
                                        <input type="submit" class="button" value="S'inscrire"></input>
                                    </div>
                                    <p><a href="index.php">Déjà entrée dans la Matrice</a></p>
                                </form>
                            </div>
                        </div>
                    </body>
                <?php
            }
        }

        //Fonction qui permet de se connecter
        public function connexion(){
            $afficheForm = true;
            $error = false;
            $_SESSION["Connected"] = false;
            if(isset($_POST["user"]) && isset($_POST["passwd"])){
                $this->_req = "SELECT * FROM `user` WHERE `user`='".$_POST['user']."' AND `passwd` = '".$_POST['passwd']."'";
                $Result = $this->_bdd->query($this->_req);
                if($tab = $Result->fetch()){
                    $this->setUserByID($tab["id"]);
                    $_SESSION["id"] = $tab["id"];
                    $_SESSION["Connected"] = true;
                    $afficheForm = false;
                }else{
                    $afficheForm = true;
                    $error = true;
                }
            }else{
                $afficheForm = true;
            }

            if($afficheForm == true){
                ?>
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>Connexion</title>
                        <link rel="icon" type="image/png" href="src/img/icon.png">
                        <link rel='stylesheet' type='text/css' href='src/css/index.css'>
                        <link rel='stylesheet' type='text/css' href='src/css/formulaire.css'>
                    </head>
                    <body>
                        <div class="back">
                            <div class="form-user">
                                <h2>Connexion</h2>
                                <form method="post">
                                    <?php
                                        if($error == true){
                                            ?><div class="erreur">user ou mot de passe invalide</div><?php
                                        }
                                    ?>
                                    <div class="user">
                                        <input type="text" id="user" name="user" class="user-input" placeholder="Votre user" autocomplete="off" autocapitalize="off" required></input>
                                    </div>
                                    <div class="passwd">
                                        <input type="password" id="passwd" name="passwd" class="passwd-input" placeholder="Votre mot de passe" autocomplete="off" autocapitalize="off" required></input>
                                    </div>
                                    <div class="submit-button">
                                        <input type="submit" class="button" value="Ouverture de session"></input>
                                    </div>
                                    <p><a href="inscription.php">Inscrit-toi pour accéder à la Matrice</a></p>
                                </form>
                            </div>
                        </div>
                    </body>
                <?php
            } 
        }

            //Fonction se deconnecter de la session
        public function deconnexion(){
            session_unset();
            session_destroy();
            unset($_POST);
            echo '<meta http-equiv="refresh" content="0">';
        }
    }
?>