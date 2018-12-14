<?php
    
include_once "cont_register.php";

Class ModRegister {

    private $controller;
    private $action;

    public function __construct($action) {
        $this->controller = new ContRegister;
        $this->controller->act($action);
    }
    public function getDisplay($option){
        return $this->controller->getDisplay();
    }
        
    

}
    
?>