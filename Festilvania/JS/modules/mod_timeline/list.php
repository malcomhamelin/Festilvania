<?php

require_once "../../../connection.php";
Connection::initConnection();

$term = $_GET['term'];

$requete = Connection::$bdd->prepare("SELECT estPublie, titreEvenement, lienImage, DATE_FORMAT(date_debut, '%d/%m/%Y') as dateDebut FROM evenement INNER JOIN image using(idEvenement) WHERE titreEvenement LIKE :term AND estPublie = 1");
$requete->execute(array(':term' => '%'.$term.'%'));
$array = array();

while ($donnee = $requete->fetch()) {
    array_push($array, array('id' => $donnee["dateDebut"], 'value' => $donnee["titreEvenement"], 'label' => $donnee["lienImage"])); // label utilisable
}

echo json_encode($array);

?>