<?php

require_once "tampon/view_generic.php";

Class ViewRegister extends ViewGeneric {

    public function __construct() {
        parent::__construct();
    }

    public function displayregister(){
        require_once "template_register.php";
        echo'<br><br><br>';
        /*
        array(2) { ["count(*)"]=> string(1) "0" [0]=> string(1) "0" }

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
                mot de passe :<input type='password' name='password'><br>
                confirmation mot de passe :<input type='password' name='password2'><br>
                sexe :<br><input type='radio' id='homme' name='sexe' value='homme'> Homme 
                    <input type='radio' id='femme' name='sexe' value='femme'> Femme 
                    <input type='radio' id='autre' name='sexe' value='autre'> Autres<br>
                date de naissance : <input type='date'max='2006-11-16' min='1900-01-01' name='anniversaire'>
             <input type='submit' value='envoyer'>
         </form>";
         */
    }




}

?>