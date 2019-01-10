<div class="container annonce shadow-sm container-profile">
    <div class="container">
        <div class="col-3 col-sm-2 col-md-2 col-lg-1 mb-4 mx-auto">
            <img src="<?php echo $_SESSION['avatar']; ?>" alt="avatar profil" id="uploadPreview" class="img-profile">
        </div>
        <div class="col-xs-1 col-sm-6 col-md-5 col-lg-4 mb-4 profile-centered">
            <div class="input-group">
                <div class="custom-file">
                    <form action="index.php?mod=<?php echo $_SESSION['mod']; ?>&action=uploadAvatar" method="post" id="upload" enctype="multipart/form-data">
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
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xs-1 col-sm-6 col-md-5 col-lg-4 mb-2 profile-centered">
            <input type="text" class="form-control" name="pseudo" placeholder="Pseudonyme">  
        </div>
        <div class="col-xs-1 col-sm-6 col-md-5 col-lg-4 mb-2 profile-centered">
            <input type="password" class="form-control" name="password" placeholder="Mot de passe">  
        </div>
        <div class="col-xs-1 col-sm-6 col-md-5 col-lg-4 mb-2 profile-centered">
            <input type="password" class="form-control" name="password2" placeholder="Confirmer mot de passe">  
        </div>  
        <div class="col-xs-1 col-sm-6 col-md-5 col-lg-4 mb-2 profile-centered">
            <input type="email" class="form-control" name="email" placeholder="Adresse e-mail">  
        </div>
        <div class="col-xs-1 col-sm-6 col-md-5 col-lg-4 mb-2 profile-centered">
            <input type="radio"  id="homme" name="sexe" value="homme" >  Homme 
            <input type="radio"  id="femme" name="sexe" value="femme" >  Femme 
            <input type="radio"  id="autre" name="sexe" value="autre" >  Autres 
        </div>
        <div class="col-xs-1 col-sm-6 col-md-5 col-lg-4 mb-2 profile-centered">
            <input type="date" max="2006-11-16" min="1900-01-01" class="form-control" name="date_anniv" placeholder="Date de naissances">  
        </div>
        <div class="col-xs-1 col-sm-6 col-md-5 col-lg-4 mb-5 profile-centered">
            <button class="btn btn-success float-right" type="button">Valider</button>  
        </div>                     
    </div>
</div>

