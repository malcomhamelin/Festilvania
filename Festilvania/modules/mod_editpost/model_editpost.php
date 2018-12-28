<?php

require_once "connection.php";

Class ModelEditpost extends Connection {

    public function __contruct() {

    }   

    public function editlist() {
        $tuplesEventNonPublie = self::$bdd->query("SELECT * FROM evenement WHERE estPublie = 'false' ORDER BY date_creation");
        $result = $tuplesEventNonPublie->fetchAll();

        return $result;
    }

    public function editlistbyid() {
        $eventSelectionne = self::$bdd->prepare("SELECT * FROM evenement WHERE idEvenement = ?");
        $eventSelectionne->execute(array($_SESSION['idEvenement']));
        $result = $eventSelectionne->fetchAll();

        return $result;
    }

    public function edition() {

        echo '<br><br><br> HELLO <br>'; // A suppr
        
        if (!empty($_POST['nomEvent'])       && !empty($_POST['description']) &&
            !empty($_POST['dateDebutEvent']) && !empty($_POST['dateFinEvent']) &&
            !empty($_POST['categorie'])      && !empty($_POST['lieu'])) {
            
            if ($_POST['dateDebutEvent'] < $_POST['dateFinEvent']) {

                // Variables
                $nomEvent = htmlspecialchars($_POST['nomEvent']);
                $dateDebutEvent = htmlspecialchars($_POST['dateDebutEvent']);
                $dateFinEvent = htmlspecialchars($_POST['dateFinEvent']);
                $description = htmlspecialchars($_POST['description']);
                $categorie = htmlspecialchars($_POST['categorie']);
                $lieu = htmlspecialchars($_POST['lieu']);

                $newValues = array($nomEvent, $dateDebutEvent, $dateFinEvent, $description, $categorie, $lieu);

                $sql = 'UPDATE evenement
                SET titreEvenement  = \'' . $newValues[0] . '\',
                    date_debut      = \'' . $newValues[1] . '\',
                    date_fin        = \'' . $newValues[2] . '\',
                    description     = \'' . $newValues[3] . '\',
                    idCategorie     = \'' . $newValues[4] . '\',
                    lieu            = \'' . $newValues[5] . '\',
                    estPublie       = 1 
                    WHERE idEvenement=\'' . $_SESSION['idEvenement'] . '\'';
                $req = self::$bdd->prepare($sql);
                $req->execute();

            }
            else {
                // Affichage Message d'erreur Date début > date fin
            }
        }
        else {
            // Affichage Message d'erreur champ vide
        }
    }

    public function delete() {
        $sql = 'DELETE FROM evenement WHERE idEvenement = \'' . $_SESSION['idEvenement'] . '\'';
        $req = self::$bdd->prepare($sql);
        $req->execute();
    }
}

?>