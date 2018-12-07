<?php

require_once "tampon/view_generic.php";

Class ViewTimeline extends ViewGeneric {

    public function __construct() {
        parent::__construct();
    }

    public function getTimeline($content, $userInfos, $hottestContent, $latestContent) {
        echo '<div class="container">
                <div class="row ml-3">
                    <div class="col-xs-12 col-md-12 col-lg-8 a">
                        <div class="container">';

                                $this->getMainTimeline($content, $userInfos);

        echo            '</div>
                    </div>
                    <div class="col-xs-12 col-md-12 col-lg-4 ml-auto mt-4">
                        <div class="row">
                            <div class="col-xs-12 col-md-12 mb-3 blocsAnnexes mb-2 mr-4">
                                <div class="container">';
                                      
                                    $this->getHottestBloc($hottestContent);

        echo                    '</div>
                            </div>
                        </div>
                        <div class="row">
                            <form class="mb-3 col-lg-12" action="index.php?mod=publipost" method="post">
                                <button type="submit" class="btn btn-dark font-weight-bold col-lg-12"><i class="fas fa-plus"></i> Publier</button>
                            </form>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-md-12 blocsAnnexes mb-2 mr-4">
                                <div class="container">';
                                    
                                    $this->getLatestBloc($latestContent);

        echo                    '</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
    }

    public function getMainTimeline($content, $userInfos) {
        if (!empty($content)) {
            foreach ($content as $key) {
                $key['nbVotes'] == null ? $nbVotes = 0 : $nbVotes = $key['nbVotes'];

                echo '  <div class="row annonce mt-4 mb-2 bloc mr-1">
                            <div class="voteButtons col-xs-6 col-md-1 col-lg-1 mr-auto text-center">
                                <a href="index.php?mod=timeline&action=upvote&idEvent=' . $key['idEvenement'] . '"><div class="btn btn-outline-success"><i class="fas fa-plus"></i></div></a>
                                <div class="btn"> <span class="votes">' . $nbVotes . ' <span></div>
                                <a href="index.php?mod=timeline&action=downvote&idEvent=' . $key['idEvenement'] . '"><div class="btn btn-outline-danger"><i class="fas fa-minus"></i></div></a>
                            </div>
                            <div class="img-annonce col-xs-6 col-lg-3 col-centered"></div>
                            <div class="corpsAnnonce col-xs-12 col-lg-7">
                                <h1><a href="index.php?mod=post&idEvent=' . $key['idEvenement'] . '">' . $key['titreEvenement'] . '</a></h1>
                                <p class="description-annonce">' . $key['description'] . '</p>

                                <a href="index.php?mod=post&idEvent=' . $key['idEvenement'] . '"><div class="btn btn-outline-dark btn-custom float-right">Voir l\'évenement</div></a>';

                                $this->getScheduleButton($userInfos, $key['idEvenement']);

                echo        '</div>
                        </div>';
            }
        }
        else {
            echo '  <div class="row annonce mt-4 mb-2 bloc mr-1">
                        <span class="col-xs-12 col-lg-12 text-center">Aucun post présent ici...</span>
                    </div>';
        }
    }

    public function getScheduleButton($userInfos, $idEvenement) {
        $isPresentSchedule = false;

        if (isset($_SESSION['isConnected']) && isset($_SESSION['pseudo']) && isset($_SESSION['idMembre'])) {
            foreach ($userInfos as $key) {
                if ($key['idMembre'] == $_SESSION['idMembre'] && $key['idEvenement'] == $idEvenement) {
                    $isPresentSchedule = true;
                }
            }
        }

        if ($isPresentSchedule)  {
            echo '<a href="index.php?mod=timeline&action=delschedule&option=' . $_SESSION['option'] . '&idEvent=' . $idEvenement . '"><div class="btn btn-outline-dark btn-custom float-right" title="Ajouter à mon agenda"><i class="fas fa-minus"></i></div></a>';
        }
        else {
            echo '<a href="index.php?mod=timeline&action=addschedule&option=' . $_SESSION['option'] . '&idEvent=' . $idEvenement . '"><div class="btn btn-outline-dark btn-custom float-right" title="Ajouter à mon agenda"><i class="fas fa-plus"></i></div></a>';
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
                    <p class="titreBloc">Derniers évènements ajoutés</p>
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