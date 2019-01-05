<?php

class ModelPost extends Connection {

	public function __construct(){

    }
    
    public function comment() {
        $tuplesComment = self::$bdd->prepare("SELECT * FROM commentaire INNER JOIN membre using (idMembre) WHERE commentaire.idEvenement = ? ORDER BY commentaire.date_creation");
        $tuplesComment->execute(array($_SESSION['idEvenement']));
        $result = $tuplesComment->fetchAll();

        return $result;
    }

    public function event() {
        $tupleEvent = self::$bdd->prepare("SELECT * FROM evenement INNER JOIN image using (idEvenement) WHERE idEvenement = ?");
        $tupleEvent->execute(array($_SESSION['idEvenement']));
        $result = $tupleEvent->fetch();

        return $result;
    }

    public function addComment() {
        if ($_SESSION['isConnected']) {
            $contenu = htmlspecialchars($_POST['comment']);

            $reqComment = self::$bdd->prepare("INSERT INTO commentaire(contenu, date_creation, idMembre, idEvenement) VALUES (?, ?, ?, ?)");
            $reqComment->execute(array($contenu, date("Y-m-d H:i:s"), $_SESSION['idMembre'], $_SESSION['idEvenement']));
        }
    }

}

?>
