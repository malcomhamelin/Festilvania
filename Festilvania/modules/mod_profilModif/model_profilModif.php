<?php

require_once "connection.php";

Class ModelProfilModif extends Connection {

    public function __construct() {

    }
    public function basedate(){

        $pastdata =self::$bdd->prepare("SELECT * from membre where membre.mail=:mail");
        $pastdata->bindParam(':mail', $_SESSION['email']);
        $pastdata->execute();
        $tab=$pastdata->fetchAll();
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
        if (isset($_POST['anniversaire'])) { 
            $anniversaire = $_POST['anniversaire']; } 
        if (isset($_POST['avatar'])) { 
            $avat = $_POST['avatar']; } 
        if(isset($_POST['pseudo'])&&isset($_POST['email'])&&isset($_POST['password'])&&isset($_POST['sexe'])&&isset($_POST['anniversaire'])&&isset($_POST['avatar'])){
            if(self::is_clean($pseudo)&&self::is_email($email)&&self::is_clean($password)&&self::is_clean($password2)){
                if($password==$password2){
                    $verifEmailunique =self::$bdd->prepare("SELECT count(*) from membre where membre.mail=:mail");
                    $verifEmailunique->bindParam(':mail', $email);
                    $verifEmailunique->execute();
                    $tab=$verifEmailunique->fetch();
                    var_dump($tab);
                    
                    if(0==$tab[0]||$_SESSION['email']==$email){
                        $verifPseudolunique =self::$bdd->prepare("SELECT count(*) from membre where membre.pseudo=:pseudo");
                        $verifPseudolunique->bindParam(':pseudo', $pseudo);
                        $verifPseudolunique->execute();
                        $tab=$verifPseudolunique->fetch();
                    
                        if(0==$tab[0]||$_SESSION['pseudo']==$pseudo){ 
                        
                            $req=self::$bdd->prepare("UPDATE membre set(idMembre=$_SESSION['idMembre'],pseudo=:Pseudo,password=:Password,mail=:Mail,date_inscription=$_SESSION['date_inscription'],avatar=:Avatar,idGroupe=1,sexe=:Sexe,date_anniv=:Anniv) where email==$_SESSION['email']"));
                            //jpeu pas tester croisons les doigts sinon tkt tu me renvoie jle refait
                            $req->bindParam(':Pseudo', $pseudo);
                            $req->bindParam(':Password', $password);
                            $req->bindParam(':Mail', $email);
                            $req->bindParam(':Avatar',$avat);
                            $req->bindParam(':Sexe', $sexe);
                            $req->bindParam(':Anniv', $anniversaire);
                            $req -> execute();
                        }
                        else {
                            echo'pseudo pris';
                        }
                    }
                    else {
                        echo'email pris';
                    }
                }
                else{
                    echo'mot de passe différent';
                }
            }
            else{
                echo"inscription impossible,caractères spéciaux interdit"; 
            }
        }
    }
  

}

?>