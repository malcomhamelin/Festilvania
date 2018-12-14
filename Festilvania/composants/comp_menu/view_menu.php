<?php

class ViewMenu {

    public function __construct() {
        
    }

    public function getNavbar() {
        require_once "template_menu.php";
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
                    <li class="nav-item dropdown active">
                        <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                            <img src="' . $_SESSION['avatar'] . '" alt="avatar" class="" id="navbarAvatar"/><span class="pl-3">' . $_SESSION['pseudo'] . '</span>
                        </a>
                        <div class="dropdown-menu">
                            <a href="index.php?mod=profile" class="dropdown-item">Mon profil</a>
                            <a href="index.php?mod=timeline&option=myschedule" class="dropdown-item">Mon agenda</a>
                            <div class="dropdown-divider"></div>
                            <a href="index.php?action=disconnection" class="dropdown-item">Se deconnecter</a>
                        </div>
                    </li>
                </ul>';
    }

    public function getUnconnectedUserMenu() {
        echo    '<ul class="navbar-nav mx-auto">
                    <li class="nav-item active">
                        <a class="nav-link lien-navbar" href="index.php?mod=register">Inscription</a>
                    </li>
                    <li class="nav-item dropdown active">
                        <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                            Connexion
                        </a>
                        <div class="dropdown-menu dropdown-custom">
                            <form method="post" action="index.php?action=connection">
                                <input type="text" class="form-control mb-2" placeholder="Pseudonyme" name="pseudo"></input>
                                <input type="password" class="form-control mb-2" placeholder="Mot de passe" name="password"></input>
                                <button class="btn btn-custom float-right" id="btn-connect" type="submit">Se connecter</button>
                            </form>
                        </div>
                    </li>
                </ul>';
    }

}

?>