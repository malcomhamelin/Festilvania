<?php

include_once "model_Profile.php";
include_once "view_profile.php";

Class ContProfile {

    private $model;
    private $view;

    public function __construct() {
        $this->model = new ModelProfile;
        $this->view = new ViewProfile;
    }

    public function act($action) {
        switch ($action) {
            case 'uploadAvatar' :
                $this->model->$action();
            default :
                $this->view->getProfile();
                break;
        }
    }

    public function getDisplay() {
        return $this->view->getDisplay();
    }

}

?>