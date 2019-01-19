<?php

class Connection {

    public static $bdd;

    public function __construct() {

    }

    public static function initConnection() {
        self::$bdd = new PDO('mysql:host=localhost;dbname=festilvania', 'festilvania', 'Maljonerw1&', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }

    public static function upvote($postID) {
        return self::vote(1, $postID);
    }

    public static function downvote($postID) {
        return self::vote(-1, $postID);
    }

    public static function vote($voteValue, $postID) {
        if (isset($_SESSION['isConnected']) && isset($_SESSION['pseudo']) && isset($_SESSION['idMembre']) && $_SESSION['isConnected']) {
            $checkVote = self::$bdd->prepare("SELECT * FROM voteevenement WHERE idMembre = ? and idEvenement = ?");
            $checkVote->execute(array($_SESSION['idMembre'], $postID));

            $resVote = $checkVote->fetch();
            
            if ($resVote['vote'] == $voteValue) {
                $delCurrentVote = self::$bdd->prepare("DELETE FROM voteevenement WHERE idMembre = ? and idEvenement = ? and vote = ?");
                $delCurrentVote->execute(array($_SESSION['idMembre'], $postID, $voteValue));
            }
            else {

                if ($resVote['vote'] == -$voteValue) {
                    $delOppositeVote = self::$bdd->prepare("DELETE FROM voteevenement WHERE idMembre = ? and idEvenement = ? and vote = ?");
                    $delOppositeVote->execute(array($_SESSION['idMembre'], $postID, -$voteValue));
                }
                
                $vote = self::$bdd->prepare("INSERT INTO voteevenement VALUES (?, ?, ?, NOW())");
                $vote->execute(array($_SESSION['idMembre'], $postID, $voteValue));
            }
        }

    }

    public static function getNbVotes($idEvenement) {
        $tuplesNbVotes = self::$bdd->prepare("SELECT evenement.idEvenement, sum(voteevenement.vote) as nbVotes 
            FROM evenement LEFT JOIN voteevenement using (idEvenement) 
            GROUP BY evenement.idEvenement HAVING evenement.idEvenement = ?");
        $tuplesNbVotes->execute(array($idEvenement));
        $result = $tuplesNbVotes->fetch();
        
        return isset($result['nbVotes']) && !empty($result['nbVotes']) ? $result['nbVotes'] : 0;
    }

    public static function addschedule($idEvenement) {
        if (isset($_SESSION['isConnected']) && isset($_SESSION['pseudo']) && isset($_SESSION['idMembre']) && $_SESSION['isConnected']) {
            $checkSchedule = self::$bdd->prepare("SELECT * FROM aller WHERE idMembre = ? and idEvenement = ?");
            $checkSchedule->execute(array($_SESSION['idMembre'], $idEvenement));

            if (!($checkSchedule->fetch())) {
                $addSchedule = self::$bdd->prepare("INSERT INTO aller VALUES (?, ?)");
                $addSchedule->execute(array($_SESSION['idMembre'], $idEvenement));
            }
        }
    }

    public static function delschedule($idEvenement) {
        if (isset($_SESSION['isConnected']) && isset($_SESSION['pseudo']) && isset($_SESSION['idMembre']) && $_SESSION['isConnected']) {
            $checkSchedule = self::$bdd->prepare("SELECT * FROM aller WHERE idMembre = ? and idEvenement = ?");
            $checkSchedule->execute(array($_SESSION['idMembre'], $idEvenement));

            if ($checkSchedule->fetch()) {
                $delSchedule = self::$bdd->prepare("DELETE FROM aller WHERE idMembre = ? and idEvenement = ?");
                $delSchedule->execute(array($_SESSION['idMembre'], $idEvenement));
            }
        }
    }

}

?>