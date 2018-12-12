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
        $this->view->displayregister();
        switch ($action) {
            case 'register':
                $this->model->$action();
             break;
            
            default:
            break;
        }
    }


}

?>