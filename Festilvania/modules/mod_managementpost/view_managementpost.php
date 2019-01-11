<?php

require_once "tampon/view_generic.php";

Class ViewManagementpost extends ViewGeneric {

    public function __construct() {
        parent::__construct();
    }

    public function getPage($content, $categories, $rights) {
        if (isset($_SESSION['isConnected']) && isset($_SESSION['pseudo']) && isset($_SESSION['idMembre'])) {
            if ($rights != null && $rights['droit_poster']) {
                require_once "template_managementpost.php";
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

    public function getAction() {
        if ($_GET['option'] == 'publish') {
            echo 'publication';
        }
        else {
            echo 'edition';
        }
    }
    public function getDefaultValue($content, $name) {
        if ($_GET['option'] == 'editlistbyid') {
                echo $content['' . $name . ''];
        }
    }

    public function getButtonAdmin($rights) {
        if ($_GET['option'] == 'editlistbyid') {
            if ($rights != null && $rights['droit_supprimer']) {
                $this->getButtonPublish();
                $this->getButtonDelete();
            }
        }
    }

    public function getButtonPublish() {
        echo '
            <div class="form-group row">
                <label for="locationInput" class="col-4 col-form-label">Le publier ?</label>
                <div class="col-8">
                    <input class="form-control" type="checkbox" name="publish" id="publishInput" form="editEvent" value="1">
                </div>
            </div>';
    }

    public function getButtonDelete() {
        echo '
            <form method="post" action="index.php?mod=managementpost&action=popUpDelete" enctype="multipart/form-data" id="delEvent">
                <input type="hidden" name="idDel" form="delEvent" value="' . $_GET['idEvenement'] . '">
                <button type="submit" class="btn btn-outline-danger float-left mt-3">Supprimer</button>
            </form>';
    }
}

?>