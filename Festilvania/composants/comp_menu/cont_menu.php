<?php

include_once "model_menu.php";
include_once "view_menu.php";

class ContMenu {

    private $model;
    private $view;

    public function __construct() {
        $this->model = new ModelMenu();
        $this->view = new ViewMenu();
    }

    public function getMenu() {
        $this->view->getNavbar($this->model->getRights());
    }

}

?>
