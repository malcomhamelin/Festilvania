<?php

require_once "connection.php";

Class ModelProfile extends Connection {

    private $MAX_FILE_SIZE = 1048576;
    private $VALID_EXTENSIONS = array('jpg', 'jpeg', 'gif', 'png');

    public function __contruct() {

    }

    public function uploadAvatar() {
        if ($_FILES['avatar']['error'] == 0) {
            if ($_FILES['avatar']['size'] <= $this->MAX_FILE_SIZE) {
                $upload_extension = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1) );
    
                if (in_array($upload_extension, $this->VALID_EXTENSIONS)) {
                    $chemin = 'img/avatars/' . $_SESSION['pseudo'] . '.' . $upload_extension;
                    $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);

                    if ($resultat) {
                        $insertAvatar = Connection::$bdd->prepare("UPDATE membre SET avatar = ? WHERE pseudo = ?");
                        $insertAvatar->execute(array($chemin, $_SESSION['pseudo']));
                        $_SESSION['avatar'] = $chemin;
                    }
                }
            }
            else {
                echo '<script> avatarTooBig(); </script>';
            }
        }
        else {
            echo '<script> avatarError(); </script>';
        }
    }   

    public function basedate(){
        $pastdata =self::$bdd->prepare("SELECT * from membre where membre.idMembre=:id");
        $pastdata->bindParam(':id', $_SESSION['idMembre']);
        $pastdata->execute();
        $tab=$pastdata->fetch();
        return $tab;
    }
    
    public function is_clean($string) {
       return preg_match("/^[\w\-]+$/", $string);

       //"/^[a-zA-Z0-9.!#$%&'*+=?^_`{|}~-]\\s/"
    }

    public function is_email($string) {
        return preg_match("/^[a-zA-Z0-9.!#$%&'*+=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/", $string);
    }

    public function update() {
       
        //variable
        if (isset($_POST['pseudo']) && strlen($_POST['pseudo']) > 3) {
            $pseudo = htmlspecialchars($_POST['pseudo']);

            if ($this->is_clean($_POST['pseudo'])) {
                $reqPseudoChange = self::$bdd->prepare("UPDATE membre SET pseudo = ? WHERE idMembre = ?");
                $reqPseudoChange->execute(array($pseudo, $_SESSION['idMembre']));
            }
            else {
                echo '<script> specialCharsPseudo(); </script>';
            }
        }
        
        if (isset($_POST['email']) && $this->is_email($_POST['email'])) {
            $email = htmlspecialchars($_POST['email']); 
            
            $reqMailChange = self::$bdd->prepare("UPDATE membre SET mail = ? WHERE idMembre = ?");
            $reqMailChange->execute(array($email, $_SESSION['idMembre']));
        } 

        if (isset($_POST['oldPassword']) && isset($_POST['password']) && isset($_POST['password2'])
            && strlen($_POST['oldPassword']) > 4 && strlen($_POST['password']) > 4 && strlen($_POST['password2']) > 4) {
            $password = htmlspecialchars($_POST['password']); 
            $passHash = password_hash($password, PASSWORD_DEFAULT);

            if(password_verify($_POST['oldPassword'], $_SESSION['membre']['password'])) {
                if ($_POST['password'] == $_POST['password2']) {
                    $reqPasswordChange = self::$bdd->prepare("UPDATE membre SET password = ? WHERE idMembre = ?");
                    $reqPasswordChange->execute(array($passHash, $_SESSION['idMembre']));
                }
                else {
                    echo '<script> mismatchNewPassword(); </script>';
                }
            }
            else {
                echo '<script> mismatchOldPassword(); </script>';
            }
        } 

        if (isset($_POST['sexe'])) { 
            $sexe = $_POST['sexe']; 

            $reqSexChange = self::$bdd->prepare("UPDATE membre SET sexe = ? WHERE idMembre = ?");
            $reqSexChange->execute(array($sexe, $_SESSION['idMembre']));
        } 

        if (isset($_POST['date_anniv']) && !empty($_POST['date_anniv'])) {
            $anniversaire = $_POST['date_anniv']; 
            
            $reqAnnivChange = self::$bdd->prepare("UPDATE membre SET date_anniv = ? WHERE idMembre = ?");
            $reqAnnivChange->execute(array($anniversaire, $_SESSION['idMembre']));
        }

        if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0) {
            $this->uploadAvatar();
        }
        
    }
}
?>
