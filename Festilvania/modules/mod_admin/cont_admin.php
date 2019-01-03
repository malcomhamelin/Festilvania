<?php

include_once "model_admin.php";
include_once "view_admin.php";

Class ContAdmin {

    private $model;
    private $view;

    public function __construct() {
        $this->model = new ModelAdmin;
        $this->view = new ViewAdmin;
    }

    public function act($action) {
        switch ($action) {
            case 'addCategory' :
            case 'delCategory' :
            case 'addGroup' :
            case 'affectUser' :
            case 'delGroup' :
                $this->model->$action();
            default:
                $this->view->displayAdmin($this->model->getCategories(), $this->model->getGroups());
                break;
        }
    }

    public function getDisplay() {
        return $this->view->getDisplay();
    }


}

?>