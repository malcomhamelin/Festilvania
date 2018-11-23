<?php

class ContGeneric{

    private $model;
    private $view;

	public function __construct(){
        $this->model = new ModelGeneric();
        $this->view = new ViewGeneric();
	}

	public function getDisplay() {
		return $this->view->getDisplay();
	}
}

?>