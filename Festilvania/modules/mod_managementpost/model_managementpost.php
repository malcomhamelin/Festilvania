<?php

require_once "generic/model_generic.php";

Class ModelManagementpost extends ModelGeneric {

    private $MAX_FILE_SIZE = 1048576;
    private $VALID_EXTENSIONS = array('jpg', 'jpeg', 'gif', 'png');

    public function __contruct() {

    }

    public function is_clean($string) {
       return ! (preg_match("/[.#!$%&'*+=?^_`{|}~-]/", $string));
    }

    public function is_cleanDescription($string) {
       return ! (preg_match("/[#$%*+=^_`{|}~-]/", $string));
    }

    public function publication() {

        if (!empty($_POST['nomEvent'])       && !empty($_POST['description']) &&
            !empty($_POST['dateDebutEvent']) && !empty($_POST['dateFinEvent']) &&
            !empty($_POST['categorie'])      && !empty($_POST['lieu'] && !empty($_FILES['eventPicture']))) {
            
            if ($_POST['dateDebutEvent'] < $_POST['dateFinEvent']) {
                if ($this->is_clean(htmlspecialchars($_POST['nomEvent'])) && $this->is_cleanDescription(htmlspecialchars($_POST['description'])) && $this->is_clean(htmlspecialchars($_POST['lieu']))) {

                    // Variables
                    $nomEvent = htmlspecialchars($_POST['nomEvent']);
                    $dateDebutEvent = htmlspecialchars($_POST['dateDebutEvent']);
                    $dateFinEvent = htmlspecialchars($_POST['dateFinEvent']);
                    $description = htmlspecialchars($_POST['description']);
                    $categorie = htmlspecialchars($_POST['categorie']);
                    $lieu = htmlspecialchars($_POST['lieu']);

                    $req = self::$bdd->prepare("INSERT INTO evenement(idEvenement, titreEvenement, description, date_creation, date_debut, date_fin, idMembre, idCategorie, lieu) VALUES (default, ?, ?, NOW(), ?, ?, ?, ?, ?)");
                    $req->execute(array($nomEvent, $description, $dateDebutEvent, $dateFinEvent, $_SESSION['idMembre'], $categorie, $lieu));
                    
                    $tupleIdEvent = self::$bdd->query("SELECT idEvenement FROM evenement ORDER BY idEvenement DESC");
                    $tupleIdEvent = $tupleIdEvent->fetch();
                    $this->uploadPicture($tupleIdEvent['idEvenement']);

                    echo '<script type="text/javascript">
                        location.href = \'index.php\';
                        window.alert("Vous avez effectué votre post, il ira aux vérifications !");
                    </script>';
                }
                else {
	                $message = 'Il y a des caractères interdits dans les champs, voulez-vous recommencez la publication ?';
	                $this->popUpRedirect($message, "publish");
                }
            }
            else {
                $message = 'Date incorrect, la date de fin se passe avant la date de début, voulez-vous recommencez la publication ?';
                $this->popUpRedirect($message, "publish");
            }
        }
        else {
            $message = 'Les champs ne sont pas tous remplis, voulez-vous recommencez la publication ?';
            $this->popUpRedirect($message, "publish");
        }
    }

    public function eventInfo() {
        $eventSelectionne = self::$bdd->prepare("SELECT * FROM evenement INNER JOIN image using(idEvenement) WHERE idEvenement = ?");
        $eventSelectionne->execute(array($_SESSION['idEvenement']));
        $result = $eventSelectionne->fetch();

        return $result;
    }

    public function edition() {
        
        if (!empty($_POST['nomEvent'])       && !empty($_POST['description']) &&
            !empty($_POST['dateDebutEvent']) && !empty($_POST['dateFinEvent']) &&
            !empty($_POST['categorie'])      && !empty($_POST['lieu'])) {
            
            if ($_POST['dateDebutEvent'] < $_POST['dateFinEvent']) {

                if ($this->is_clean(htmlspecialchars($_POST['nomEvent'])) && $this->is_cleanDescription(htmlspecialchars($_POST['description'])) && $this->is_clean(htmlspecialchars($_POST['lieu']))) {

                    // Variables
                    $nomEvent = htmlspecialchars($_POST['nomEvent']);
                    $dateDebutEvent = htmlspecialchars($_POST['dateDebutEvent']);
                    $dateFinEvent = htmlspecialchars($_POST['dateFinEvent']);
                    $description = htmlspecialchars($_POST['description']);
                    $categorie = htmlspecialchars($_POST['categorie']);
                    $lieu = htmlspecialchars($_POST['lieu']);
                    $publish = isset($_POST['publish']) ? htmlspecialchars($_POST['publish']) : 0;
                    $id = $_POST['id'];

                    $newValues = array($nomEvent, $dateDebutEvent, $dateFinEvent, $description, $categorie, $lieu, $publish);
                    $sql = 'UPDATE evenement
                    SET titreEvenement  = "' . $newValues[0] . '",
                        date_debut      = "' . $newValues[1] . '",
                        date_fin        = "' . $newValues[2] . '",
                        description     = "' . $newValues[3] . '",
                        idCategorie     = "' . $newValues[4] . '",
                        lieu            = "' . $newValues[5] . '",
                        estPublie       = "' . $newValues[6] . '"
                        WHERE idEvenement="' . $id . '"';
                    
                    if ($_FILES['eventPicture']['error'] == 0) {
                        $sqlimg = 'DELETE FROM image WHERE idEvenement = \'' . $id . '\'';
                        $reqimg = self::$bdd->prepare($sqlimg);
                        $reqimg->execute();
                        $tupleIdEvent = self::$bdd->prepare("SELECT idEvenement FROM evenement WHERE idEvenement = ?");
                        $tupleIdEvent->execute(array($id));
                        $tupleIdEvent = $tupleIdEvent->fetch();
                        $this->uploadPicture($tupleIdEvent['idEvenement']);
                    }

                    $req = self::$bdd->prepare($sql);
                    $req->execute();

                    echo '<script type="text/javascript">
                        window.alert("Vous avez bien édité le post !");
                        location.href = \'index.php\';
                    </script>';
                }
                else {
                    $message = 'Il y a des caractères spéciaux interdits dans le nom, le lieu ou la description, voulez-vous recommencez la manipulation ?';
                    $this->popUpRedirectID($message, "editlistbyid", $_POST['id']);
                }
            }
            else {
                $message = 'Date incorrect, la date de fin se passe avant la date de début, voulez-vous recommencez la manipulation ?';
                $this->popUpRedirectID($message, "editlistbyid", $_POST['id']);
            }
        }
        else {
            $message = 'Les champs ne sont pas tous remplis, voulez-vous recommencez la manipulation ?';
            $this->popUpRedirectID($message, "editlistbyid", $_POST['id']);
        }
    }

    public function delete() {
        $_GET['idEvenement'] = htmlspecialchars($_GET['idEvenement']);

        $reqImageLink = self::$bdd->prepare("SELECT * FROM image WHERE idEvenement = ?");
        $reqImageLink->execute(array($_GET['idEvenement']));
        $reqImageLink = $reqImageLink->fetch();
        unlink($reqImageLink['lienImage']);

        $sqlcom = 'DELETE FROM commentaire WHERE idEvenement = \'' . $_GET['idEvenement'] . '\'';
        $reqcom = self::$bdd->prepare($sqlcom);
        $reqcom->execute();
        $sqlvote = 'DELETE FROM voteevenement WHERE idEvenement = \'' . $_GET['idEvenement'] . '\'';
        $reqvote = self::$bdd->prepare($sqlvote);
        $reqvote->execute();
        $sqlimg = 'DELETE FROM image WHERE idEvenement = \'' . $_GET['idEvenement'] . '\'';
        $reqimg = self::$bdd->prepare($sqlimg);
        $reqimg->execute();
        $sql = 'DELETE FROM evenement WHERE idEvenement = \'' . $_GET['idEvenement'] . '\'';
        $req = self::$bdd->prepare($sql);
        $req->execute();
        echo '<script type="text/javascript">
            location.href = \'index.php\';
            window.alert("Vous avez bien supprimé le post !");
        </script>';
    }

    public function popUpRedirect($message, $option) {
        echo '<script type="text/javascript">
            if (window.confirm(\'' . $message . '\')) {
                location.href = \'index.php?mod=' . $_SESSION['mod'] . '&option=' . $option . '\';
            }
            else {
                location.href = \'index.php\';
            }
            </script>';
    }

    public function popUpRedirectID($message, $option, $id) {
        echo '<script type="text/javascript">
            if (window.confirm(\'' . $message . '\')) {
                location.href = \'index.php?mod=' . $_SESSION['mod'] . '&option=' . $option . '&idEvenement=' . $id . '\';
            }
            else {
                location.href = \'index.php\';
            }
            </script>';
    }

    public function uploadPicture($idEvenement) {
        if ($_FILES['eventPicture']['error'] == 0) {
            if ($_FILES['eventPicture']['size'] <= $this->MAX_FILE_SIZE) {
                $upload_extension = strtolower(substr(strrchr($_FILES['eventPicture']['name'], '.'), 1) );
                
                if (in_array($upload_extension, $this->VALID_EXTENSIONS)) {
                    $_POST['nomEvent'] = htmlspecialchars($_POST['nomEvent']);

                    $chemin = 'img/eventPictures/' . $idEvenement . '.' . $upload_extension;
                    $resultat = move_uploaded_file($_FILES['eventPicture']['tmp_name'], $chemin);

                    if ($resultat) {
                        $reqIdEvent = self::$bdd->prepare("SELECT * FROM evenement WHERE titreEvenement = ? ORDER BY idEvenement DESC");
                        $reqIdEvent->execute(array($_POST['nomEvent']));
                        $reqIdEvent = $reqIdEvent->fetch();

                        $insertEventPicture = self::$bdd->prepare("INSERT INTO image (lienImage, idEvenement) VALUES (?, ?)");
                        $insertEventPicture->execute(array($chemin, $reqIdEvent['idEvenement']));
                    }
                }
            }
        }
    }

}

?>
