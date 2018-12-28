<?php

include_once "model_publipost.php";
include_once "view_publipost.php";

Class ContPublipost {

    private $model;
    private $view;

    public function __construct() {
        $this->model = new ModelPublipost;
        $this->view = new ViewPublipost;
    }
     public function act($action) {
        switch ($action) {
            case 'publication' :
                $this->model->$action();
                break;
            default :
                break;
        }
    }

    public function display($option) {
        switch ($option) {
            default :
                $this->view->getPublipage($this->model->getCategories(), $this->model->getRights());
                break;
        }
    }

    public function getDisplay() {
        return $this->view->getDisplay();
    }
    
}

?>
