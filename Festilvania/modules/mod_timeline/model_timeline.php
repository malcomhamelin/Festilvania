<?php

require_once "connection.php";

Class ModelTimeline extends Connection {

    public function __contruct() {

    }

    public function homepage() {
        $tuplesHomePage = self::$bdd->query("SELECT evenement.idEvenement, titreEvenement, evenement.description, evenement.date_creation, date_debut, date_fin, evenement.idMembre, idCategorie, lieu, sum(voteevenement.vote) as nbVotes FROM evenement LEFT JOIN voteevenement using (idEvenement) GROUP BY evenement.idEvenement ORDER BY date_creation DESC");
        $result = $tuplesHomePage->fetchAll();

        return $result;
    }

    public function myschedule() {
        if (isset($_SESSION['isConnected']) && isset($_SESSION['pseudo']) && isset($_SESSION['idMembre'])) {
            $tuplesHomePage = self::$bdd->prepare("SELECT evenement.idEvenement, titreEvenement, evenement.description, evenement.date_creation, date_debut, date_fin, evenement.idMembre, idCategorie, lieu, membre.idMembre, sum(voteevenement.vote) as nbVotes 
            FROM evenement LEFT JOIN voteevenement using (idEvenement) INNER JOIN aller ON evenement.idEvenement = aller.idEvenement INNER JOIN membre ON aller.idMembre = membre.idMembre 
            GROUP BY evenement.idEvenement HAVING membre.idMembre = ? ORDER BY date_creation DESC");
            $tuplesHomePage->execute(array($_SESSION['idMembre']));
            $result = $tuplesHomePage->fetchAll();

            return $result;
        }
    }

    public function hottestContent() {
        $tuplesHottest = self::$bdd->query("SELECT evenement.idEvenement, titreEvenement, evenement.date_creation, date_debut, date_fin, lieu, COALESCE(sum(voteevenement.vote), 0) as nbVotes 
        FROM evenement LEFT JOIN voteevenement using (idEvenement)
        GROUP BY evenement.idEvenement ORDER BY nbVotes DESC");
        $result = $tuplesHottest->fetchAll();

        return $result;
    }

    public function latestContent() {
        $tuplesHottest = self::$bdd->query("SELECT * FROM evenement ORDER BY date_creation DESC");
        $result = $tuplesHottest->fetchAll();

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

    public function categories($option) {
        $tuplesCategorie = self::$bdd->prepare("SELECT categorie.titreCategorie, evenement.idEvenement, titreEvenement, evenement.description, evenement.date_creation, date_debut, date_fin, evenement.idMembre, idCategorie, lieu, sum(voteevenement.vote) as nbVotes 
        FROM categorie INNER JOIN evenement using (idCategorie) LEFT JOIN voteevenement using (idEvenement) 
        GROUP BY evenement.idEvenement HAVING categorie.titreCategorie = ? ORDER BY date_creation DESC");

        $tuplesCategorie->execute(array($option));
        $result = $tuplesCategorie->fetchAll();

        return $result;
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

    public function connection() {
        if (isset($_POST['pseudo']) && isset($_POST['password'])) {
            $pseudo = htmlspecialchars($_POST['pseudo']);
            $password = htmlspecialchars($_POST['password']);

            $existingPseudoQuery = self::$bdd->prepare("SELECT * FROM membre WHERE pseudo = ?");
            $existingPseudoQuery->execute(array($pseudo));

            if ($tuple = $existingPseudoQuery->fetch()) {
                if ($tuple['password'] == $password) {
                    $_SESSION['isConnected'] = true;
                    $_SESSION['pseudo'] = $pseudo;
                    $_SESSION['avatar'] = $tuple['avatar'];
                    $_SESSION['idMembre'] = $tuple['idMembre'];
                }
            }
        }

        header('Location: index.php?mod=' . $_SESSION['mod'] . '&option=' . $_SESSION['option']);
    }

    public function disconnection() {
        if (isset($_SESSION['isConnected']) && isset($_SESSION['pseudo'])) {
            $_SESSION['isConnected'] = false;
            $_SESSION['pseudo'] = null;
        }

        header('Location: index.php?mod=' . $_SESSION['mod'] . '&option=' . $_SESSION['option']);
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
