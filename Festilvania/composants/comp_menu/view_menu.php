<?php

require_once "generic/view_generic.php";

class ViewMenu extends ViewGeneric {

    public function __construct() {
        
    }

    public function getNavbar($rights, $categories) {
        require_once "template_menu.php";
    }

    public function getUserMenu($rights) {
        if (isset($_SESSION['isConnected']) && isset($_SESSION['pseudo']) && $_SESSION['isConnected']) {
            $this->getConnectedUserMenu($rights);
        }
        else {
            $this->getUnconnectedUserMenu();
        }
    }

    public function getConnectedUserMenu($rights) {
        echo    '<ul class="navbar-nav navbar-user">
                    <li class="nav-item dropdown active">
                        <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                            <img src="' . $_SESSION['avatar'] . '" alt="avatar" class="" id="navbarAvatar"/><span class="pl-3">' . $_SESSION['pseudo'] . '</span>
                        </a>
                        <div class="dropdown-menu bg-dark">
                            <a href="index.php?mod=profile" class="dropdown-item lien-navbar">Mon profil</a>
                            <a href="index.php?mod=timeline&option=myschedule#timeline-title" class="dropdown-item lien-navbar">Mon agenda</a>
                            <a href="index.php?mod=timeline&option=myposts#timeline-title" class="dropdown-item lien-navbar">Mes posts</a>';

                            $this->getListUnpublished($rights);
                            $this->getAdminButton($rights);
                            
        echo                '<div class="dropdown-divider lien-navbar"></div>
                            <a href="index.php?action=disconnection" class="dropdown-item lien-navbar">Se deconnecter</a>
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
                        <div class="dropdown-menu dropdown-custom bg-dark">
                            <form method="post" action="index.php?action=connection">
                                <input type="text" class="form-control mb-2" placeholder="Pseudonyme" name="pseudo"></input>
                                <input type="password" class="form-control mb-2" placeholder="Mot de passe" name="password"></input>
                                <button class="btn btn-custom btn-warning form-control" id="btn-connect" type="submit">Se connecter</button>
                            </form>
                        </div>
                    </li>
                </ul>';
    }

    public function getListUnpublished($rights) {
        if ($rights != null && $rights['droit_supprimer']) {
            echo '<a href="index.php?mod=timeline&option=editlist#timeline-title" class="dropdown-item lien-navbar">Liste des évènements non publiés</a>';
        }
    }

    public function getAdminButton($rights) {
        if ($rights != null && $rights['droit_admin']) {
            echo '<a href="index.php?mod=admin" class="dropdown-item lien-navbar">Administration</a>';
        }
    }

    public function getCategories($categories) {
		foreach ($categories as $key) {
			echo '<a class="nav-link lien-navbar" href="index.php?mod=timeline&option=' . $key['titreCategorie'] . '#timeline-title">' . $key['titreCategorie'] . '</a>';
		}
    }

}

?>
