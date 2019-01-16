<div class="container">
<div class="row">
    <div class="col-12 container-publipost annonce">
        <form method="post" action="index.php?mod=register&action=register" id="registerForm">
            <input type="hidden" value="<?php echo $_SESSION['token'] ?>" form="registerForm" name="token">
            <div class="row">
                <div class="col-12 profile-inputs">
                    <div class="row mt-3 ml-5">
                        <span class="post-titre ml-5">Inscription</span>
                        <hr style="height:2px;border:none;color:white;background-color:grey;" class="mx-auto col-5 col-md-7 col-lg-8">
                    </div>

                    <div class="col-7 mb-2 mt-4 profile-centered">
                        <input type="text" class="form-control" name="pseudo" placeholder="Pseudonyme" maxlength="32" required>  
                    </div>
                    <div class="col-7 mb-2 profile-centered">
                        <input type="password" class="form-control" name="password" placeholder="Mot de passe" maxlength="256" required>  
                    </div>
                    <div class="col-7 mb-2 profile-centered">
                        <input type="password" class="form-control" name="password2" placeholder="Confirmer mot de passe" maxlength="256" required>
                    </div>  
                    <div class="col-7 mb-2 profile-centered">
                        <input type="email" class="form-control" name="email" placeholder="Adresse email" maxlength="128" required>  
                    </div>
                    <div class="col-7 mb-2 profile-centered">
                        <input type="date" max="2006-11-16" min="1900-01-01" name="date_anniv" class="form-control"required>  
                    </div>
                    <div class="col-7 mb-2 profile-centered text-center">
                        <input type="radio" class="mx-auto" id="homme" name="sexe" value="homme">  Homme  
                        <input type="radio" class="mx-auto" id="femme" name="sexe" value="femme">  Femme  
                        <input type="radio" class="mx-auto" id="autre" name="sexe" value="autre">  Autres  
                    </div>
                </div>
            </div>

            <div class="row">
                <button type="submit" class="btn btn-warning btn-register annonce-corps-btn mt-5 mx-auto col-4">S'inscrire</button>
            </div>
        </form>
    </div>
</div>
</div>