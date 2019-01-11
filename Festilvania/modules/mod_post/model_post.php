<?php

require_once "tampon/model_generic.php";

class ModelPost extends ModelGeneric {

	public function __construct(){

    }
    
    public function getComments() {
        $tuplesComment = self::$bdd->prepare("SELECT * FROM commentaire INNER JOIN membre using (idMembre) WHERE commentaire.idEvenement = ? ORDER BY commentaire.date_creation");
        $tuplesComment->execute(array($_SESSION['idEvenement']));
        $result = $tuplesComment->fetchAll();

        return $result;
    }

    public function event() {
        $tupleEvent = self::$bdd->prepare("SELECT evenement.idEvenement, titreEvenement, evenement.description, evenement.date_creation, date_debut, date_fin, evenement.idMembre, idCategorie, lieu, sum(voteevenement.vote) as nbVotes, image.lienImage 
                                           FROM image INNER JOIN evenement using (idEvenement) LEFT JOIN voteevenement using (idEvenement) GROUP BY evenement.idEvenement HAVING evenement.idEvenement = ? ORDER BY date_creation DESC");
        $tupleEvent->execute(array($_SESSION['idEvenement']));
        $result = $tupleEvent->fetch();

        return $result;
    }

    public function getUserInfos() {
        if (isset($_SESSION['isConnected']) && isset($_SESSION['pseudo']) && isset($_SESSION['idMembre'])) {
            $schedule = self::$bdd->prepare("SELECT * FROM aller WHERE idMembre = ?");
            $schedule->execute(array($_SESSION['idMembre']));
            $userInfos = $schedule->fetchAll();

            return $userInfos;
        }
    }

    public function comment() {
        if ($_SESSION['isConnected']) {
            $contenu = htmlspecialchars($_POST['comment']);

            $reqComment = self::$bdd->prepare("INSERT INTO commentaire(contenu, date_creation, idMembre, idEvenement) VALUES (?, ?, ?, ?)");
            $reqComment->execute(array($contenu, date("Y-m-d H:i:s"), $_SESSION['idMembre'], $_SESSION['idEvenement']));
        }
    }

}

?>
