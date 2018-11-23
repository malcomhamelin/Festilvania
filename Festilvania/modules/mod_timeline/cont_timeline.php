<?php

include_once "model_timeline.php";
include_once "view_timeline.php";

Class ContTimeline {

    private $model;
    private $view;

    public function __construct() {
        $this->model = new ModelTimeline;
        $this->view = new ViewTimeline;
    }

    public function act($action) {
        switch ($action) {
            case 'connection' :
            case 'disconnection' :
                $this->model->$action();
                break;
            default :
                break;
        }
    }

    public function display($option) {
        switch ($option) {
            case 'homepage' :
                $this->view->getHomepage($this->model->$option());
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