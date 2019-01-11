<?php

require_once "model_post.php";
require_once "view_post.php";
require_once "tampon/cont_generic.php";

class ContPost extends ContGeneric {

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
                if ($this->checkToken()) {
                    $this->model->$action();
                }
            default :
                if ($this->checkToken()) {
                    $this->view->getPost($this->model->getComments(), $this->model->event(), $this->model->getRights(), $this->model->getUserInfos());
                }
                break;
        }
    }

    public function getDisplay() {
        return $this->view->getDisplay();
    }
    
}

?>