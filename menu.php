<link rel='stylesheet' type='text/css' href='src/css/menu.css'>

<header class="header">
    <nav class="navbar">
        <ul class="navbar-gauche">
            <li>
                <a href="index.php">
                    <span class="titre">TP2 - GPS</span>
                </a>
            </li>
            <li>
                <a href="data.php">
                    <i class="fas fa-table"></i>
                </a>
            </li>
            <li>
                <a href="trace.php">
                    <i class="fas fa-map-marked"></i>
                </a>
            </li>
            <?php
                $admin = $user->getAdmin();
                if($admin == true){
                    ?>
                        <li>
                            <a href="admin.php">
                                <i class="fas fa-user-cog"></i>
                            </a>
                        </li>
                    <?php
                }
            ?>
        </ul>
        <ul class="navbar-droite">
            <div class="dropdown">
                <button onclick="profilFunction()" class="dropdown-profil-menu">
                    <i class="fas fa-user"></i>
                    <?php
                        $login = $user->getLogin();
                        echo $login;
                    ?>
                    <i class="fas fa-caret-down"></i>
                </button>
                <div id="dropdown-profil" class="dropdown-profil">
                    <form action="compte.php" method="post">
                    <button type="submit" class="dropdown-deconnexion">
                        <i class="fas fa-user"></i>
                        Compte
                    </button>
                    </form>
                    <form method="post">
                        <button type="submit" name="logout" class="dropdown-deconnexion">
                            <i class="fas fa-sign-out-alt"></i>
                            Se déconnecter
                            <?php
                                if(isset($_POST["logout"])){
                                    $user->deconnexion();
                                }
                            ?>
                        </button>
                    </form>
                </div>
            </div>
        </ul>
    </nav>
    <nav class="navbar-collapse">
        <ul class="navbar-gauche">
            <li>
                <a href="index.php">
                    <i class="fa-solid fa-globe"></i>
                    <span class="titre">Titre</span>
                </a>
            </li>
        </ul>
        <ul class="navbar-droite">
            <div class="dropdown">
                <button id="menu-collapse" class="menu-collapse">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </ul>
    </nav>
    <nav id="sidebar-menu" class="sidebar-menu">
        <li>
            <a href="data.php">Data</a>
        </li>
        <li>
            <a href="trace.php">Trace</i></a>
        </li>
        <?php
            $admin = $user->getAdmin();
            if($admin == true){
                ?>
                    <li>
                        <a href="admin.php">Administration</a>
                    </li>
                <?php
            }
        ?>
    </div>
</header>

<script type="text/javascript" src="src/js/menu.js"></script>