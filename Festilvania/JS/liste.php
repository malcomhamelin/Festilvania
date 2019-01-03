<?php

$term = $_GET['term'];

$requete = Connection::$bdd->prepare("SELECT titreEvenement FROM evenement WHERE titreEvenement LIKE :term");
$requete->execute(array(':term' => '%'.$term.'%'));
$array = array();

while ($donnee = $requete->fetch()) {
    array_push($array, $donnee['titreEvenement']);
}

echo json_encode($array);

?>