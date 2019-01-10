<?php
    
include_once "cont_profile.php";

Class ModProfile {

    private $controller;

    public function __construct($action) {
        $this->controller = new ContProfile;
        $this->controller->act($action);
    }
        
    public function getDisplay($option) {
    	$this->controller->display($option);
        return $this->controller->getDisplay();
    }

}
    
?>