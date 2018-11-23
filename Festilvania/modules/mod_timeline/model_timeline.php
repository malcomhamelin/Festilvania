<?php

require_once "connection.php";

Class ModelTimeline extends Connection {

    public function __contruct() {

    }

    public function homepage() {
        $tuplesHomePage = self::$bdd->query("SELECT * FROM evenement ORDER BY date_creation DESC");
        $result = $tuplesHomePage->fetchAll();

        return $result;
    }

    public function connection() {
        if (isset($_POST['pseudo']) && isset($_POST['password'])) {
            $pseudo = htmlspecialchars($_POST['pseudo']);
            $password = htmlspecialchars($_POST['password']);

            $existingPseudoQuery = Connection::$bdd->prepare("SELECT * FROM membre WHERE pseudo = ?");
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

}

?>