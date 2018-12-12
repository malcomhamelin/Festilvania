<?php
    
include_once "cont_register.php";

Class ModRegister {

    private $controller;
    private $action;

    public function __construct($action) {
        $this->controller = new ContRegister;
        
    }
    public function getDisplay($option){
    	 $this->controller->act($option);
    }
        
    

}
    
?>