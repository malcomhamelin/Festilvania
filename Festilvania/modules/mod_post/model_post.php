<?php

class ModelPost extends Connection {

	public function __construct(){

    }
    
    public function comment() {
        $tuplesComment = self::$bdd->query("SELECT * FROM commentaire INNER JOIN membre using (idMembre) ORDER BY commentaire.date_creation");
        $result = $tuplesComment->fetchAll();

        return $result;
    }

    public function event($idEvent) {
        $tupleEvent = self::$bdd->prepare("SELECT * FROM evenement WHERE idEvenement = ?");
        $tupleEvent->execute(array($idEvent));
        $result = $tupleEvent->fetch();

        return $result;
    }

}

?>