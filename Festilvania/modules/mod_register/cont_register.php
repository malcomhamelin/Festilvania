<?php

include_once "model_register.php";
include_once "view_register.php";
require_once "tampon/cont_generic.php";

Class ContRegister extends ContGeneric{

    private $model;
    private $view;

    public function __construct() {
        $this->model = new ModelRegister;
        $this->view = new ViewRegister;
    }

    public function act($action) {
        switch ($action) {
            case 'register':
                if ($this->checkToken()) {
                    $this->model->$action();
                }
            break;
            default:
                if ($this->checkToken()) {
                    $this->view->displayregister();
                }
            break;
        }
    }

    public function getDisplay() {
        return $this->view->getDisplay();
    }


}

?>