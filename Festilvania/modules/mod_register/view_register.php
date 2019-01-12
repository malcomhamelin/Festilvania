<?php

require_once "generic/view_generic.php";

Class ViewRegister extends ViewGeneric {

    public function __construct() {
        parent::__construct();
    }

    public function displayregister(){
        if (!isset($_SESSION['isConnected']) || !$_SESSION['isConnected']) {
            require_once "template_register.php";
        }
        else {
            header('Location: index.php');
        }
    }




}

?>