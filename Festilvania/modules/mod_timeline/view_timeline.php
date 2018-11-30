<?php

require_once "tampon/view_generic.php";

Class ViewTimeline extends ViewGeneric {

    public function __construct() {
        parent::__construct();
    }

    public function getHomepage($content) {
        echo '<div class="container">
                <div class="row ml-3">
                    <div class="col-xs-12 col-md-12 col-lg-8 a">
                        <div class="container">
                            <div class="row annonce mt-4 mb-2 bloc mr-1">';

                                $this->getTimeline($content);

        echo               '</div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-12 col-lg-4 ml-auto mt-4">
                        <div class="row">
                            <div class="col-xs-12 col-md-12 mb-3 blocsAnnexes mb-2 mr-4">
                                <div class="container">';
                                      
                                    $this->getHottestBloc($content);

        echo                    '</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-md-12 blocsAnnexes mb-2 mr-4">
                                <div class="container">';
                                    
                                    $this->getLatestBloc($content);

        echo                    '</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
    }

    public function getTimeline($content) {
        foreach ($content as $key) {
            echo '  <div class="voteButtons col-xs-6 col-md-1 col-lg-1 mr-auto">
                        <a href="#"><div class="btn btn-outline-success vote plus"><i class="fas fa-plus"></i></div></a>
                        <a href="#"><div class="btn btn-outline-danger vote moins"><i class="fas fa-minus"></i></div></a>
                    </div>
                    <div class="img-annonce col-xs-6 col-lg-3 col-centered"></div>
                    <div class="corpsAnnonce col-xs-12 col-lg-7">
                        <h1><a href="index.php?mod=post&idEvent=' . $key['idEvenement'] . '">' . $key['titreEvenement'] . '</a></h1>
                        <p>' . $key['description'] . '</p>

                        <a href="index.php?mod=post&idEvent=' . $key['idEvenement'] . '"><div class="btn btn-outline-dark btn-custom float-right">Voir l\'évenement</div></a>
                        <a href="#"><div class="btn btn-outline-dark btn-custom float-right" title="Ajouter à mon agenda"><i class="fas fa-plus"></i></div></a>
                    </div>';
        }
    }

    public function getHottestBloc($content) {
        echo    '<div>
                    <p class="titreBloc">Le meilleur</p>
                    <a href="#" id="dropdownLeMeilleur">Jour</a>
                </div>';
            
        foreach ($content as $key) {

            echo    '<div class="row mt-2">
                        <img src="img/background.jpg" alt="" class="imgAnnonceBlocAnnexe">
                        <div class="evenBlocAnnexe">
                            <h1>' . $key['titreEvenement'] . '</h1>
                            <p>Ajouté le ' . $key['date_creation'] . '</p>
                        </div>
                    </div>';
        
        }

    }

    public function getLatestBloc($content) {
        echo    '<div>
                    <p class="titreBloc">Derniers posts consultés</p>
                </div>';
            
        foreach ($content as $key) {

            echo    '<div class="row mt-2">
                        <img src="img/background.jpg" alt="" class="imgAnnonceBlocAnnexe">
                        <div class="evenBlocAnnexe">
                            <h1>' . $key['titreEvenement'] . '</h1>
                            <p>Ajouté le ' . $key['date_creation'] . '</p>
                        </div>
                    </div>';
        
        }

    }

}

?>