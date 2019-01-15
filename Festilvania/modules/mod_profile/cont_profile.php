<?php

require_once "model_profile.php";
require_once "view_profile.php";
require_once "generic/cont_generic.php";

Class ContProfile extends ContGeneric {

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
                if ($this->checkToken()) {
                    $this->model->$action();
                }
                break;
            default :
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