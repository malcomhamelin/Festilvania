<?php

class ModGeneric {

	protected $controller;

	public function __construct(){
		$this->controller = new ContGeneric();
	}

	public function getDisplay(){
		return $this->controller->getDisplay();
	}

}

?>