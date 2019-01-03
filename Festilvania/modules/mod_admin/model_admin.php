<?php

require_once "connection.php";

Class ModelAdmin extends Connection {

    public function __construct() {

    }

    public function addCategory() {
        $title = htmlspecialchars($_POST['newCategory']);

        $req = self::$bdd->prepare("INSERT INTO categorie (titreCategorie) VALUES (?)");
        $req->execute(array($title));
    }

    public function delCategory() {
        $idGroupToDelete = htmlspecialchars($_POST['idCatToDelete']);

        $req = self::$bdd->prepare("DELETE FROM categorie WHERE idCategorie = ?");
        $req->execute(array($idGroupToDelete));
    }

    public function addGroup() {
        $groupName = htmlspecialchars($_POST['groupName']);
        $visu = isset($_POST['visualiser']) ? htmlspecialchars($_POST['visualiser']) : 0;
        $post = isset($_POST['post']) ? htmlspecialchars($_POST['post']) : 0;
        $vote = isset($_POST['vote']) ? htmlspecialchars($_POST['vote']) : 0;
        $comment = isset($_POST['comment']) ? htmlspecialchars($_POST['comment']) : 0;
        $edit = isset($_POST['edit']) ? htmlspecialchars($_POST['edit']) : 0;
        $delete = isset($_POST['delete']) ? htmlspecialchars($_POST['delete']) : 0;

        $createRights = self::$bdd->prepare("INSERT INTO droits (intituleDroits, droit_visualiser, droit_poster, droit_voter, droit_commenter, droit_editer, droit_supprimer) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?)");
        $createRights->execute(array($groupName, $visu, $post, $vote, $comment, $edit, $delete));

        $rightsIDRow = self::$bdd->prepare("SELECT * FROM droits WHERE intituleDroits = ?");
        $rightsIDRow->execute(array($groupName));
        $rightsIDRow = $rightsIDRow->fetch();

        $createGroup = self::$bdd->prepare("INSERT INTO groupe (nomGroupe, idDroits) VALUES (?, ?)");
        $createGroup->execute(array($groupName, $rightsIDRow['idDroits']));
    }

    public function delGroup() {
        $idGroupToDelete = htmlspecialchars($_POST['idGroupToDelete']);

        $req = self::$bdd->prepare("DELETE FROM groupe WHERE idGroupe = ?");
        $req->execute(array($idGroupToDelete));
    }

    public function affectUser() {
        $userToAffect = htmlspecialchars($_POST['userToAffect']);
        $groupSelected = htmlspecialchars($_POST['groupSelected']);

        $reqUser = self::$bdd->prepare("SELECT * FROM membre WHERE pseudo = ?");
        $reqUser->execute(array($userToAffect));
        
        if ($tupleUser = $reqUser->fetch()) {
            $affectGroup = self::$bdd->prepare("UPDATE membre SET idGroupe = ? WHERE idMembre = ?");
            $affectGroup->execute(array($groupSelected, $tupleUser['idMembre']));
        } 
    }

}

?>