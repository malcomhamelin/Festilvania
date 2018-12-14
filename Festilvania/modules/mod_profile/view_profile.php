<?php

require_once "tampon/view_generic.php";

Class ViewProfile extends ViewGeneric {

    public function __construct() {
        parent::__construct();
    }

    public function getProfile() {
        require_once "template_profile.php";
    }

}

?>