<?php

require_once "model_post.php";
require_once "view_post.php";

class ContPost{

    private $model;
    private $view;

	public function __construct(){
        $this->model = new ModelPost();
        $this->view = new ViewPost();
    }

    public function act($action) {
        switch ($action) {
            case 'comment' :
            case 'upvote' :
            case 'downvote' :
            case 'addschedule' :
            case 'delschedule' :
                $this->model->$action();
            default :
                $this->view->getPost($this->model->getComments(), $this->model->event(), $this->model->getRights(), $this->model->getUserSchedule());
                break;
        }
    }

    public function getDisplay() {
        return $this->view->getDisplay();
    }
    
}

?>