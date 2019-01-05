<div class="container">
<div class="row">
    <form method="post" action="index.php?mod=managementpost&action=publication" enctype="multipart/form-data" id="postEvent"></form>
    <div class="col-12 container-publipost annonce">
        <div class="col-9 col-sm-7 col-md-5 col-lg-3 mb-4 mx-auto">
            <img id="uploadPreview" class="img-preview shadow-sm"/>
        </div>
        <div class="col-12 col-sm-6 col-lg-6 mb-4 mx-auto">
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="eventPicture" form="postEvent" id="inputGroupFile04" enctype="multipart/form-data" onchange="PreviewImage();">
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
        <div class="col-lg-8 mx-auto">
                <div class="form-group row">
                    <label for="nameInput" class="col-4 col-form-label">Nom</label>
                    <div class="col-8">
                        <input class="form-control" type="text" name="nomEvent" id="nameInput" form="postEvent">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="dateDebut" class="col-4 col-form-label">Date de début</label>
                    <div class="col-8">
                        <input class="form-control" type="date" name="dateDebutEvent" id="dateDebut" form="postEvent">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="dateFin" class="col-4 col-form-label">Date de fin</label>
                    <div class="col-8">
                        <input class="form-control" type="date" name="dateFinEvent" id="dateFin" form="postEvent">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="locationInput" class="col-4 col-form-label">Lieu</label>
                    <div class="col-8">
                        <input class="form-control" type="text" name="lieu" id="locationInput" form="postEvent">
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="categories" class="col-4 col-form-label">Type</label>
                    <div class="col-8">
                        <select class="col-12 form-control" name="categorie" id="categories" form="postEvent">
                            <?php $this->getOptions($categories); ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="descriptionInput" class="col-4 col-form-label">Description</label>
                    <div class="col-8">
                        <textarea class="form-control" name="description" id="descriptionInput" form="postEvent"></textarea>
                    </div>
                </div>

                <button type="submit" class="btn btn-outline-success float-right mt-3" form="postEvent">Valider</button>
        </div>
    </div>
</div>
</div>
