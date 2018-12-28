<?php
    
include_once "cont_profilModif.php";

Class ModProfilModif {

    private $controller;
    

    public function __construct($action) {
        $this->controller = new ContProfilModif;
      
    }
        
    public function getDisplay($option) {
        $this->controller->display($option);

        return $this->controller->getDisplay();
    }

}
    
?>