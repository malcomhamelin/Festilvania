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
       return ! (preg_match("/[^a-z\d_-] /i", $string));
       
    }
    public function is_email($string){
        return preg_match("/^[a-zA-Z0-9.!#$%&'*+=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/", $string);
    }
    public function update(){
       
        //variable
        if (isset($_POST['pseudo'])) {
            $pseudo = $_POST['pseudo']; }
        
        if (isset($_POST['email'])) {
            $email = $_POST['email']; } 

        if (isset($_POST['password'])) {
            $password = $_POST['password']; } 

        if (isset($_POST['password2'])) {
            $password2 = $_POST['password2']; } 

        if (isset($_POST['sexe'])) { 
            $sexe = $_POST['sexe']; } 

        if (isset($_POST['date_anniv'])) {
            $anniversaire = $_POST['date_anniv']; } 


        if(isset($_POST['pseudo'])&&isset($_POST['email'])&&isset($_POST['password'])&&isset($_POST['sexe'])&&isset($_POST['date_anniv'])){
            if(self::is_clean($pseudo)&&self::is_email($email)&&self::is_clean($password)&&self::is_clean($password2)){
                if($password==$password2){
                    $verifEmailunique =self::$bdd->prepare("SELECT count(*) from membre where membre.mail=:mail");
                    $verifEmailunique->bindParam(':mail', $email);
                    $verifEmailunique->execute();
                    $tab=$verifEmailunique->fetch();
                  
                    //verifier les conditions de upload image
                     if(0==$tab[0]||$_SESSION['membre']['mail']==$email){
                        $verifPseudolunique =self::$bdd->prepare("SELECT count(*) from membre where membre.pseudo=:pseudo");
                        $verifPseudolunique->bindParam(':pseudo', $pseudo);
                        $verifPseudolunique->execute();
                        $tab=$verifPseudolunique->fetch();
                    
                        if(0==$tab[0]||$_SESSION['pseudo']==$pseudo){ 
                            
                            $newValues = array($pseudo, $password, $email, $sexe, $anniversaire);
                            $sql = 'UPDATE membre
                            SET pseudo   = \'' . $newValues[0] . '\',
                                password = \'' . $newValues[1] . '\',
                                mail     = \'' . $newValues[2] . '\',
                                sexe     = \'' . $newValues[3] . '\',
                                date_anniv = \'' . $newValues[4] . '\'
                                WHERE idMembre='.$_SESSION['idMembre'];
                               
                            $req = self::$bdd->prepare($sql);
                            $req->execute();

                            self::uploadAvatar();

                            $_SESSION['membre']['mail']=$email;
                            $_SESSION['email']=$email;
                            $_SESSION['pseudo']=$pseudo;
                            echo '<script type="text/javascript">
                                    location.href = \'index.php\';
                                    window.alert("profil mis à jour");
                                </script>';
                        }
                        else {
                            echo '<script>alert("Ce pseudo est deja associe a un compte veuillez en choisir un autre");</script>';
                        }

                    }
                    else {
                       echo '<script>alert("Cet email est deja associe a un compte veuillez en choisir un autre");</script>';
                    }

                }
                else{
                   echo '<script>alert("Attention le mot de passe est différent");</script>';
                }
            }
            else{
                echo '<script>alert("inscription impossible,caractères spéciaux interdit");</script>';
            }
        }
        else{
            echo '<script>alert("Il manques des informations, veuillez recommencer");</script>';
        }
        
    }
}
?>
