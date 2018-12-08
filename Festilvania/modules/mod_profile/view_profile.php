<?php

require_once "tampon/view_generic.php";

Class ViewProfile extends ViewGeneric {

    public function __construct() {
        parent::__construct();
    }

    public function getProfile() {
        echo '<div class="container annonce shadow-sm container-profile">
                <div class="container">
                    <div class="col-xs-1 col-sm-1 col-md-1 mb-4 profile-centered">
                        <img src="' . $_SESSION['avatar'] . '" alt="" class="img-profile">
                    </div>
                    <div class="col-xs-1 col-sm-6 col-md-5 col-lg-4 mb-4 profile-centered">
                        <div class="input-group">
                            <div class="custom-file">
                                <form action="index.php?mod=' . $_SESSION['mod'] . '&action=uploadAvatar" method="post" id="upload" enctype="multipart/form-data">
                                    <input type="file" class="custom-file-input" name="avatar" id="inputGroupFile04" enctype="multipart/form-data">
                                    <label class="custom-file-label" for="inputGroupFile04">Choisir avatar</label>
                                    <script>
                                        $("#inputGroupFile04").on("change",function(){
                                            var fileName = $(this).val();
                                            $(this).next(".custom-file-label").html(fileName);
                                        })
                                    </script>
                                </form>
                            </div>
                            <div class="input-group-append">
                                <button class="btn btn-secondary" type="submit" form="upload">Valider</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-1 col-sm-6 col-md-5 col-lg-3 mb-2 profile-centered">
                        <input type="text" class="form-control" placeholder="Pseudonyme">  
                    </div>
                    <div class="col-xs-1 col-sm-6 col-md-5 col-lg-3 mb-2 profile-centered">
                        <input type="text" class="form-control" placeholder="Mot de passe">  
                    </div>
                    <div class="col-xs-1 col-sm-6 col-md-5 col-lg-3 mb-2 profile-centered">
                        <input type="text" class="form-control" placeholder="Confirmer mot de passe">  
                    </div>  
                    <div class="col-xs-1 col-sm-6 col-md-5 col-lg-3 mb-2 profile-centered">
                        <input type="text" class="form-control" placeholder="Adresse e-mail">  
                    </div>
                    <div class="col-xs-1 col-sm-6 col-md-5 col-lg-3 mb-2 profile-centered">
                        <input type="text" class="form-control" placeholder="Confirmer adresse e-mail">  
                    </div>
                    <div class="col-xs-1 col-sm-6 col-md-5 col-lg-3 mb-5 profile-centered">
                        <button class="btn btn-success float-right" type="button">Valider</button>  
                    </div>                     
                </div>
             </div';
    }

}

?>