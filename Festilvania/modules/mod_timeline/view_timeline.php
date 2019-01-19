<?php

require_once "generic/view_generic.php";

Class ViewTimeline extends ViewGeneric {

    public function __construct() {
        parent::__construct();
    }

    public function getTimeline($content, $userInfos, $hottestContent, $latestContent, $option) {
        require_once "template_timeline.php";
    }

    public function getMainTimeline($content, $userInfos) {
        if (!empty($content)) {
            foreach ($content as $key) {
                $key['nbVotes'] == null ? $nbVotes = 0 : $nbVotes = $key['nbVotes'];
                $dateBegin = new DateTime($key['date_debut']);
		        $dateEnd = new DateTime($key['date_fin']);

                echo    '<div class="container annonce shadow-sm mb-5">
                            <div class="row">
                                <div class="col-2 col-md-1 col-lg-1 votes ml-5 my-auto">
                                    <span data-vote="like" data-post="' . $key['idEvenement'] . '" class="like"><img src="img/nexttg.png" alt="upvote" class="votes-img"></span>
                                    <div class="btn font-weight-bold"><span class="nbVotes" data-post="' . $key['idEvenement'] . '">' . $nbVotes . '</span></div>
                                    <span data-vote="dislike" data-post="' . $key['idEvenement'] . '" class="dislike"><img src="img/nextbg.png" alt="downvote" class="votes-img"></span>
                                </div>
                    
                                <div class="col-7 col-md-4 col-lg-3 annonce-col">
                                    <img src="' . $key['lienImage'] . '" alt="Photo évenement" class="annonce-col-img rounded">
                                </div>
                    
                                <div class="col-12 col-md-6 annonce-corps">
                                    <div class="row mx-auto">
                                        <div class="col-12 col-sm-12 col-md-12">
                                            <span class="my-auto annonce-corps-titre"><a href="index.php?mod=post&idEvenement=' . $key['idEvenement'] . '">' . $key['titreEvenement'] . '</a></span>
                                            <span class="my-auto font-weight-bold" id="annonce-corps-infos">' . $dateBegin->format('d/m/y') . ' - ' . $dateEnd->format('d/m/y') . ' à ' . $key['lieu'] . '</span>
                                        </div>
                                    </div>
                                    <div class="row mt-3 mx-auto">
                                        <div class="col-10 col-sm-8 col-md-10">';
                                            
                                            $this->getScheduleButton($userInfos, $key['idEvenement']);

                echo                        '<a href="index.php?mod=post&idEvenement=' . $key['idEvenement'] . '"><div class="py-1 px-2 btn btn-warning annonce-corps-btn ml-3">Voir l\'évènement</div></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>';
            }
        }
        else {
            echo '  <div class="container annonce shadow-sm text-center">
                        <span class="col-12 col-lg-12 font-weight-bold">Aucun évenement présent ici...</span>
                    </div>';
        }
    }

    public function getScheduleButton($userInfos, $idEvenement) {
        $isPresentSchedule = false;

        if (isset($_SESSION['isConnected']) && isset($_SESSION['pseudo']) && isset($_SESSION['idMembre']) && $_SESSION['isConnected']) {
            foreach ($userInfos as $key) {
                if ($key['idMembre'] == $_SESSION['idMembre'] && $key['idEvenement'] == $idEvenement) {
                    $isPresentSchedule = true;
                }
            }
        }

        $idMembre = isset($_SESSION['idMembre']) && !empty($_SESSION['idMembre']) ? $_SESSION['idMembre'] : -1;

        if ($isPresentSchedule)  {
            echo '<div class="py-0 px-0 btn btn-warning annonce-corps-btn mx-auto"><i title="Retirer de mon agenda" data-schedule="del" data-user="' . $idMembre . '" data-post="' . $idEvenement . '" class="schedule px-3 py-2 fas fa-minus"></i></div>';
        }
        else {
            echo '<div class="py-0 px-0 btn btn-warning annonce-corps-btn mx-auto"><i title="Ajouter à mon agenda" data-schedule="add" data-user="' . $idMembre . '" data-post="' . $idEvenement . '" class="schedule px-3 py-2 fas fa-plus"></i></div>';
        }
    }

    public function getAsideBloc($content) {
        foreach ($content as $key) {
            $dateBegin = new DateTime($key['date_debut']);
		    $dateEnd = new DateTime($key['date_fin']);

            echo    '<div class="col-10 col-md-3 mx-auto mb-4 blocs-annexes-annonces">
                        <img src="' . $key['lienImage'] . '" alt="event1" class="blocs-annexes-photos">
                        <div class="blocs-annexes-annonces-texte ml-2 text-left">
                            <a href="index.php?mod=post&idEvenement=' . $key['idEvenement'] . '">
                                <span class="font-weight-bold blocs-annexes-annonces-texte-titre">' . $key['titreEvenement'] . '</span><br>
                                <span class="blocs-annexes-annonces-texte-description font-weight-bold">' . $dateBegin->format('d/m/y') . ' - ' . $dateEnd->format('d/m/y') . ' | ' . $key['lieu'] . '</span>
                            </a>
                        </div>
                    </div>';
        
        }

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
                     <a href="index.php?mod=managementpost&option=editlistbyid&idEvenement=' . $key['idEvenement'] . '">Modifier</a> 
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

    public function getTitle($option) {
        switch ($option) {
            case 'myschedule' :
                echo "<h1 class='font-weight-bold text-center mb-5' id='timeline-title'>Mon agenda</h1>";
                break;
            case 'search' :
                echo "<h1 class='font-weight-bold text-center mb-5' id='timeline-title'>Recherche : " . $_SESSION['search'] . "</h1>";
                break;
            case 'editlist' :
                echo "<h1 class='font-weight-bold text-center mb-5' id='timeline-title'>Evenements en attente</h1>";
                break;
            case 'myposts' :
                echo "<h1 class='font-weight-bold text-center mb-5' id='timeline-title'>Mes posts</h1>";
                break;
            case 'homepage' :
                echo "<h1 class='font-weight-bold text-center mb-5' id='timeline-title'>Accueil</h1>";
                break;
            default :
                echo "<h1 class='font-weight-bold text-center mb-5' id='timeline-title'>" . $option . "</h1>";
                break;
        }
    }

}

?>
