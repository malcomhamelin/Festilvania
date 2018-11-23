<?php

Class ModelProfile {

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
        }
    }   

}

?>