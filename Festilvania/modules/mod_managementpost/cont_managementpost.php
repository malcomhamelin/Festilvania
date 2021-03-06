<?php

require_once "model_managementpost.php";
require_once "view_managementpost.php";
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
                $this->view->getPage($this->model->eventInfo(), $this->model->getCategories(), $this->model->getRights());
                break;
        }
    }
    
    public function getDisplay() {
        return $this->view->getDisplay();
    }
}

?>