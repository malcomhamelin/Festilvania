<div class="container">
<div class="row">
    <form method="post" action="index.php?mod=managementpost&action=edition" enctype="multipart/form-data" id="editEvent"></form>
    <div class="col-12 container-publipost annonce">
        <div class="col-9 col-sm-7 col-md-5 col-lg-3 mb-4 mx-auto">
            <img id="uploadPreview" class="img-preview shadow-sm"/>
        </div>
        <div class="col-12 col-sm-6 col-lg-6 mb-4 mx-auto">
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="eventPicture" form="editEvent" id="inputGroupFile04" enctype="multipart/form-data" onchange="PreviewImage();">
                    <label class="custom-file-label" for="inputGroupFile04">Choisir photo...</label>
                    <script type="text/javascript">
                        function PreviewImage() {
                            var oFReader = new FileReader();
                            oFReader.readAsDataURL(document.getElementById("inputGroupFile04").files[0]);

                            oFReader.onload = function (oFREvent) {
                                document.getElementById("uploadPreview").src = oFREvent.target.result;
                            };
                        };

                        $("#inputGroupFile04").on("change",function(){
                            var fileName = $(this).val();
                            $(this).next(".custom-file-label").html(fileName);
                        })
                    </script>
                </div>
            </div>
        </div>
        <?php foreach ($content as $key) { ?>
        <div class="col-lg-8 mx-auto">
                <input type="hidden" name="id" form="editEvent" value="<?php echo $key['idEvenement'];?>">
                <div class="form-group row">
                    <label for="nameInput" class="col-4 col-form-label">Nom</label>
                    <div class="col-8">
                        <input class="form-control" type="text" name="nomEvent" id="nameInput" form="editEvent" value="<?php echo $key['titreEvenement'];?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="dateDebut" class="col-4 col-form-label">Date de début</label>
                    <div class="col-8">
                        <input class="form-control" type="date" name="dateDebutEvent" id="dateDebut" form="editEvent" value="<?php echo $key['date_debut'];?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="dateFin" class="col-4 col-form-label">Date de fin</label>
                    <div class="col-8">
                        <input class="form-control" type="date" name="dateFinEvent" id="dateFin" form="editEvent" value="<?php echo $key['date_fin'];?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="locationInput" class="col-4 col-form-label">Lieu</label>
                    <div class="col-8">
                        <input class="form-control" type="text" name="lieu" id="locationInput" form="editEvent" value="<?php echo $key['lieu'];?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="categories" class="col-4 col-form-label">Type</label>
                    <div class="col-8">
                        <select class="col-12 form-control" name="categorie" id="categories" form="editEvent">
                            <?php $this->getOptions($categories); ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="descriptionInput" class="col-4 col-form-label">Description</label>
                    <div class="col-8">
                        <textarea class="form-control" name="description" id="descriptionInput" form="editEvent"><?php echo $key['description'];?></textarea>
                    </div>
                </div>
                <?php if ($rights != null && $rights['droit_supprimer']) { ?>
                <div class="form-group row">
                    <label for="locationInput" class="col-4 col-form-label">Le publier ?</label>
                    <div class="col-8">
                        <input class="form-control" type="checkbox" name="publish" id="publishInput" form="editEvent" value="1">
                    </div>
                </div>
                <?php } ?>

                <?php if ($rights != null && $rights['droit_supprimer']) { ?>
                <form method="post" action="index.php?mod=managementpost&action=delete" enctype="multipart/form-data" id="delEvent">
                    <input type="hidden" name="idDel" form="delEvent" value="<?php echo $key['idEvenement'];?>">
                    <button type="submit" class="btn btn-outline-danger float-left mt-3">Supprimer</button>
                </form>
                <?php } ?>
                <button type="submit" class="btn btn-outline-success float-right mt-3" form="editEvent">Valider</button>
        </div>
        <?php } ?>
    </div>
</div>
</div>
