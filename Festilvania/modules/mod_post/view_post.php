<?php

require_once "generic/view_generic.php";

class ViewPost extends ViewGeneric {

	public function __construct(){
		parent::__construct();
	}

	public function getPost($comments, $event, $rights, $userSchedule) {
		$dateBegin = new DateTime($event['date_debut']);
		$dateEnd = new DateTime($event['date_fin']);

		require_once "template_post.php";
	}
	
	public function getComments($comments) {
		if (empty($comments)) {
			echo 'Personne n\'a commenté cet évènement... Soyez le premier !';
		}
		else {
			foreach ($comments as $key) {
				$date = new DateTime($key['date_creation']);

				echo '<div class="row mt-4">
							<div class="col-2 col-lg-2 float-left">
								<img src="' . $key['avatar'] . '" alt="Avatar utilisateur" class="avatar-comment"/>
							</div>
							<div class="col-9">
								<h3 class="col-10 ml-5"> ' . $key['pseudo'] . ' <span id="date-comment">le ' . $date->format('d/m/y') . ' à ' . $date->format('H:i:s') . '</span></h3>
								<p class="col-12 ml-5 text-justify">' . $key['contenu'] . '</p>
							</div>
					</div>';
			}
		}
	}

	public function getEditButton($rights, $event) {
		$idMembreConnecte = isset($_SESSION['idMembre']) && !empty($_SESSION['idMembre']) ? $_SESSION['idMembre'] : -1;

		if (($rights != null && $rights['droit_editer']) || ($event['idMembre'] == $idMembreConnecte)) {
			echo '<a href="index.php?mod=managementpost&option=editlistbyid&idEvenement='. $_SESSION['idEvenement'] .'" class="btn btn-warning annonce-corps-btn ml-2">Editer</a>';
		}
	}

	public function getCommentForm($rights) {
		if ($rights != null && $rights['droit_commenter']) {
			echo '<form class="col-lg-10 mx-auto pt-4 pb-5" action="index.php?mod=post&idEvenement='. $_SESSION['idEvenement'] .'&action=comment" method="post">
						<div class="form-group">
							<textarea class="form-control" placeholder="Commenter..." rows="3" name="comment" minlength=32 required></textarea>
							<button type="submit" class="btn btn-warning annonce-corps-btn float-right mt-3">Commenter</button>
						</div>
				  </form>';
		}
		else {
			echo '<p class="col-lg-12 text-center">Vous devez être connecté pour commenter</p>';
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
            echo '<div class="py-0 px-0 btn btn-warning annonce-corps-btn mx-auto"><i title="Retirer de mon agenda" data-schedule="del" data-user="' . $idMembre . '" data-post="' . $idEvenement . '" class="schedule px-3 py-3 fas fa-minus"></i></div>';
        }
        else {
            echo '<div class="py-0 px-0 btn btn-warning annonce-corps-btn mx-auto"><i title="Ajouter à mon agenda" data-schedule="add" data-user="' . $idMembre . '" data-post="' . $idEvenement . '" class="schedule px-3 py-2 fas fa-plus"></i></div>';
        }
    }
    
}

?>
