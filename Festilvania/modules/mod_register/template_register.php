<div class="container">
<div class="row">
    <div class="col-12 container-publipost annonce">
        <form method="post" action="index.php?mod=register&action=register">
            <div class="col-3 col-sm-2 col-md-2 col-lg-1 mb-4 mx-auto">
                <img id="uploadPreview" src="img/avatars/user.png" style="width : 64px; height : auto; border-radius : 100%;"/>
            </div>
            <div class="col-xs-1 col-sm-6 col-md-5 col-lg-4 mb-4 profile-centered">
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="avatar" id="inputGroupFile04" enctype="multipart/form-data" onchange="PreviewImage();">
                        <label class="custom-file-label" for="inputGroupFile04">Choisir avatar</label>
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
                    <label for="nameInput" class="col-4 col-form-label">Pseudo</label>
                    <div class="col-8">
                        <input class="form-control" type="text" name="pseudo" id="nameInput">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="passwordInput" class="col-4 col-form-label">Mot de passe</label>
                    <div class="col-8">
                        <input class="form-control" type="text" name="password" id="passwordInput">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="confirmationInput" class="col-4 col-form-label">Confirmation</label>
                    <div class="col-8">
                        <input class="form-control" type="text" name="password2" id="confirmationInput">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="mailInput" class="col-4 col-form-label">E-mail</label>
                    <div class="col-8">
                        <input class="form-control" type="email" name="email" id="emailInput">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="annivDebut" class="col-4 col-form-label">Date d'anniversaire</label>
                    <div class="col-8">
                        <input class="form-control" type="date" name="anniversaire" id="dateAnniversaire" max="2006-11-16" min="1900-01-01">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="sexe" class="col-4 col-form-label">Sexe</label>
                    <div class="col-8">
                        <select class="col-12 form-control" name="sexe" id="categories">
                            <option value="hommme">Homme</option>
                            <option value="femme">Femme</option>
                            <option value="autre">Autre</option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-success float-right mt-3">Valider</button>
            </div>
        </form>
    </div>
</div>
</div>