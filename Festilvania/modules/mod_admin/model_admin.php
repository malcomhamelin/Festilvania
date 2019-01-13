<?php

require_once "generic/model_generic.php";

Class ModelAdmin extends ModelGeneric {

    public function __construct() {

    }

    public function addCategory($rights) {
        if ($rights != null && $rights['droit_admin']) {
            $title = htmlspecialchars($_POST['newCategory']);

            $verification = self::$bdd->prepare("SELECT * FROM categorie WHERE titreCategorie = ?");
            $verification->execute(array($title));

            if (!($verification->fetch())) {
                $req = self::$bdd->prepare("INSERT INTO categorie (titreCategorie) VALUES (?)");
                $req->execute(array($title));
                $_SESSION['addCategory'] = 1;
            }
            else {
                $_SESSION['addCategory'] = 0;
            }
        }
    }

    public function delCategory($rights) {
        if ($rights != null && $rights['droit_admin']) {
            $idCatToDelete = htmlspecialchars($_POST['idCatToDelete']);

            $verification = self::$bdd->prepare("SELECT * FROM evenement WHERE idCategorie = ?");
            $verification->execute(array($idCatToDelete));

            if (!($verification->fetch())) {
                $req = self::$bdd->prepare("DELETE FROM categorie WHERE idCategorie = ?");
                $req->execute(array($idCatToDelete));
                $_SESSION['delCategory'] = 1;
            }
            else {
                $_SESSION['delCategory'] = 0;
            }
        }
    }

    public function addGroup($rights) {
        if ($rights != null && $rights['droit_admin']) {
            $groupName = htmlspecialchars($_POST['groupName']);

            $verification = self::$bdd->prepare("SELECT * FROM groupe WHERE nomGroupe = ?");
            $verification->execute(array($groupName));

            if (!($verification->fetch())) {
                $visu = isset($_POST['visualiser']) ? htmlspecialchars($_POST['visualiser']) : 0;
                $post = isset($_POST['post']) ? htmlspecialchars($_POST['post']) : 0;
                $vote = isset($_POST['vote']) ? htmlspecialchars($_POST['vote']) : 0;
                $comment = isset($_POST['comment']) ? htmlspecialchars($_POST['comment']) : 0;
                $edit = isset($_POST['edit']) ? htmlspecialchars($_POST['edit']) : 0;
                $delete = isset($_POST['delete']) ? htmlspecialchars($_POST['delete']) : 0;
                $admin = isset($_POST['admin']) ? htmlspecialchars($_POST['admin']) : 0;

                $createRights = self::$bdd->prepare("INSERT INTO droits (intituleDroits, droit_visualiser, droit_poster, droit_voter, droit_commenter, droit_editer, droit_supprimer, droit_admin) 
                                            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                $createRights->execute(array($groupName, $visu, $post, $vote, $comment, $edit, $delete, $admin));

                $rightsIDRow = self::$bdd->prepare("SELECT * FROM droits WHERE intituleDroits = ?");
                $rightsIDRow->execute(array($groupName));
                $rightsIDRow = $rightsIDRow->fetch();

                $createGroup = self::$bdd->prepare("INSERT INTO groupe (nomGroupe, idDroits) VALUES (?, ?)");
                $createGroup->execute(array($groupName, $rightsIDRow['idDroits']));

                $_SESSION['addGroup'] = 1;
            }
            else {
                $_SESSION['addGroup'] = 0;
            }
        }
    }

    public function delGroup($rights) {
        if ($rights != null && $rights['droit_admin']) {
            $idGroupToDelete = htmlspecialchars($_POST['idGroupToDelete']);

            $verification = self::$bdd->prepare("SELECT * FROM membre WHERE idGroupe = ?");
            $verification->execute(array($idGroupToDelete));

            if (!($verification->fetch())) {
                $tupleGroupName = self::$bdd->prepare("SELECT * FROM groupe WHERE idGroupe = ?");
                $tupleGroupName->execute(array($idGroupToDelete));
                $tupleGroupName = $tupleGroupName->fetch();

                $delRights = self::$bdd->prepare("DELETE FROM droits WHERE intituleDroits = ?");
                $delRights->execute(array($tupleGroupName['nomGroupe']));

                $req = self::$bdd->prepare("DELETE FROM groupe WHERE idGroupe = ?");
                $req->execute(array($idGroupToDelete));
                $_SESSION['delGroup'] = 1;
            }
            else {
                $_SESSION['delGroup'] = 0;
            }
        }
    }

    public function affectUser($rights) {
        if ($rights != null && $rights['droit_admin']) {
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

}

?>