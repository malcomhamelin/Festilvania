<?php

require_once "model_register.php";
require_once "view_register.php";
require_once "generic/cont_generic.php";

Class ContRegister extends ContGeneric {

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
            default:
                $this->createToken();
                $this->view->displayregister();
                break;
        }
    }

    public function getDisplay() {
        return $this->view->getDisplay();
    }


}

?>