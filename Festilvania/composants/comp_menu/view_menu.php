<?php

class ViewMenu {

    public function __construct() {
        
    }

    public function getNavbar() {
        echo '<nav class="navbar fixed-top navbar-expand-lg navbar-light">
                <div class="container">
                    <a class="navbar-brand" id="logo-text" href="#"><img src="img/logotest.png" alt="logo" id="logo"></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        
                        <ul class="navbar-nav">
                            <li class="nav-item active">
                                <a class="nav-link lien-navbar" href="index.php">Accueil</a>
                            </li>
                            <li class="nav-item">
                                    <a class="nav-link lien-navbar" href="#">Concerts</a>
                            </li>
                            <li class="nav-item">
                                    <a class="nav-link lien-navbar" href="#">Festivals</a>
                            </li>
                            <li class="nav-item dropdown dropdown-autre mb-1">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    Autres
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <div class="dropdown-divider"></div>    
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </li>
                        </ul>

                        <form class="col-lg-6 mb-1" id="form-search">
                            <div class="input-group col-xs-12 col-md-12">
                                <input class="form-control" id="search-bar" type="search" placeholder="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-search" type="submit"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>';

                        $this->getUserMenu();

        echo        '</div>
                </div>        
            </nav>';
    }

    public function getUserMenu() {
        if (isset($_SESSION['isConnected']) && isset($_SESSION['pseudo'])) {
            if ($_SESSION['isConnected']) {
                $this->getConnectedUserMenu();
            }
            else {
                $this->getUnconnectedUserMenu();
            }
        }
        else {
            $this->getUnconnectedUserMenu();
        }
    }

    public function getConnectedUserMenu() {
        echo    '<ul class="navbar-nav navbar-user">
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                            <img src="' . $_SESSION['avatar'] . '" alt="" id="navbarAvatar"/>' . $_SESSION['pseudo'] . '
                        </a>
                        <div class="dropdown-menu dropdown-custom">
                            <a href="index.php?mod=profile" class="dropdown-item">Mon profil</a>
                            <div class="dropdown-divider"></div>
                            <a href="index.php?action=disconnection" class="dropdown-item">Se deconnecter</a>
                        </div>
                    </li>
                </ul>';
    }

    public function getUnconnectedUserMenu() {
        echo    '<ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link lien-navbar" href="test.html">Inscription</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                            Connexion
                        </a>
                        <div class="dropdown-menu dropdown-custom">
                            <form method="post" action="index.php?action=connection">
                                <input type="text" placeholder="Pseudonyme" name="pseudo"></input>
                                <input type="text" placeholder="Mot de passe" name="password"></input>
                                <button class="btn btn-custom" id="btn-connect" type="submit">Se connecter</button>
                            </form>
                        </div>
                    </li>
                </ul>';
    }

}

?>