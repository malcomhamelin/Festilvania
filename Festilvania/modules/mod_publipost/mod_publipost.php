<?php
    
include_once "cont_publipost.php";

Class ModPublipost {

    private $controller;

    public function __construct($action) {
        $this->controller = new ContPublipost;
        $this->controller->act($action);
    }
        
    public function getDisplay($option) {
        $this->controller->display($option);

        return $this->controller->getDisplay();
    }

}
    
?>