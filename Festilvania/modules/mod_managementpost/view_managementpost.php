<?php

require_once "tampon/view_generic.php";

Class ViewManagementpost extends ViewGeneric {

    public function __construct() {
        parent::__construct();
    }

    public function getPublipage($categories, $rights) {
        if (isset($_SESSION['isConnected']) && isset($_SESSION['pseudo']) && isset($_SESSION['idMembre'])) {
            if ($rights != null && $rights['droit_poster']) {
                require_once "template_publipost.php";
            }
        }
        else {
            header('Location: index.php');
        }
    }

    public function getOptions($categories) {
        foreach ($categories as $key) {
            echo '<option value=' . $key['idCategorie'] . '>' . $key['titreCategorie'] . '</option>';
        }
    }

    public function getEditlistbyid($content, $categories, $rights) {
        if (isset($_SESSION['isConnected']) && isset($_SESSION['pseudo']) && isset($_SESSION['idMembre'])) {
            if ($rights != null && $rights['droit_poster']) {
                require_once "template_editpost.php";
            }
        }
        else {
            header('Location: index.php');
        }
    }
}

?>