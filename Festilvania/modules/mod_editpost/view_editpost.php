<?php

require_once "tampon/view_generic.php";

Class ViewEditpost extends ViewGeneric {

    public function __construct() {
        parent::__construct();
    }
    
    public function getEditlist($content) {
        echo '<div class="container">
                <div class="row ml-3">
                    <div class="col-xs-12 col-md-12 col-lg-8 a">
                        <div class="container">
                            <div class="row annonce mt-4 mb-2 bloc mr-1">';

                                $this->getListeEventNonPublie($content);
        echo                '</div>
                        </div>
                    </div>
                </div>
            </div>';


    }

    public function getListeEventNonPublie($content) {
        foreach ($content as $key) {
            echo '
                <div>
                    <br><br>
            		<h1>' . $key['titreEvenement'] . '</h1>
                     <a href="index.php?mod=editpost&option=editlistbyid&idEvenement=' . $key['idEvenement'] . '">Modifier</a> 
                    <p> id : ' . $key['idEvenement'] . '</p>
                    <p> Categorie : ' . $key['idCategorie'] . '</p>
                    <p> Description : ' . $key['description'] . '</p>
                  	<p> Date de début de l\'évènement : ' . $key['date_debut'] . '</p>
                  	<p> Date de fin de l\'évènement : ' . $key['date_fin'] . '</p>
                  	<p> Lieu : ' . $key['lieu'] . '</p>
                  </div>
                  ';
        }
    }

    public function getEditlistbyid($content, $rights) {

        foreach ($content as $key) {

            echo '<br><br><br>';

            echo '<form method="post" action="index.php?mod=editpost&action=edition&idEvenement=' . $key['idEvenement'] . '">';
            
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
                echo '<a href="index.php?mod=editpost&action=delete&idEvenement=' . $key['idEvenement'] . '">Supprimer</a>';
            }  
        }
    }
}
?>