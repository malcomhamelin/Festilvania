<div class="container annonce shadow-sm container-profile">
    <div class="container">
    <form method="post" action="index.php?mod=profile&action=update" enctype="multipart/form-data" id="updateProfil"></form>
        <input type="hidden" value="<?php echo $_SESSION['token'] ?>" form="updateProfil" name="token">
        <div class="row">
            <div class="col-12 col-md-8 profile-inputs">
                <div class="row mt-3">
                    <span class="post-titre ml-5">Profil</span>
                    <hr style="height:2px;border:none;color:white;background-color:grey;" class="mx-auto col-4 col-md-6 col-lg-7">
                </div>

                <div class="col-7 mb-2 mt-4 profile-centered">
                    <input type="text" class="form-control" name="pseudo" value=<?php echo $content['pseudo']?> form="updateProfil"required>  
                </div>
                <div class="col-7 mb-2 profile-centered">
                    <input type="password" class="form-control" name="password" value=<?php echo $content['password']?> form="updateProfil"required>  
                </div>
                <div class="col-7 mb-2 profile-centered">
                    <input type="password" class="form-control" name="password2" value=<?php echo $content['password']?> form="updateProfil"required>
                </div>  
                <div class="col-7 mb-2 profile-centered">
                    <input type="email" class="form-control" name="email" value=<?php echo $content['mail']?> form="updateProfil"required>  
                </div>
                <div class="col-7 mb-2 profile-centered">
                    <input type="date" max="2006-11-16" min="1900-01-01" name="date_anniv" class="form-control"  form="updateProfil" value=<?php echo $content['date_anniv']; ?>required >  
                </div>
                <div class="col-7 mb-2 profile-centered text-center">
                    <input type="radio" class="mx-auto" id="homme" name="sexe" value="homme" <?php echo $content['sexe']=="homme" ? 'checked="checked"' : ""; ?> form="updateProfil">  Homme  
                    <input type="radio" class="mx-auto" id="femme" name="sexe" value="femme" <?php echo $content['sexe']=="femme" ? 'checked="checked"' : ""; ?> form="updateProfil">  Femme  
                    <input type="radio" class="mx-auto" id="autre" name="sexe" value="autre" <?php echo $content['sexe']=="autre" ? 'checked="checked"' : ""; ?> form="updateProfil">  Autres  
                </div>
            </div> 

            <div class="col-10 col-md-3 ml-5 profile-bloc-avatar">
                <div class="row">
                    <div class="mb-4 mx-auto">
                        <img src="<?php echo $_SESSION['avatar']; ?>" alt="avatar profil" id="uploadPreview" class="img-profile">
                    </div>
                </div>
                <div class="mb-4 profile-centered col-12 col-sm-10">
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
            </div>
        </div>
        <div class="row">
            <button type="submit" class="btn btn-warning btn-profile annonce-corps-btn mt-3 mx-auto col-6"  form="updateProfil" >Valider</button>
        </div>
    </div>
</div>
