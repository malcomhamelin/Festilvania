<?php

require_once "tampon/view_generic.php";

Class ViewManagementpost extends ViewGeneric {

    public function __construct() {
        parent::__construct();
    }

    public function getPublipage($categories, $rights) {
        if (isset($_SESSION['isConnected']) && isset($_SESSION['pseudo']) && isset($_SESSION['idMembre'])) {
                if ($rights != null && $rights['droit_poster']) {
                require_once "template_publipost.php";
            }
        }
        else {
            echo    '<div class="container annonce shadow-sm text-center mt-5">
                        <span class="col-12 col-lg-12 font-weight-bold">Vous devez être connecté pour pouvoir poster</span>
                    </div>';
        }
    }

    public function getOptions($categories) {
        foreach ($categories as $key) {
            echo '<option value=' . $key['idCategorie'] . '>' . $key['titreCategorie'] . '</option>';
        }
    }

    public function getEditlistbyid($content, $rights) {

        foreach ($content as $key) {

            echo '<form method="post" action="index.php?mod=managementpost&action=edition&idEvenement=' . $key['idEvenement'] . '">';
            
            echo 'ID : ' . $key['idEvenement'] .
                '<br>Nom de l\'Event : <input type="textarea" minlength="3" maxlength="40" name="nomEvent" value="' . htmlspecialchars($key['titreEvenement']) . '"><br>
                Date du début d\'évènement : <input type="date" min="2018-11-30" max="2028-01-01" name="dateDebutEvent" value=' . $key['date_debut'] . '><br>
                Date de fin d\'évènement : <input type="date" min="2018-11-30" max="2028-01-01" name="dateFinEvent" value=' . $key['date_fin'] . '><br>
                Description : <textarea minlength="20" name="description">';
                    echo htmlspecialchars($key['description']);
            echo '</textarea><br>
                Categorie : <select name="categorie">
                                <option value=1>Convention</option>
                                <option value=2>Concert</option>
                                <option value=3>Festival</option>
                                <option value=4>Spectacle</option>
                                <option value=5>Autre</option>
                        </select><br>
                Lieu : <input type="textarea" minlength="4" name="lieu" value=' . $key['lieu'] . '><br> ';
        }

        echo '  <div class="bloc">
                    <input type="submit" value="Envoyer">   
                </div>
            </form>';
        $this->deleteButton($content, $rights);
            
    }

    public function deleteButton($content, $rights) {
        if ($rights != null && $rights['droit_supprimer']) {
            foreach ($content as $key) {
                echo '<a href="index.php?mod=managementpost&action=delete&idEvenement=' . $key['idEvenement'] . '">Supprimer</a>';
            }  
        }
    }
}
?>