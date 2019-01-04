<?php

require_once "tampon/view_generic.php";

Class ViewRegister extends ViewGeneric {

    public function __construct() {
        parent::__construct();
    }

    function checkPasswordSize(field) {
    if (field.value.length < 6 || field.value.length > 40) {
        highlight(field, "error_pwd", "Mot de passe invalide. Sa taille doit être au moins de 6 caractères.");
        return false;
    } else {
        highlight(field, "error_pwd");
        return true;
     }
    }

    function checkPasswordEquals(field) {
        var pwdRepeat = field.value;
        var pwd = document.getElementById("password").value;
        if (pwdRepeat != pwd || pwdRepeat == "") {
            highlight(field, "error_pwd_repeat", "Les mots de passe ne correspondent pas.");
            return false;
        } else {
            highlight(field, "error_pwd_repeat");
            return true;
        }
    }
    public function displayregister(){
        require_once "template_register.php";
        echo'<br><br><br>';
        
        echo" <form method='post' action='index.php?mod=register&action=register' class='mt-5'>
                            <img id='uploadPreview' style='width: 100px; height: 100px;' />
                            <input id='uploadImage' type='file' name='avatar' onchange='PreviewImage();'' />
                            <script type='text/javascript'>

                                function PreviewImage() {
                                    var oFReader = new FileReader();
                                    oFReader.readAsDataURL(document.getElementById('uploadImage').files[0]);

                                    oFReader.onload = function (oFREvent) {
                                        document.getElementById('uploadPreview').src = oFREvent.target.result;
                                    };
                                };

                            </script>
                            <br>
                pseudo :<input type='textarea' name='pseudo'><br>
                email :<input type='email' name='email'><br>
                mot de passe :<input type='password' onblur="checkPassword(this)" name='password'><br>
                confirmation mot de passe :<input type='password' onblur="checkPassword(this)" name='password2'><br>
                sexe :<br><input type='radio' id='homme' name='sexe' value='homme'> Homme 
                    <input type='radio' id='femme' name='sexe' value='femme'> Femme 
                    <input type='radio' id='autre' name='sexe' value='autre'> Autres<br>
                date de naissance : <input type='date'max='2006-11-16' min='1900-01-01' name='anniversaire'>
             <input type='submit' value='envoyer'>
         </form>";
         
    }
    public function displayprofil($content){
         require_once "template_register.php";
        echo'<br><br><br>';
       
        $homme="";
        $femme="";
        $autre="";

        //remplasser key par content
        if($content['sexe']=="homme"){
            $homme='checked="checked"';
        }
        if($content['sexe']=="femme"){
            $femme='checked="checked"';
        }
        if($content['sexe']=="autre"){
            $autre='checked="checked"';
        }

            echo' <form method="post"action=index.php?action=register >
                                <img id="uploadPreview" style="width: 100px; height: 100px;" />
                                <input id="uploadImage" type="file" name="avatar" onchange="PreviewImage();"" />
                                <script type="text/javascript">

                                    function PreviewImage() {
                                        var oFReader = new FileReader();
                                        oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);

                                        oFReader.onload = function (oFREvent) {
                                            document.getElementById("uploadPreview").src = oFREvent.target.result;
                                        };
                                    };

                                </script>
                                <br>
                    pseudo :<input type="textarea" name="pseudo" value="' . $content['pseudo'] . '" ><br>
                    email :<input type="email" name="email" value="' . $content['email'] . '" ><br>
                    mot de passe :<input type="password" onblur='checkPassword(this)' name="password" value="' . $content['password'] . '"><br>
                    confirmation mot de passe :<input type="password" onblur='checkPassword(this)' name="password2" value="' . $content['password'] . '"><br>
                    sexe :
                        <br>

                            <input type="radio" id="homme" name="sexe" value="homme" '.$homme.'> Homme 
                            <input type="radio" id="femme" name="sexe" value="femme" '.$femme.'> Femme 
                            <input type="radio" id="autre" name="sexe" value="autre" '.$autre.'> Autres
                        <br>
                    date de naissance : <input type="date"max="2006-11-16" min="1900-01-01" value="'.$content['date_anniv'].'"anniversaire">
                 <input type="submit" value="envoyer">
             </form>';
      
    }





}

?>