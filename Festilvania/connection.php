<?php

class Connection {

    public static $bdd;

    public function __construct() {

    }

    public static function initConnection() {
        self::$bdd = new PDO('mysql:host=localhost;dbname=festilvania', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }

    public function getRights() {
        if (isset($_SESSION['isConnected']) && $_SESSION['isConnected'] == true) {
            $rights = self::$bdd->prepare("SELECT * FROM membre INNER JOIN groupe ON membre.idGroupe = groupe.idGroupe INNER JOIN droits ON groupe.idDroits = droits.idDroits WHERE membre.idMembre = ?");
            $rights->execute(array($_SESSION['idMembre']));
            $result = $rights->fetch();

            return $result;
        }
    }

}

?>