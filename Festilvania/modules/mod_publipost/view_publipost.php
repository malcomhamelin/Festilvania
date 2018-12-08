<?php

require_once "tampon/view_generic.php";

Class ViewPublipost extends ViewGeneric {

    public function __construct() {
        parent::__construct();
	}
	
	public function getPublipage() {
		echo '<div class="container">
				<div class="row">
					<div class="col-8 container-publipost annonce">
						<div class="col-lg-4 mx-auto mb-4">
							<img id="uploadPreview" style="width: 100px; height: 100px;" />
							<input id="uploadImage" type="file" name="browsePic" onchange="PreviewImage();" />
							<script type="text/javascript">

								function PreviewImage() {
									var oFReader = new FileReader();
									oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);

									oFReader.onload = function (oFREvent) {
										document.getElementById("uploadPreview").src = oFREvent.target.result;
									};
								};

							</script>
						</div>
						<div class="col-lg-8 mx-auto">
							<form method="post" action="index.php?mod=publipost&action=publication">
								<div class="form-group row">
									<label for="nameInput" class="col-4 col-form-label">Nom</label>
									<div class="col-8">
										<input class="form-control" type="text" name="nomEvent" id="nameInput">
									</div>
								</div>
								<div class="form-group row">
									<label for="dateDebut" class="col-4 col-form-label">Date de début</label>
									<div class="col-8">
										<input class="form-control" type="date" name="dateDebutEvent" id="dateDebut">
									</div>
								</div>
								<div class="form-group row">
									<label for="dateFin" class="col-4 col-form-label">Date de fin</label>
									<div class="col-8">
										<input class="form-control" type="date" name="dateFinEvent" id="dateFin">
									</div>
								</div>
								<div class="form-group row">
									<label for="locationInput" class="col-4 col-form-label">Lieu</label>
									<div class="col-8">
										<input class="form-control" type="text" name="lieu" id="locationInput">
									</div>
								</div>
								
								<div class="form-group row">
									<label for="categories" class="col-4 col-form-label">Type</label>
									<div class="col-8">
										<select class="col-12 form-control" name="categorie" id="categories">
											<option value=1>Festival</option>
											<option value=2>Convention</option>
											<option value=3>Concert</option>
											<option value=4>Spectacle</option>
											<option value=5>Autre</option>
										</select>
									</div>
								</div>

								<div class="form-group row">
									<label for="descriptionInput" class="col-4 col-form-label">Description</label>
									<div class="col-8">
										<textarea class="form-control" name="description" id="descriptionInput"></textarea>
									</div>
								</div>

								<button type="submit" class="btn btn-outline-success float-right mt-3">Valider</button>
							</form>
						</div>
					</div>
				</div>
			  </div>';
	}

	/*
    public function getPublipage() {
    	echo 'Insérez Nav
    		<br><br><br>

    		<style>
    			.bloc {
    				padding : 5px;
    				border : solid #ff8080;
    				margin-bottom : 10px;
    			}

    			#img {
    				display : inline-block;
    				vertical-align : top;
    				height : 152px;
    				width : 500px;
    			}
    			#details {
    				display : inline-block;

    				width : 500px;
    			}
    			#blocBot {
    				width : 1037px;
	    		}
			}

    		}
    		</style>

			<form method="post" action="index.php?mod=publipost&action=publication">
	      		<div>
	      			<div>
						<div class="bloc" id="img">
							<img id="uploadPreview" style="width: 100px; height: 100px;" />
							<input id="uploadImage" type="file" name="browsePic" onchange="PreviewImage();" />
							<script type="text/javascript">

							    function PreviewImage() {
							        var oFReader = new FileReader();
							        oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);

							        oFReader.onload = function (oFREvent) {
							            document.getElementById("uploadPreview").src = oFREvent.target.result;
							        };
							    };

							</script>
						</div>

		      			<div class="bloc" id="details">
							Nom de l\'Event : <input type="textarea" name="nomEvent"><br>
							Date du début d\'évènement : <input type="date" min="2018-11-30" max="2028-01-01" name="dateDebutEvent"><br>
							Date de fin d\'évènement : <input type="date" min="2018-11-30" max="2028-01-01" name="dateFinEvent"><br>
							Lieu : <input type="textarea" placeholder="Entrez la location de l\'évènement" name="lieu"><br>

							<select name="categorie">
								<option value=1>Festival</option>
								<option value=2>Convention</option>
								<option value=3>Concert</option>
								<option value=4>Spectacle</option>
								<option value=5>Autre</option>
							</select><br>

						</div>
					</div>

					<div id="blocBot">
						<div class="bloc">
							<textarea name="description"></textarea><br>
						</div>

						<div class="bloc">
							<input type="button" value="Annuler">	
							<input type="submit" value="Envoyer">	
						</div>
					</div>
			</form>
			


			
			';
	}
	*/

}

?>