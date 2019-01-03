<?php
    
include_once "cont_managementpost.php";

Class ModManagementpost {

    private $controller;

    public function __construct($action) {
        $this->controller = new ContManagementpost;
        $this->controller->act($action);
    }
        
    public function getDisplay($option) {
        $this->controller->display($option);
        return $this->controller->getDisplay();
    }

}
    
?>