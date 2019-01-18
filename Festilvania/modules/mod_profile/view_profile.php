 <?php

require_once "generic/view_generic.php";

Class ViewProfile extends ViewGeneric {

    public function __construct() {
        parent::__construct();
    }

    public function displayprofil($content){
        if (isset($_SESSION['isConnected']) && isset($_SESSION['pseudo']) && isset($_SESSION['idMembre']) && $_SESSION['isConnected']) {
            $currDate = new DateTime();
            $currDate->modify("-13 years");

            require_once "template_profile.php";
        }
        else {
            header('Location: index.php');
        }	
    }

}

?>
