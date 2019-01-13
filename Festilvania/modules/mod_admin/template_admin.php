<?php $this->popUpCheck(); ?>

<div class="container">
    <div class="row">
        <div class="col-12 container-publipost annonce">
        <div class="row mt-3">
            <span class="post-titre ml-5">Administration</span>
            <hr style="height:2px;border:none;color:grey;background-color:grey;" class="mx-auto col-5 col-md-8 col-lg-9">
        </div>

        <div class="row">

            <div class="col-12 col-md-6">

                <div class="row mt-3">
                    <span class="post-titre ml-5">Catégories</span>
                    <hr style="height:2px;border:none;color:grey;background-color:grey;" class="mx-auto col-3 col-md-5 col-lg-6">
                </div>

                <div class="row">
                    <div class="col-6 mx-auto">
                        <div class="input-group my-4">
                            <form action="index.php?mod=admin&action=addCategory" method="post" id="addCat" onsubmit=""></form>
                            <input type="text" class="form-control" id="inlineFormInputGroup" form="addCat" name="newCategory" required minlength="3" placeholder="Titre de la catégorie">
                            <input type="hidden" value="<?php echo $_SESSION['token'] ?>" form="addCat" name="token">
                            <div class="input-group-append">
                                <button class="btn btn-success ml-0" form="addCat">
                                    Ajouter
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6 mx-auto">
                        <div class="input-group my-4">
                            <form action="index.php?mod=admin&action=delCategory" method="post" id="delCat"></form>
                            <select class="col-7" name="idCatToDelete" form="delCat" id="delCategory">
                                <?php $this->getOptionsCat($categories); ?>
                            </select>
                            <input type="hidden" value="<?php echo $_SESSION['token'] ?>" form="delCat" name="token">
                            <div class="input-group-append">
                                <button class="btn btn-danger ml-0" form="delCat">
                                    Supprimer
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6">

                <div class="row mt-3">
                    <span class="post-titre ml-5">Groupes</span>
                    <hr style="height:2px;border:none;color:grey;background-color:grey;" class="mx-auto col-3 col-md-5 col-lg-6">
                </div>

                <div class="row">

                    <div class="row col-12">
                        <div class="col-6 mx-auto"> 
                            <form action="index.php?mod=admin&action=addGroup" method="post" id="addGroup"></form>
                            <input type="hidden" value="<?php echo $_SESSION['token'] ?>" form="addGroup" name="token">

                            <input type="text" class="form-control mx-auto mt-3" form="addGroup" name="groupName" id="inlineFormInputGroup" required minlength="3" placeholder="Nom du groupe">
                        </div>
                    </div>

                    <div class="row col-10 mx-auto mt-3">

                        <div class="col-2 profile-centered font-weight-bold" style="color:grey;">
                            Droits
                        </div>
                    
                        <div class="col-10 mx-auto">

                            <div class="form-check form-check-inline col-4">
                                <input class="form-check-input" type="checkbox" name="visualiser" form="addGroup" value="1" id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1">
                                    Visualiser
                                </label>
                            </div>

                            <div class="form-check form-check-inline col-4">
                                <input class="form-check-input" type="checkbox" name="post" form="addGroup" value="1" id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1">
                                    Poster
                                </label>
                            </div>

                            <div class="form-check form-check-inline col-4">
                                <input class="form-check-input" type="checkbox" name="vote" form="addGroup" value="1" id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1">
                                    Voter
                                </label>
                            </div>
                            
                            <div class="form-check form-check-inline col-4">
                                <input class="form-check-input" type="checkbox" name="comment" form="addGroup" value="1" id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1">
                                    Commenter
                                </label>
                            </div>

                            <div class="form-check form-check-inline col-4">
                                <input class="form-check-input" type="checkbox" name="edit" form="addGroup" value="1" id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1">
                                    Editer
                                </label>
                            </div>

                            <div class="form-check form-check-inline col-4">
                                <input class="form-check-input" type="checkbox" name="delete" form="addGroup" value="1" id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1">
                                    Supprimer
                                </label>
                            </div>

                            <div class="form-check form-check-inline col-4">
                                <input class="form-check-input" type="checkbox" name="admin" form="addGroup" value="1" id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1">
                                    Administration
                                </label>
                            </div>

                            <div class="pb-5 mt-3 col-9 mx-auto">
                                <button class="btn btn-success" form="addGroup">
                                    Créer ce groupe
                                </button>
                            </div>

                        </div>
                    
                    </div>
             
                </div>

                <div class="row">

                    <div class="mx-auto">
                        <div class="input-group my-4">
                            <form action="index.php?mod=admin&action=delGroup" method="post" id="delGrp"></form>
                            <input type="hidden" value="<?php echo $_SESSION['token'] ?>" form="delGrp" name="token">
                            <select class="col-6" name="idGroupToDelete" form="delGrp" id="idGroupToDelete">
                                <?php $this->getOptionsGroups($groups); ?>
                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-danger ml-0" form="delGrp">
                                    Supprimer
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
                
            </div>
        
        </div>

        <div class="row">

            <div class="col-12 col-md-6">

                <div class="row mt-3">
                    <span class="post-titre ml-5">Affecter un membre</span>
                    <hr style="height:2px;border:none;color:grey;background-color:grey;" class="mx-auto col-3 col-md-5 col-lg-6">
                </div>

                <div class="col-10 mx-auto mt-3">
                    <div class="form-row">
                        
                        <form action="index.php?mod=admin&action=affectUser" method="post" id="affectUser"></form>
                        <input type="hidden" value="<?php echo $_SESSION['token'] ?>" form="affectUser" name="token">

                        <div class="form-group col-6">
                            <input type="text" class="form-control" form="affectUser" name="userToAffect" id="inputCity" required minlength="3" placeholder="Pseudonyme">
                        </div>
                        <div class="form-group col-6">
                            <select id="inputState" name="groupSelected" form="affectUser" class="form-control">
                                <option selected>Groupe</option>
                                <?php $this->getOptionsGroups($groups); ?>
                            </select>
                        </div>
                    </div>

                    <button class="btn btn-success float-right" form="affectUser">
                            Affecter
                    </button>
                </div>

            </div>
        
        </div>

    </div>
    
</div>
