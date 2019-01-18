
<?php
require_once "connection.php";
Class ModelRegister extends Connection {
    public function __construct() {
    }
    public function is_clean($string) {
       return  (preg_match("/^[\w\-]+$/", $string));

       //"/^[a-zA-Z0-9.!#$%&'*+=?^_`{|}~-]\\s/"
    }
    public function is_email($string){
        return preg_match("/^[a-zA-Z0-9.!#$%&'*+=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/", $string);
    }
    public function register(){
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
                    
                            
                    if(0==$tab[0]){
                        $verifPseudolunique =self::$bdd->prepare("SELECT count(*) from membre where membre.pseudo=:pseudo");
                        $verifPseudolunique->bindParam(':pseudo', $pseudo);
                        $verifPseudolunique->execute();
                        $tab=$verifPseudolunique->fetch();
                    
                            
                        if(0==$tab[0]){ 
                            $passHash = password_hash($password, PASSWORD_DEFAULT);

                            $req=self::$bdd->prepare("INSERT INTO membre VALUES(default,:Pseudo,:Password,:Mail,NOW(),default,1,:Sexe,:Anniv)");
                            $req->bindParam(':Pseudo', $pseudo);
                            $req->bindParam(':Password', $passHash);
                            $req->bindParam(':Mail', $email);
                            $req->bindParam(':Sexe', $sexe);
                            $req->bindParam(':Anniv', $anniversaire);
                            $req -> execute();

                             echo '<script> profileCreated(); </script>';
                        }
                        else {
                            echo '<script> pseudoAlreadyUsed(); </script>';
                        }
                    }
                    else {
                        echo '<script> emailAlreadyUsed(); </script>';
                    }
                }
                else{
                     echo '<script> mismatchPasswords(); </script>';
                }
            }
            else{
                 echo '<script> specialCharactersInPseudo(); </script>';
            }
        }
        else{
            echo '<script> missingField(); </script>';
        }
    }
    
}
?>

