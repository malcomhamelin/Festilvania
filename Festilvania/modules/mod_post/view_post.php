<?php

require_once "tampon/view_generic.php";

class ViewPost extends ViewGeneric {

	public function __construct(){
		parent::__construct();
	}

	public function getPost($comments, $event, $rights) {
		$dateBegin = new DateTime($event['date_debut']);
		$dateEnd = new DateTime($event['date_fin']);

		echo '<div class="container annonce container-post">
				<div class="row">
					<div class="col-lg-3 mx-auto float-left">
						<img src="img/background.jpg" alt="Photo evenement" class="photo-post"/>
					</div>
					<div class="col-lg-9 mx-auto float-right">'.
						$this->getEditButton($rights)
					  .'<h1>' . $event['titreEvenement'] . '</h1>
						<p>' . $dateBegin->format('d/m/y') . ' - ' . $dateEnd->format('d/m/y') . ' | ' . $event['lieu'] . ' </p>
					</div>
				</div>
				<hr>
				<div class="row text-justify">
					<div class="col-xs-12 col-lg-12 mx-auto">
						<p>' . $event['description'] . '</p>
					</div>
				</div>
				<hr>
				<div class="row comment-post">
					<div class="col-xs-12 col-lg-12 mx-auto">
						<h2>Commentaires : </h2>';
						
							$this->getComments($comments);
							
		echo		'</div>
				</div>
				<hr>
				<div class="row">'.
					$this->getCommentForm($rights)
			  .'</div>
			 </div';
			 
	}
	
	public function getComments($comments) {
		if (empty($comments)) {
			echo '	<div class="row mt-3">
						<p class="col-xs-12 col-md-12 text-center">Personne n\'a commenté cet évènement... Soyez le premier !</p>
					<div>';
		}

		foreach ($comments as $key) {
			$date = new DateTime($key['date_creation']);

			echo '<div class="row mt-3">
						<div class="col-lg-2 float-left">
							<img src="' . $key['avatar'] . '" alt="Avatar utilisateur" class="avatar-comment"/>
						</div>
						<div class="col-lg-9">
							<h3> ' . $key['pseudo'] . ' <span id="date-comment">le ' . $date->format('d/m/y') . ' à ' . $date->format('H:i:s') . '</span></h3>
							<p class="text-justify">' . $key['contenu'] . '</p>
						</div>
				</div>';
		}
	}

	public function getEditButton($rights) {
		if ($rights != null && $rights['droit_editer']) {
			return '<button class="btn btn-dark float-right">Editer</button>';
		}
	}

	public function getCommentForm($rights) {
		if ($rights != null && $rights['droit_commenter']) {
			return '<form class="col-lg-10 mx-auto" action="index.php?mod=post&idEvent='. $_SESSION['idEvent'] .'&action=comment" method="post">
						<div class="form-group">
							<textarea class="form-control" placeholder="Commenter..." rows="3" name="comment"></textarea>
							<button type="submit" class="btn btn-success float-right mt-3">Commenter</button>
						</div>
					</form>';
		}
		else {
			return '<p class="col-lg-12 text-center">Vous devez être connecté pour commenter</p>';
		}
	}
    
}

?>