<?php

include_once "model_managementpost.php";
include_once "view_managementpost.php";
require_once "generic/cont_generic.php";

Class ContManagementpost extends ContGeneric {

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
            case 'publish' :
            case 'editlistbyid' :
                $this->createToken();
                $this->view->getPage($this->model->editlistbyid(), $this->model->getCategories(), $this->model->getRights());
                break;
            case 'editlist' :
                $this->createToken();
                $this->view->getEditlist($this->model->$option());
                break;
        }
    }
    
    public function getDisplay() {
        return $this->view->getDisplay();
    }
}

?>