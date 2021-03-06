<?php

require_once "generic/model_generic.php";

Class ModelTimeline extends ModelGeneric {

    public function __contruct() {

    }

    public function homepage() {
        $tuplesHomePage = self::$bdd->query("SELECT evenement.idEvenement, evenement.estPublie, titreEvenement, evenement.description, evenement.date_creation, date_debut, date_fin, evenement.idMembre, idCategorie, lieu, sum(voteevenement.vote) as nbVotes, image.lienImage 
            FROM image INNER JOIN evenement using (idEvenement) LEFT JOIN voteevenement using (idEvenement) 
            GROUP BY evenement.idEvenement HAVING evenement.estPublie = 1 ORDER BY date_creation DESC");
        $result = $tuplesHomePage->fetchAll();

        return $result;
    }

    public function myschedule() {
        if (isset($_SESSION['isConnected']) && isset($_SESSION['pseudo']) && isset($_SESSION['idMembre']) && $_SESSION['isConnected']) {
            $tuplesHomePage = self::$bdd->prepare("SELECT lienImage, evenement.idEvenement, titreEvenement, evenement.description, evenement.date_creation, date_debut, date_fin, evenement.idMembre, idCategorie, lieu, membre.idMembre, sum(voteevenement.vote) as nbVotes 
            FROM image INNER JOIN evenement using(idEvenement) LEFT JOIN voteevenement using (idEvenement) INNER JOIN aller ON evenement.idEvenement = aller.idEvenement INNER JOIN membre ON aller.idMembre = membre.idMembre 
            GROUP BY evenement.idEvenement HAVING membre.idMembre = ? ORDER BY date_creation DESC");
            $tuplesHomePage->execute(array($_SESSION['idMembre']));
            $result = $tuplesHomePage->fetchAll();

            return $result;
        }
    }

    public function myposts() {
        if (isset($_SESSION['isConnected']) && isset($_SESSION['pseudo']) && isset($_SESSION['idMembre']) && $_SESSION['isConnected']) {
            $tuplesMyPosts = self::$bdd->prepare("SELECT evenement.idEvenement, titreEvenement, evenement.description, evenement.date_creation, date_debut, date_fin, evenement.idMembre, idCategorie, lieu, sum(voteevenement.vote) as nbVotes, image.lienImage 
                FROM image INNER JOIN evenement using (idEvenement) LEFT JOIN voteevenement using (idEvenement) 
                GROUP BY evenement.idEvenement HAVING evenement.idMembre = ? ORDER BY date_creation DESC");
            $tuplesMyPosts->execute(array($_SESSION['idMembre']));
            $result = $tuplesMyPosts->fetchAll();

            return $result;
        }
    }

    public function hottestContent() {
        $tuplesHottest = self::$bdd->query("SELECT evenement.idEvenement, evenement.estPublie, titreEvenement, evenement.date_creation, date_debut, date_fin, lieu, COALESCE(sum(voteevenement.vote), 0) as nbVotes, image.lienImage 
        FROM image INNER JOIN evenement using (idEvenement) LEFT JOIN voteevenement using (idEvenement)
        GROUP BY evenement.idEvenement HAVING evenement.estPublie = 1 ORDER BY nbVotes DESC LIMIT 3");
        $result = $tuplesHottest->fetchAll();

        return $result;
    }

    public function latestContent() {
        $tuplesHottest = self::$bdd->query("SELECT * FROM evenement INNER JOIN image using (idEvenement) 
                                            WHERE estPublie = 1 ORDER BY date_creation DESC LIMIT 3");
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
        $tuplesCategorie = self::$bdd->prepare("SELECT evenement.estPublie, categorie.titreCategorie, evenement.idEvenement, titreEvenement, evenement.description, evenement.date_creation, date_debut, date_fin, evenement.idMembre, idCategorie, lieu, sum(voteevenement.vote) as nbVotes, lienImage 
        FROM categorie INNER JOIN evenement using (idCategorie) INNER JOIN image using (idEvenement) LEFT JOIN voteevenement using (idEvenement) 
        GROUP BY evenement.idEvenement HAVING categorie.titreCategorie = ? AND evenement.estPublie = 1 ORDER BY date_creation DESC");

        $tuplesCategorie->execute(array($option));
        $result = $tuplesCategorie->fetchAll();

        return $result;
    }

    public function search() {
    	if (isset($_POST['searchInput'])) {
            $_SESSION['search'] = htmlspecialchars($_POST['searchInput']);
        }
        else {
            $_SESSION['search'] = isset($_SESSION['search']) && !empty($_SESSION['search']) ? $_SESSION['search'] : "";
        }
    	
        $wantedWords = $_SESSION['search'];
        $wordCount = str_word_count($wantedWords);
        $arrayWantedWords = explode(" ", $wantedWords);

        if ($wordCount > 0) {
            $arrayWantedWords[0] = strtoupper($arrayWantedWords[0]);
            $requestWords = 'upper(evenement.titreEvenement) LIKE "%' . $arrayWantedWords[0] . '%"';

            for ($indice = 1 ; $indice < $wordCount ; $indice++) {
                $arrayWantedWords[$indice] = strtoupper($arrayWantedWords[1]);
                $requestWords = $requestWords . 'OR upper(evenement.titreEvenement) LIKE "%' . $arrayWantedWords[$indice] . '%" ';
            }

            $request = 'SELECT lienImage, evenement.estPublie, evenement.idEvenement, titreEvenement, evenement.description, evenement.date_creation, date_debut, date_fin, evenement.idMembre, idCategorie, lieu, sum(voteevenement.vote) as nbVotes 
                        FROM image INNER JOIN evenement using(idEvenement) LEFT JOIN voteevenement using (idEvenement) 
                        GROUP BY evenement.idEvenement 
                        HAVING (' . $requestWords . ') AND evenement.estPublie = 1 ORDER BY date_creation DESC';

            $tuplesSearch = self::$bdd->query($request);
            $result = $tuplesSearch->fetchAll();

            return $result;
        }
    }

    public function connection() {
        if (isset($_POST['pseudo']) && isset($_POST['password'])) {
            $pseudo = htmlspecialchars($_POST['pseudo']);
            $password = htmlspecialchars($_POST['password']);

            $existingPseudoQuery = self::$bdd->prepare("SELECT * FROM membre WHERE pseudo = ?");
            $existingPseudoQuery->execute(array($pseudo));

            if ($tuple = $existingPseudoQuery->fetch()) {
                $isPasswordCorrect = password_verify($password, $tuple['password']);

                if ($isPasswordCorrect) {
                    $_SESSION['isConnected'] = true;
                    $_SESSION['pseudo'] = $pseudo;
                    $_SESSION['avatar'] = $tuple['avatar'];
                    $_SESSION['idMembre'] = $tuple['idMembre'];
                    $_SESSION['membre'] = $tuple;
                }
            }
        }

        header('Location: index.php?mod=' . $_SESSION['mod'] . '&option=' . $_SESSION['option']);
    }

    public function disconnection() {
        if (isset($_SESSION['isConnected']) && isset($_SESSION['pseudo'])) {
            $_SESSION['isConnected'] = false;
            $_SESSION['pseudo'] = null;
            $_SESSION['avatar'] = null;
            $_SESSION['idMembre'] = null;
            $_SESSION['membre'] = null;
        }

        header('Location: index.php?mod=' . $_SESSION['mod'] . '&option=' . $_SESSION['option']);
    }

    public function editlist() {
        $tuplesEventNonPublie = self::$bdd->query("SELECT evenement.estPublie, evenement.idEvenement, titreEvenement, evenement.description, evenement.date_creation, date_debut, date_fin, evenement.idMembre, idCategorie, lieu, sum(voteevenement.vote) as nbVotes, image.lienImage 
            FROM image INNER JOIN evenement using (idEvenement) LEFT JOIN voteevenement using (idEvenement) 
            GROUP BY evenement.idEvenement HAVING estPublie = 0 ORDER BY date_creation DESC");
        $result = $tuplesEventNonPublie->fetchAll();

        return $result;
    }

}

?>
