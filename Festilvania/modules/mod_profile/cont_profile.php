<?php

include_once "model_profile.php";
include_once "view_profile.php";
require_once "tampon/cont_generic.php";


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
            case 'uploadAvatar' :
                if ($this->checkToken()) {
                    $this->model->$action();
                }
            break;

            case 'update':
                if ($this->checkToken()) {
                    $this->model->$action();
                }
            break;

            default :
                if ($this->checkToken()) {
                    $this->view->getProfile();
                }
            break;
        }
    }
    public function display($option) {
        switch ($option) {
            default :
                $this->createToken();
                $this->view->displayprofil($this->model->basedate());
            
                break;
        }
    }
    public function getDisplay() {
        return $this->view->getDisplay();
    }

}

?>