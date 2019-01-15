<?php

require_once "model_admin.php";
require_once "view_admin.php";
require_once "generic/cont_generic.php";

Class ContAdmin extends ContGeneric {

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
                if ($this->checkToken()) {
                    $this->model->$action($this->model->getRights());
                }
                break;
            default:
                break;
        }
    }

    public function display($option) {
        switch ($option) {
            default :
                $this->createToken();
                $this->view->displayAdmin($this->model->getCategories(), $this->model->getGroups(), $this->model->getRights());
                break;
        }
    }

    public function getDisplay() {
        return $this->view->getDisplay();
    }


}

?>