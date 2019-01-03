<?php

require_once "tampon/view_generic.php";

Class ViewPublipost extends ViewGeneric {

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
			echo 	'<div class="container annonce shadow-sm text-center mt-5">
                        <span class="col-12 col-lg-12 font-weight-bold">Vous devez être connecté pour pouvoir poster</span>
                    </div>';
		}
	}

	public function getOptions($categories) {
		foreach ($categories as $key) {
			echo '<option value=' . $key['idCategorie'] . '>' . $key['titreCategorie'] . '</option>';
		}
	}

}

?>
