<?php

require_once "generic/view_generic.php";

Class ViewManagementpost extends ViewGeneric {

    public function __construct() {
        parent::__construct();
    }

    public function getPage($content, $categories, $rights) {
        if (isset($_SESSION['isConnected']) && isset($_SESSION['pseudo']) && isset($_SESSION['idMembre']) && $_SESSION['isConnected']
            && $rights != null && $rights['droit_poster']) {
            require_once "template_managementpost.php";
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

    public function getButtonPublish($rights) {
        if ($_GET['option'] == 'editlistbyid') {
            if ($rights != null && $rights['droit_supprimer']) {
                echo '
                    <div class="form-group row">
                        <label for="locationInput" class="col-4 col-form-label">Visible</label>
                        <div class="col-8">
                            <input class="form-control" type="checkbox" name="publish" id="publishInput" form="editEvent" value="1" checked     >
                        </div>
                    </div>';
            }
        }
    }

    public function getButtonDelete($rights) {
        if ($_GET['option'] == 'editlistbyid') {

            $_GET['idEvenement'] = htmlspecialchars($_GET['idEvenement']);

            if ($rights != null && $rights['droit_supprimer']) {
                echo '
                    <form method="post" action="index.php?mod=managementpost&action=delete&idEvenement=' . $_GET['idEvenement'] . '" onsubmit="return window.confirm(\'Etes vous sur de vouloir supprimer ce post ?\');" enctype="multipart/form-data" id="delEvent"></form>
                    <input type="hidden" value="' . $_SESSION['token'] . '" form="delEvent" name="token">
                    <input type="hidden" name="idDel" form="delEvent" value="' . $_GET['idEvenement'] . '">
                    <button type="submit" form="delEvent" class="btn btn-danger btn-custom btn-profile col-6 mt-3 mx-auto" id="delButton">Supprimer</button>';
            }
        }
    }
}

?>