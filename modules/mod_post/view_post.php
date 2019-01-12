<?php

require_once "tampon/view_generic.php";

class ViewPost extends ViewGeneric {

	public function __construct(){
		parent::__construct();
	}

	public function getPost($comments, $event, $rights, $userInfos) {
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

	public function getEditButton($rights) {
		if ($rights != null && $rights['droit_editer']) {
			echo '<a href="index.php?mod=managementpost&option=editlistbyid&idEvenement='. $_SESSION['idEvenement'] .'" class="btn btn-warning annonce-corps-btn ml-2">Editer</a>';
		}
	}

	public function getCommentForm($rights) {
		if ($rights != null && $rights['droit_commenter']) {
			echo '<form class="col-lg-10 mx-auto pt-4 pb-5" action="index.php?mod=post&idEvenement='. $_SESSION['idEvenement'] .'&action=comment" method="post">
						<div class="form-group">
							<textarea class="form-control" placeholder="Commenter..." rows="3" name="comment"></textarea>
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

        if (isset($_SESSION['isConnected']) && isset($_SESSION['pseudo']) && isset($_SESSION['idMembre'])) {
            foreach ($userInfos as $key) {
                if ($key['idMembre'] == $_SESSION['idMembre'] && $key['idEvenement'] == $idEvenement) {
                    $isPresentSchedule = true;
                }
            }
        }

        if ($isPresentSchedule)  {
            echo '<a href="index.php?mod=post&action=delschedule&option=' . $_SESSION['option'] . '&idEvenement=' . $idEvenement . '"><div class="btn btn-warning annonce-corps-btn mx-auto" title="Retirer de mon agenda"><i class="fas fa-minus"></i></div></a>';
        }
        else {
            echo '<a href="index.php?mod=post&action=addschedule&option=' . $_SESSION['option'] . '&idEvenement=' . $idEvenement . '"><div class="btn btn-warning annonce-corps-btn mx-auto" title="Ajouter à mon agenda"><i class="fas fa-plus"></i></div></a>';
        }
    }
    
}

?>