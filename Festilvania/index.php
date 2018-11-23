<?php session_start();

include_once "connection.php";
Connection::initConnection();

include_once "composants/comp_menu/comp_menu.php";
$menu = new CompMenu();

$_SESSION['mod'] = "timeline";
$_SESSION['option'] = "homepage";
$action = null;	

if (isset($_GET['action'])) {
	$action = $_GET['action'];
}

if (isset($_GET['mod'])) {
	$_SESSION['mod'] = htmlspecialchars($_GET['mod']);
}

if (isset($_GET['option'])) {
	$_SESSION['option'] = htmlspecialchars($_GET['option']);
}

switch($_SESSION['mod']) {
	case 'timeline':
	case 'profile' :
		require_once "modules/mod_" . $_SESSION['mod'] . "/mod_" . $_SESSION['mod'] . ".php";
		$modName = "Mod". ucfirst($_SESSION['mod']);
		$modObject = new $modName($action);
		$contenu = $modObject->getDisplay($_SESSION['option']);
		break;
	default:
		die("Mauvais modules");
		break;
}

include_once "template.php";

?>