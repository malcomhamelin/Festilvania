<?php

include_once "model_profile.php";
include_once "view_profile.php";

Class ContProfile {

    private $model;
    private $view;

    public function __construct() {
        $this->model = new ModelProfile;
        $this->view = new ViewProfile;
    }

    public function act($action) {
      //  $this->view->displayprofil();
        switch ($action) {
            case 'update':
                $this->model->$action();
                break;
            default :
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