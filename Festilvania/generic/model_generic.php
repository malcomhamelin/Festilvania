<?php

require_once "connection.php";

class ModelGeneric extends Connection {

	public function __construct(){

    }

    public function getRights() {
        if (isset($_SESSION['isConnected']) && $_SESSION['isConnected'] == true) {
            $rights = self::$bdd->prepare("SELECT * FROM membre INNER JOIN groupe ON membre.idGroupe = groupe.idGroupe INNER JOIN droits ON groupe.idDroits = droits.idDroits 
                                           WHERE membre.idMembre = ?");
            $rights->execute(array($_SESSION['idMembre']));
            $result = $rights->fetch();

            return $result;
        }
    }

    public function getCategories() {
        $reqCat = self::$bdd->query("SELECT * FROM categorie");
        $tuples = $reqCat->fetchAll();
        
        return $tuples;
    }

    public function getGroups() {
        $reqGrp = self::$bdd->query("SELECT * FROM groupe");
        $tuples = $reqGrp->fetchAll();
        
        return $tuples;
    }

    public function upvote() {
        $this->vote(1);
    }

    public function downvote() {
        $this->vote(-1);
    }

    public function vote($voteValue) {
        if (isset($_SESSION['isConnected']) && isset($_SESSION['pseudo']) && isset($_SESSION['idMembre'])) {
            $checkVote = self::$bdd->prepare("SELECT * FROM voteevenement WHERE idMembre = ? and idEvenement = ?");
            $checkVote->execute(array($_SESSION['idMembre'], $_SESSION['idEvenement']));

            $resVote = $checkVote->fetch();
            
            if ($resVote['vote'] == $voteValue) {
                $delCurrentVote = self::$bdd->prepare("DELETE FROM voteevenement WHERE idMembre = ? and idEvenement = ? and vote = ?");
                $delCurrentVote->execute(array($_SESSION['idMembre'], $_SESSION['idEvenement'], $voteValue));
            }
            else {

                if ($resVote['vote'] == -$voteValue) {
                    $delOppositeVote = self::$bdd->prepare("DELETE FROM voteevenement WHERE idMembre = ? and idEvenement = ? and vote = ?");
                    $delOppositeVote->execute(array($_SESSION['idMembre'], $_SESSION['idEvenement'], -$voteValue));
                }
                
                $vote = self::$bdd->prepare("INSERT INTO voteevenement VALUES (?, ?, ?, NOW())");
                $vote->execute(array($_SESSION['idMembre'], $_SESSION['idEvenement'], $voteValue));
            }

        }
    }

    public function addschedule() {
        if (isset($_SESSION['isConnected']) && isset($_SESSION['pseudo']) && isset($_SESSION['idMembre'])) {
            $checkSchedule = self::$bdd->prepare("SELECT * FROM aller WHERE idMembre = ? and idEvenement = ?");
            $checkSchedule->execute(array($_SESSION['idMembre'], $_SESSION['idEvenement']));

            if (!($checkSchedule->fetch())) {
                $addSchedule = self::$bdd->prepare("INSERT INTO aller VALUES (?, ?)");
                $addSchedule->execute(array($_SESSION['idMembre'], $_SESSION['idEvenement']));
            }
        }
    }

    public function delschedule() {
        if (isset($_SESSION['isConnected']) && isset($_SESSION['pseudo']) && isset($_SESSION['idMembre'])) {
            $checkSchedule = self::$bdd->prepare("SELECT * FROM aller WHERE idMembre = ? and idEvenement = ?");
            $checkSchedule->execute(array($_SESSION['idMembre'], $_SESSION['idEvenement']));

            if ($checkSchedule->fetch()) {
                $delSchedule = self::$bdd->prepare("DELETE FROM aller WHERE idMembre = ? and idEvenement = ?");
                $delSchedule->execute(array($_SESSION['idMembre'], $_SESSION['idEvenement']));
            }
        }
    }
    
}

?>