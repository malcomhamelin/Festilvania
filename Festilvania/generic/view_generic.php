<?php

require_once "composants/comp_menu/comp_menu.php";

class ViewGeneric{

	private $menu;

	public function __construct(){
		ob_start();

		$this->menu = new CompMenu();
	}

	public function getDisplay() {
		return ob_get_clean();
    }
    
}

?>