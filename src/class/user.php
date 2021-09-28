<?php
    class user{

        // - Propriétés
        private $_id;
        private $_login;
        private $_mdp;
        private $_admin;
        private $_bdd;
        private $_req;

        // - Méthodes
        public function __construct($bdd){
            $this->_bdd = $bdd;
        }

        // Initialisation des variables
        public function setUser($id, $login, $mdp, $admin){
            $this->_id = $id;
            $this->_login = $login;
            $this->mdp = $mdp;
            $this->_admin = $admin;
        }

        // Permet de récupérer les données de l'utilisateur en BDD
        public function setUserByID($id){
            $req = "SELECT * FROM `users` WHERE `_ID`='".$id."'";
            $Result = $this->_bdd->query($req);
            while($tab = $Result->fetch()){
                $this->setUser($tab["_ID"], $tab["login"], $tab["mdp"], $tab["admin"]);
            }
        }

        // Retour de la variable $__ID 
        public function getID(){
            return $this->_id;
        }

        // Retour de la variable $_user
        public function getLogin(){
            return $this->_login;
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
            if(isset($_POST["login"]) && isset($_POST["mdp"]) && isset($_POST["conf-mdp"])){
                if($_POST["mdp"] == $_POST["conf-mdp"]){
                    $this->_req = "SELECT COUNT(*) FROM `users` WHERE `login`='".$_POST['login']."' AND `_password` = '".$_POST['mdp']."'";
                    $Result = $this->_bdd->query($this->_req);
                    $nbr = $Result->fetch();
                    if($nbr['COUNT(*)'] == 0){
                        $login = $_POST['login']; $mdp = $_POST['mdp']; $admin = 0;
                        $this->_req = "INSERT INTO `users`(`login`, `_password`, `admin`) VALUES('$login', '$mdp', '$admin')";
                        $Result = $this->_bdd->query($this->_req);
                        $this->_req = "SELECT * FROM `users` WHERE `login`='".$_POST['login']."' AND `_password` = '".$_POST['mdp']."'";
                        $Result = $this->_bdd->query($this->_req);
                        if($tab = $Result->fetch()){
                            $this->setUserByID($tab["_ID"]);
                            $_SESSION["_ID"] = $tab["_ID"];
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
                        <link rel='stylesheet' type='text/css' href='src/css/style.css'>
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
                                    <div class="login">
                                        <input type="text" id="login" name="login" class="login-input" placeholder="Votre login" autocomplete="off" autocapitalize="off" required></input>
                                    </div>
                                    <div class="mdp">
                                        <input type="password" id="mdp" name="mdp" class="mdp-input" placeholder="Votre mot de passe" autocomplete="off" autocapitalize="off" required></input>
                                    </div>
                                    <div class="conf-mdp">
                                        <input type="password" id="conf-mdp" name="conf-mdp" class="conf-mdp-input" placeholder="Confirmer votre mot de passe" autocomplete="off" autocapitalize="off" required></input>
                                    </div>
                                    <div class="submit-button">
                                        <input type="submit" class="button" value="S'inscrire"></input>
                                    </div>
                                    <p><a href="index.php">Déjà un compte</a></p>
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
            if(isset($_POST["login"]) && isset($_POST["mdp"])){
                $this->_req = "SELECT * FROM `users` WHERE `login`='".$_POST['login']."' AND `_password` = '".$_POST['mdp']."'";
                $Result = $this->_bdd->query($this->_req);
                if($tab = $Result->fetch()){
                    $this->setUserByID($tab["_ID"]);
                    $_SESSION["_ID"] = $tab["_ID"];
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
                        <link rel='stylesheet' type='text/css' href='src/css/style.css'>
                        <link rel='stylesheet' type='text/css' href='src/css/formulaire.css'>
                    </head>
                    <body>
                        <div class="back">
                            <div class="form-user">
                                <h2>Connexion</h2>
                                <form method="post">
                                    <?php
                                        if($error == true){
                                            ?><div class="erreur">login ou mot de passe invalide</div><?php
                                        }
                                    ?>
                                    <div class="login">
                                        <input type="text" id="login" name="login" class="login-input" placeholder="Votre login" autocomplete="off" autocapitalize="off" required></input>
                                    </div>
                                    <div class="mdp">
                                        <input type="password" id="mdp" name="mdp" class="mdp-input" placeholder="Votre mot de passe" autocomplete="off" autocapitalize="off" required></input>
                                    </div>
                                    <div class="submit-button">
                                        <input type="submit" class="button" value="Ouverture de session"></input>
                                    </div>
                                    <p><a href="inscription.php">Register</a></p>
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