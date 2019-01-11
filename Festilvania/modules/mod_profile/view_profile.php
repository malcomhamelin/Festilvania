 <?php

require_once "tampon/view_generic.php";

Class ViewProfile extends ViewGeneric {

    public function __construct() {
        parent::__construct();
    }

    public function getProfile() {
       // require_once "template_profile.php";
    }
     public function displayprofil($content){
      
        $homme="";
        $femme="";
        $autre="";

        if($content['sexe']=="homme"){
            $homme='checked="checked"';
        }
        if($content['sexe']=="femme"){
            $femme='checked="checked"';
        }
        if($content['sexe']=="autre"){
            $autre='checked="checked"';
        }
        require_once "template_Modif.php";
			
    }

}

?>
