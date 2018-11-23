<?php
    
include_once "cont_timeline.php";

Class ModTimeline {

    private $controller;

    public function __construct($action) {
        $this->controller = new ContTimeline;
        $this->controller->act($action);
    }
        
    public function getDisplay($option) {
        $this->controller->display($option);

        return $this->controller->getDisplay();
    }

}
    
?>