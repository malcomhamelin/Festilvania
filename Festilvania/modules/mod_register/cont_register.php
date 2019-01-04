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
                break;
            case 'update':
                $this->model->$action();
                break;
            default:
                $this->view->displayregister();
                break;
        }
    }
     public function display($option) {
        switch ($option) {
            case 'update':
                $this->view->displayprofil($this->model->basedate());
                break;
            case 'register':
                $this->view->displayregister();
                break;
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