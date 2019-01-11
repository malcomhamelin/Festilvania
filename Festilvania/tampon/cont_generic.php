<?php

class ContGeneric {

	private $MAX_SESSION_TIME = '+15 minutes';

    private $model;
    private $view;

	public function __construct(){
        $this->model = new ModelGeneric();
		$this->view = new ViewGeneric();
	}

	public function getDisplay() {
		return $this->view->getDisplay();
	}

	public function createToken() {
		$token = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));

		$_SESSION['token'] = $token;
		$_SESSION['tokenCreatedTime'] = new DateTime();
	}

	public function checkToken() {
		$expectedMaxTime = $_SESSION['tokenCreatedTime'];
		$expectedMaxTime->modify($this->MAX_SESSION_TIME);

		$currentTime = new DateTime();

		if (isset($_SESSION['token']) && isset($_POST['token']) && !empty($_SESSION['token']) && !empty($_POST['token']) && 
			$_SESSION['token'] == $_POST['token'] && $currentTime < $expectedMaxTime) {
				$_SESSION['token'] = null;
				$_SESSION['tokenCreatedTime'] = null;
				return true;
		}

		$_SESSION['token'] = null;
		$_SESSION['tokenCreatedTime'] = null;
		echo '<script type="text/javascript"> errorToken(); </script>';
		return false;
	}
}

?>