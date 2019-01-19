<?php

session_start();

require_once "../../../connection.php";
Connection::initConnection();

$userID = htmlspecialchars($_POST['userID']);
$postID = htmlspecialchars($_POST['postID']);
$dataSchedule = htmlspecialchars($_POST['dataSchedule']);

if (isset($_SESSION['isConnected']) && isset($_SESSION['pseudo']) && isset($_SESSION['idMembre']) && $_SESSION['isConnected']) {
    switch ($dataSchedule) {
        case 'add' :
            Connection::addSchedule($postID);
            echo "fa-minus";
            break;
        case 'del' :
            Connection::delSchedule($postID);
            echo "fa-plus";
            break;
        default :
            break;
    }
}
else {
    echo "fa-plus";
}

?>