<?php

include_once "model_managementpost.php";
include_once "view_managementpost.php";

Class ContManagementpost {

    private $model;
    private $view;

    public function __construct() {
        $this->model = new ModelManagementpost;
        $this->view = new ViewManagementpost;
    }

    public function act($action) {
        switch ($action) {
            case 'publication' :
            case 'edition' :
            case 'popUpDelete' :
            case 'delete' :
                $this->model->$action();
                break;
            default :
                break;
        }
    }

    public function display($option) {
        switch ($option) {
            case 'publish' :
            case 'editlistbyid' :
                $this->view->getPage($this->model->editlistbyid(), $this->model->getCategories(), $this->model->getRights());
                break;
            case 'editlist' :
                $this->view->getEditlist($this->model->$option());
                break;
        }
    }
    
    public function getDisplay() {
        return $this->view->getDisplay();
    }
}

?>