<?php

class ModelPost extends Connection {

	public function __construct(){

    }
    
    public function comment() {
        $tuplesComment = self::$bdd->query("SELECT * FROM commentaire INNER JOIN membre using (idMembre) ORDER BY commentaire.date_creation");
        $result = $tuplesComment->fetchAll();

        return $result;
    }

    public function event() {
        $tupleEvent = self::$bdd->prepare("SELECT * FROM evenement WHERE idEvenement = ?");
        $tupleEvent->execute(array($_SESSION['idEvent']));
        $result = $tupleEvent->fetch();

        return $result;
    }

    public function addComment() {
        if ($_SESSION['isConnected']) {
            $contenu = htmlspecialchars($_POST['comment']);

            $reqComment = self::$bdd->prepare("INSERT INTO commentaire(contenu, date_creation, idMembre, idEvenement) VALUES (?, ?, ?, ?)");
            $reqComment->execute(array($contenu, date("Y-m-d H:i:s"), $_SESSION['idMembre'], $_SESSION['idEvent']));
        }
    }

}

?>