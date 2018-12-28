<?php
    
include_once "cont_editpost.php";

Class ModEditpost {

    private $controller;

    public function __construct($action) {
        $this->controller = new ContEditpost;
        $this->controller->act($action);
    }
        
    public function getDisplay($option) {
        $this->controller->display($option);
        return $this->controller->getDisplay();
    }

}
    
?>