<?php

require_once "model_timeline.php";
require_once "view_timeline.php";
require_once "generic/cont_generic.php";


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
                $this->model->$action();
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
                $rights = $this->model->getRights();
                if (isset($_SESSION['isConnected']) && isset($_SESSION['pseudo']) && isset($_SESSION['idMembre']) && $_SESSION['isConnected'] && !empty($rights) && $rights['droit_editer']) {
                    $this->createToken();
                    $this->view->getTimeline($this->model->$option(), $this->model->getUserInfos(), $this->model->hottestContent(), $this->model->latestContent());
                }
                else {
                    header('Location: index.php');
                }
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