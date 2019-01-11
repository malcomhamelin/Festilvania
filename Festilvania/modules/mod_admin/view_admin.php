<?php

require_once "tampon/view_generic.php";

Class ViewAdmin extends ViewGeneric {

    public function __construct() {
        parent::__construct();
    }

    public function displayAdmin($categories, $groups, $rights) {
        if (isset($_SESSION['isConnected']) && isset($_SESSION['pseudo']) && isset($_SESSION['idMembre']) && $rights != null && $rights['droit_admin']) {
            require_once "template_admin.php";
        }
        else {
            header('Location: index.php');
        }
    }

    public function getOptionsCat($categories) {
		foreach ($categories as $key) {
			echo '<option value=' . $key['idCategorie'] . '>' . $key['titreCategorie'] . '</option>';
		}
    }
    
    public function getOptionsGroups($groups) {
		foreach ($groups as $key) {
			echo '<option value=' . $key['idGroupe'] . '>' . $key['nomGroupe'] . '</option>';
		}
    }
    
    public function popUpCheck() {
        $action = isset($_GET['action']) ? htmlspecialchars($_GET['action']) : "";
        
        if (!empty($action)) {
            $errorCode = isset($_SESSION[$action]) && !empty($_SESSION[$action]) ? $_SESSION[$action] : 0;

            echo '<script type="text/javascript"> check' . $action . '(' . $errorCode . '); </script>';
        }
    }

}

?>