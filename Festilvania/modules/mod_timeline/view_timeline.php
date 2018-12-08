<?php

require_once "tampon/view_generic.php";

Class ViewTimeline extends ViewGeneric {

    public function __construct() {
        parent::__construct();
    }

    public function getTimeline($content, $userInfos, $hottestContent, $latestContent) {
        require_once "template_timeline.php";
    }

    public function getMainTimeline($content, $userInfos) {
        if (!empty($content)) {
            foreach ($content as $key) {
                $key['nbVotes'] == null ? $nbVotes = 0 : $nbVotes = $key['nbVotes'];

                echo    '<div class="container annonce shadow-sm mb-5">
                            <div class="row">
                                <div class="col-2 col-md-1 col-lg-1 votes ml-5 my-auto">
                                    <a href="index.php?mod=timeline&action=upvote&idEvent=' . $key['idEvenement'] . '"><img src="img/nexttg.png" alt="upvote" class="votes-img"></a>
                                    <div class="btn font-weight-bold"><span>' . $nbVotes . '</span></div>
                                    <a href="index.php?mod=timeline&action=downvote&idEvent=' . $key['idEvenement'] . '"><img src="img/nextbg.png" alt="downvote" class="votes-img"></a>
                                </div>
                    
                                <div class="col-7 col-md-4 col-lg-3 annonce-col">
                                    <img src="img/background.jpg" alt="Photo évenement" class="annonce-col-img rounded">
                                </div>
                    
                                <div class="col-12 col-md-6 annonce-corps">
                                    <div class="row mx-auto">
                                        <div class="col-12 col-sm-12 col-md-12">
                                            <span class="my-auto annonce-corps-titre"><a href="index.php?mod=post&idEvent=' . $key['idEvenement'] . '">' . $key['titreEvenement'] . '</a></span>
                                            <span class="my-auto font-weight-bold" id="annonce-corps-infos">01/01/2018 - 02/03/2018 à Paris</span>
                                        </div>
                                    </div>
                                    <div class="row mt-3 mx-auto">
                                        <div class="col-10 col-sm-8 col-md-10">';
                                            
                                            $this->getScheduleButton($userInfos, $key['idEvenement']);

                echo                        '<a href="index.php?mod=post&idEvent=' . $key['idEvenement'] . '"><div class="btn btn-warning annonce-corps-btn ml-3">Voir l\'évènement</div></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>';
            }
        }
        else {
            echo '  <div class="container annonce shadow-sm text-center">
                        <span class="col-12 col-lg-12 font-weight-bold">Aucun post présent ici...</span>
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
            echo '<a href="index.php?mod=timeline&action=delschedule&option=' . $_SESSION['option'] . '&idEvent=' . $idEvenement . '"><div class="btn btn-warning annonce-corps-btn mx-auto" title="Retirer de mon agenda"><i class="fas fa-minus"></i></div></a>';
        }
        else {
            echo '<a href="index.php?mod=timeline&action=addschedule&option=' . $_SESSION['option'] . '&idEvent=' . $idEvenement . '"><div class="btn btn-warning annonce-corps-btn mx-auto" title="Ajouter à mon agenda"><i class="fas fa-plus"></i></div></a>';
        }
    }

    public function getAsideBloc($content) {
        foreach ($content as $key) {
            $dateBegin = new DateTime($key['date_debut']);
		    $dateEnd = new DateTime($key['date_fin']);

            echo    '<div class="col-10 col-md-3 mx-auto mb-4 blocs-annexes-annonces">
                        <img src="img/background3.jpg" alt="event1" class="blocs-annexes-photos">
                        <div class="blocs-annexes-annonces-texte ml-2 text-left">
                            <a href="index.php?mod=post&idEvent=' . $key['idEvenement'] . '">
                                <span class="font-weight-bold blocs-annexes-annonces-texte-titre">' . $key['titreEvenement'] . '</span><br>
                                <span class="blocs-annexes-annonces-texte-description font-weight-bold">' . $dateBegin->format('d/m/y') . ' - ' . $dateEnd->format('d/m/y') . ' | ' . $key['lieu'] . '</span>
                            </a>
                        </div>
                    </div>';
        
        }

    }

}

?>