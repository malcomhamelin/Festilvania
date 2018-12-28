<?php

require_once 'tampon/view_generic.php';

Class ViewProfilModif extends ViewGeneric{

    public function __construct() {
        parent::__construct();
    }

    public function displayprofil($content){
        echo'<br><br><br>';
        //a enlevr pour les test vu que j'ai pas les variables de session
        $key['pseudo']='yee';
        $key['email']='a@a.fr';
        $key['password']='omea mamuru';
        $key['sexe']='homme';

        $homme="";
        $femme="";
        $autre="";

        //remplasser key par content
        if($key['sexe']=="homme"){
            $homme='checked="checked"';
        }
        if($key['sexe']=="femme"){
            $femme='checked="checked"';
        }
        if($key['sexe']=="autre"){
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
                    pseudo :<input type="textarea" name="pseudo" value="' . $key['pseudo'] . '" ><br>
                    email :<input type="email" name="email" value="' . $key['email'] . '" ><br>
                    mot de passe :<input type="password" name="password" value="' . $key['password'] . '"><br>
                    confirmation mot de passe :<input type="password" name="password2" value="' . $key['password'] . '"><br>
                    sexe :
                        <br>

                            <input type="radio" id="homme" name="sexe" value="homme" '.$homme.'> Homme 
                            <input type="radio" id="femme" name="sexe" value="femme" '.$femme.'> Femme 
                            <input type="radio" id="autre" name="sexe" value="autre" '.$autre.'> Autres
                        <br>
                    date de naissance : <input type="date"max="2006-11-16" min="1900-01-01" value="'.$key['date_anniv'].'"anniversaire">
                 <input type="submit" value="envoyer">
             </form>';
      //possible erreur a $key['dateAnniv'] j'ai pas acces a la BD j'ai plus le nom exact en tete
    }




}

?>