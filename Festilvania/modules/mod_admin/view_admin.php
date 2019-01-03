<?php

require_once "tampon/view_generic.php";

Class ViewAdmin extends ViewGeneric {

    public function __construct() {
        parent::__construct();
    }

    public function displayAdmin($categories, $groups) {
        require_once "template_admin.php";
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

}

?>