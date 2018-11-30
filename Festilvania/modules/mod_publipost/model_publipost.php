<?php

require_once "connection.php";

Class ModelPublipost extends Connection {

    public function __contruct() {

    }

    public function publication() {

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

                $req = self::$bdd->prepare("INSERT INTO evenement(idEvenement, titreEvenement, description, date_creation, date_debut, date_fin, idMembre, idCategorie, lieu) VALUES (default, ?, ?, NOW(), ?, ?, ?, ?, ?)");
                $req->execute(array($nomEvent, $description, $dateDebutEvent, $dateFinEvent, $_SESSION['idMembre'], $categorie, $lieu));
                
            }
            else {
                // Affichage Message d'erreur Date début > date fin
            }
        }
        else {
            // Affichage Message d'erreur champ vide
        }
        //header('Location: index.php');
    }
    
}

?>