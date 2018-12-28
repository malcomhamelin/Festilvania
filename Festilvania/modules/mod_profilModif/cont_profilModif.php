<?php

include_once "model_profilModif.php";
include_once "view_profilModif.php";

Class ContProfilModif {

    private $model;
    private $view;

    public function __construct() {
        $this->model = new ModelProfilModif;
        $this->view = new ViewProfilModif;
    }

    public function act($action) {
        $this->view->displayprofil();
        switch ($action) {
            case 'register':
                $this->model->$action();
             break;
            
            default:
            break;
        }
    }
    public function display($option) {
        switch ($option) {
            default :
                $this->view->displayprofil($this->model->basedate());
                break;
        }
    }
    public function getDisplay() {
        return $this->view->getDisplay();
    }

}

?>