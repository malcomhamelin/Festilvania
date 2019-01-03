<div class="container">
    <div class="row">
        <div class="col-12 container-publipost annonce">
            <h1 class="text-center">Administration</h1>

            <h2 class="text-center mt-5">Ajouter une catégorie</h2>

            <div class="col-6 mx-auto">
                <div class="input-group my-4">
                    <form action="index.php?mod=admin&action=addCategory" method="post" id="addCat"></form>
                    <input type="text" class="form-control" id="inlineFormInputGroup" form="addCat" name="newCategory" placeholder="Titre de la catégorie">
                    <div class="input-group-append">
                        <button class="btn btn-success ml-0" form="addCat">
                            Ajouter
                        </button>
                    </div>
                </div>
            </div>

            <hr>

            <h2 class="text-center">Supprimer une catégorie</h2>

            <div class="col-7 mx-auto">
                <div class="input-group my-4">
                    <form action="index.php?mod=admin&action=delCategory" method="post" id="delCat"></form>
                    <select class="col-10" name="idToDelete" form="delCat" id="delCategory">
                        <?php $this->getOptionsCat($categories); ?>
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-danger ml-0" form="delCat">
                            Supprimer
                        </button>
                    </div>
                </div>
            </div>

            <hr>

            <h2 class="text-center">Ajouter un groupe</h2>

            <div class="col-8 mx-auto">

                <form action="index.php?mod=admin&action=addGroup" method="post" id="addGroup"></form>

                <div class="row">
                    <input type="text" class="form-control col-3 mx-auto mt-3" form="addGroup" name="groupName" id="inlineFormInputGroup" placeholder="Nom du groupe">
                </div>

                <h4 class="text-center mt-3">Droits</h4>
                <div class="form-check col-1 mx-auto mt-2">
                    <input class="form-check-input" type="checkbox" name="visualiser" form="addGroup" value="1" id="defaultCheck1">
                    <label class="form-check-label" for="defaultCheck1">
                        Visualiser
                    </label>
                </div>
                <div class="form-check col-1 mx-auto">
                    <input class="form-check-input" type="checkbox" name="post" form="addGroup" value="1" id="defaultCheck1">
                    <label class="form-check-label" for="defaultCheck1">
                        Poster
                    </label>
                </div>
                <div class="form-check col-1 mx-auto">
                    <input class="form-check-input" type="checkbox" name="vote" form="addGroup" value="1" id="defaultCheck1">
                    <label class="form-check-label" for="defaultCheck1">
                        Voter
                    </label>
                </div>
                <div class="form-check col-1 mx-auto">
                    <input class="form-check-input" type="checkbox" name="comment" form="addGroup" value="1" id="defaultCheck1">
                    <label class="form-check-label" for="defaultCheck1">
                        Commenter
                    </label>
                </div>
                <div class="form-check col-1 mx-auto">
                    <input class="form-check-input" type="checkbox" name="edit" form="addGroup" value="1" id="defaultCheck1">
                    <label class="form-check-label" for="defaultCheck1">
                        Editer
                    </label>
                </div>
                <div class="form-check col-1 mx-auto">
                    <input class="form-check-input" type="checkbox" name="delete" form="addGroup" value="1" id="defaultCheck1">
                    <label class="form-check-label" for="defaultCheck1">
                        Supprimer
                    </label>
                </div>
                <div class="container pb-5">
                    <button class="btn btn-success float-right" form="addGroup">
                        Créer ce groupe
                    </button>
                </div>
            </div>

            <hr>

            <h2 class="text-center">Supprimer un groupe</h2>

            <div class="col-7 mx-auto">
                <div class="input-group my-4">
                    <form action="index.php?mod=admin&action=delGroup" method="post" id="delGrp"></form>
                    <select class="col-10" name="idGroupToDelete" form="delGrp" id="idGroupToDelete">
                        <?php $this->getOptionsGroups($groups); ?>
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-danger ml-0" form="delGrp">
                            Supprimer
                        </button>
                    </div>
                </div>
            </div>

            <hr>

            <h2 class="text-center">Affecter un membre à un groupe</h2>

            <div class="col-6 mx-auto">
                <div class="form-row">
                    
                    <form action="index.php?mod=admin&action=affectUser" method="post" id="affectUser"></form>

                    <div class="form-group col-6">
                        <input type="text" class="form-control" form="affectUser" name="userToAffect" id="inputCity" placeholder="Pseudonyme">
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
