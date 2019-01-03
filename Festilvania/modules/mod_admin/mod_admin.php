<?php
    
include_once "cont_admin.php";

Class ModAdmin {

    private $controller;
    private $action;

    public function __construct($action) {
        $this->controller = new ContAdmin;
        $this->controller->act($action);
    }
    public function getDisplay($option){
        return $this->controller->getDisplay();
    }

}
    
?>