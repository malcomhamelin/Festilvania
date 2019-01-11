<?php

include_once "model_timeline.php";
include_once "view_timeline.php";
require_once "tampon/cont_generic.php";


Class ContTimeline extends ContGeneric{

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
            case 'addschedule' :
            case 'delschedule' :
            case 'upvote' :
            case 'downvote' :
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
            case 'homepage' :
            case 'myschedule' :
            case 'search' :
                $this->createToken();
                $this->view->getTimeline($this->model->$option(), $this->model->getUserInfos(), $this->model->hottestContent(), $this->model->latestContent());
                break;
            case 'editlist' :
                $this->createToken();
                $this->view->getEditlist($this->model->$option());
                break;
            default :
                $this->createToken();
                $this->view->getTimeline($this->model->categories($option), $this->model->getUserInfos(), $this->model->hottestContent(), $this->model->latestContent());
                break;
        }
    }

    public function getDisplay() {
        return $this->view->getDisplay();
    }

}

?>