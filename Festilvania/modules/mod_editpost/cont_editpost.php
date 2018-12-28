<?php

include_once "model_editpost.php";
include_once "view_editpost.php";

Class ContEditpost {

    private $model;
    private $view;

    public function __construct() {
        $this->model = new ModelEditpost;
        $this->view = new ViewEditpost;
    }
     public function act($action) {
        switch ($action) {
            case 'edition' :
                $this->model->$action();
                break;
            case 'delete' :
                $this->model->$action();
                break;
            default :
                break;
        }
    }

    public function display($option) {
        switch ($option) {
            case 'editlist' :
                $this->view->getEditlist($this->model->$option());
                break;
            case 'editlistbyid' :
                $this->view->getEditlistbyid($this->model->$option(), $this->model->getRights());
                break;
            default :
                break;
        }
    }
    
    public function getDisplay() {
        return $this->view->getDisplay();
    }
    
}

?>