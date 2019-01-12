<?php

require_once "cont_post.php";

class ModPost {

	protected $controller;

	public function __construct($action){
		$this->controller = new ContPost();
		$this->controller->act($action);
	}

	public function getDisplay($option) {
        return $this->controller->getDisplay();
    }

}

?>