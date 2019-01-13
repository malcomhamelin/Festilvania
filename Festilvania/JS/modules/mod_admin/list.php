<?php

require_once "../../../connection.php";
Connection::initConnection();

$term = $_GET['term'];

$requete = Connection::$bdd->prepare("SELECT pseudo FROM membre WHERE pseudo LIKE :term");
$requete->execute(array(':term' => '%'.$term.'%'));
$array = array();

while ($donnee = $requete->fetch()) {
    array_push($array, array('value' => $donnee["pseudo"])); // label utilisable
}

echo json_encode($array);

?>