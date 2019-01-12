<?php

require_once "../../../connection.php";
Connection::initConnection();

$term = $_GET['term'];

$requete = Connection::$bdd->prepare("SELECT * FROM evenement WHERE titreEvenement LIKE :term");
$requete->execute(array(':term' => '%'.$term.'%'));
$array = array();

while ($donnee = $requete->fetch()) {
    array_push($array, array('id' => $donnee["idEvenement"], 'value' => $donnee["titreEvenement"])); // label utilisable
}

echo json_encode($array);

?>