<div class="container annonce shadow-sm container-profile">
    <div class="container">
    <form method="post" action="index.php?mod=profile&action=update" enctype="multipart/form-data" id="updateProfil"></form>
        <div class="col-3 col-sm-2 col-md-2 col-lg-1 mb-4 mx-auto">
            <img src="<?php echo $_SESSION['avatar']; ?>" alt="avatar profil" id="uploadPreview" class="img-profile">
        </div>
        <div class="col-xs-1 col-sm-6 col-md-5 col-lg-4 mb-4 profile-centered">
            <div class="input-group">
                <div class="custom-file">
                    
                        <input type="file" class="custom-file-input" name="avatar" id="inputGroupFile04" form="updateProfil" enctype="multipart/form-data" onchange="PreviewImage();"  >
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
        <div class="col-xs-1 col-sm-6 col-md-5 col-lg-4 mb-2 profile-centered">
            <input type="text" class="form-control" name="pseudo" value=<?php echo $content['pseudo']?> form="updateProfil">  
        </div>
        <div class="col-xs-1 col-sm-6 col-md-5 col-lg-4 mb-2 profile-centered">
            <input type="password" class="form-control" name="password" value=<?php echo $content['password']?> form="updateProfil">  
        </div>
        <div class="col-xs-1 col-sm-6 col-md-5 col-lg-4 mb-2 profile-centered">
            <input type="password" class="form-control" name="password2" value=<?php echo $content['password']?> form="updateProfil">
        </div>  
        <div class="col-xs-1 col-sm-6 col-md-5 col-lg-4 mb-2 profile-centered">
            <input type="email" class="form-control" name="email" value=<?php echo $content['mail']?> form="updateProfil">  
        </div>
        <div class="col-xs-1 col-sm-6 col-md-5 col-lg-4 mb-2 profile-centered">
            <input type="radio"  id="homme" name="sexe" value="homme" <?php echo $homme?> form="updateProfil">  Homme 
            <input type="radio"  id="femme" name="sexe" value="femme" <?php echo $femme?> form="updateProfil">  Femme 
            <input type="radio"  id="autre" name="sexe" value="autre" <?php echo $autre?> form="updateProfil">  Autres 
        </div>
        <div class="col-xs-1 col-sm-6 col-md-5 col-lg-4 mb-2 profile-centered">
            <input type="date" max="2006-11-16" min="1900-01-01" name="date_anniv" class="form-control"  form="updateProfil" value=<?php echo $content['date_anniv']?> >  
        </div>
        <div class="col-xs-1 col-sm-6 col-md-5 col-lg-4 mb-5 profile-centered">
            <button type="submit" class="btn btn-outline-success float-right mt-3"  form="updateProfil" >Valider</button>  
        </div> 
    </div>
</div>
