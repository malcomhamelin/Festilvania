<?php

session_start();

require_once "../../../connection.php";
Connection::initConnection();

$vote = htmlspecialchars($_POST['vote']);
$postID = htmlspecialchars($_POST['postID']);


if (isset($_SESSION['isConnected']) && isset($_SESSION['pseudo']) && isset($_SESSION['idMembre']) && $_SESSION['isConnected']) {
    switch ($vote) {
        case 'like' :
            Connection::upvote($postID);
            break;
        case 'dislike' :
            Connection::downvote($postID);
            break;
        default :
            header('Location: index.php');
            break;
    }

    echo Connection::getNbVotes($postID);
}
else {
    echo "not connected";
}

?>