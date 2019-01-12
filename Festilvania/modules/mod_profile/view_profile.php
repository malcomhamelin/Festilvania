 <?php

require_once "tampon/view_generic.php";

Class ViewProfile extends ViewGeneric {

    public function __construct() {
        parent::__construct();
    }

    public function displayprofil($content){
        if (isset($_SESSION['isConnected']) && isset($_SESSION['pseudo']) && isset($_SESSION['idMembre']) && $_SESSION['isConnected']) {
            require_once "template_profile.php";
        }
        else {
            header('Location: index.php');
        }	
    }

}

?>
