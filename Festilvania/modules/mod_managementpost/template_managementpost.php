<div class="container">
<div class="row">
    <form method="post" action="index.php?mod=managementpost&action=<?php $this->getAction();?>" enctype="multipart/form-data" id="editEvent"></form>
    <input type="hidden" value="<?php echo $_SESSION['token'] ?>" form="editEvent" name="token">
    
    <div class="col-12 container-publipost annonce">
        <div class="row">

            <div class="col-10 col-md-4 ml-5 managementpost-bloc-photo">
                <div class="col-10 mb-4 mx-auto">
                    <img id="uploadPreviewManagement" src="<?php echo $content['lienImage']; ?>" class="img-preview shadow-sm"/>
                </div>
                <div class="col-12 col-sm-6 col-lg-9 mb-4 mx-auto">
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="eventPicture" form="editEvent" id="inputGroupFile04" enctype="multipart/form-data" onchange="PreviewImage();" <?php $this->addRequired();?>>
                            <label class="custom-file-label" for="inputGroupFile04">Choisir photo...</label>
                            <script type="text/javascript">
                                function PreviewImage() {
                                    var oFReader = new FileReader();
                                    oFReader.readAsDataURL(document.getElementById("inputGroupFile04").files[0]);

                                    oFReader.onload = function (oFREvent) {
                                        document.getElementById("uploadPreviewManagement").src = oFREvent.target.result;
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
            </div>

            <div class="col-12 col-md-7 managementpost-inputs">
                <div class="row mt-3">
                    <?php $this->getTitlePage(); ?>
                    <hr style="height:2px;border:none;color:white;background-color:grey;" class="mx-auto col-4 col-md-6 col-lg-7">
                </div>

                <div class="col-12 col-md-8 mt-3 mx-auto">
                    <input type="hidden" name="id" form="editEvent" value="<?php $this->getDefaultValue($content, 'idEvenement');?>">
                    <div class="form-group row">
                        <label for="nameInput" class="col-4 col-form-label">Nom</label>
                        <div class="col-8">
                            <input class="form-control" minlength=3 type="text" name="nomEvent" id="nameInput" form="editEvent" value="<?php $this->getDefaultValue($content, 'titreEvenement');?>" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="dateDebut" class="col-4 col-form-label">Date de début</label>
                        <div class="col-8">
                            <input class="form-control" type="date" min=<?php echo date("Y-m-d"); ?> name="dateDebutEvent" id="dateDebut" form="editEvent" value="<?php $this->getDefaultValue($content, 'date_debut');?>" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="dateFin" class="col-4 col-form-label">Date de fin</label>
                        <div class="col-8">
                            <input class="form-control" type="date" min=<?php echo date("Y-m-d"); ?> name="dateFinEvent" id="dateFin" form="editEvent" value="<?php $this->getDefaultValue($content, 'date_fin');?>"
                            required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="locationInput" class="col-4 col-form-label">Lieu</label>
                        <div class="col-8">
                            <input class="form-control" minlength=3 type="text" name="lieu" id="locationInput" form="editEvent" value="<?php $this->getDefaultValue($content, 'lieu');?>" required>
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
                            <textarea class="form-control" minlength=50 name="description" id="descriptionInput" form="editEvent" required><?php $this->getDefaultValue($content, 'description');?></textarea>
                        </div>
                    </div>

                    <?php $this->getButtonPublish($rights) ?>

                </div>
                
            </div> 
            
        </div>

        <div class="row">
            <button type="submit" class="btn btn-warning btn-profile annonce-corps-btn mt-3 mx-auto col-6"  form="editEvent">Valider</button>
        </div>

        <div class="row">
            <?php $this->getButtonDelete($rights) ?>
        </div>

    </div>
</div>
</div>
