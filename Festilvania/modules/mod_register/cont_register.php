<?php

include_once "model_register.php";
include_once "view_register.php";

Class ContRegister {

    private $model;
    private $view;

    public function __construct() {
        $this->model = new ModelRegister;
        $this->view = new ViewRegister;
    }

    public function act($action) {
        switch ($action) {
            case 'register':
                $this->model->$action();
            default:
                $this->view->displayregister();
                break;
        }
    }

    public function getDisplay() {
        return $this->view->getDisplay();
    }


}

?>