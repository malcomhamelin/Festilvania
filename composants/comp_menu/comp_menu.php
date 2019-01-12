<?php

include "cont_menu.php";

class CompMenu {

    private $controller;

    public function __construct() {
        $this->controller = new ContMenu();
        $this->controller->getMenu();
    }

}

?>