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

    public function getCategoriesMenu() {
        $reqCat = self::$bdd->query("SELECT * FROM categorie WHERE titreCategorie != 'Concert' AND titreCategorie != 'Festival'");
        $tuples = $reqCat->fetchAll();
        
        return $tuples;
    }

    public function getGroups() {
        $reqGrp = self::$bdd->query("SELECT * FROM groupe");
        $tuples = $reqGrp->fetchAll();
        
        return $tuples;
    }
    
}

?>