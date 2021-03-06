<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="../CSS/InscriptionUser.css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
    <script src="../JS/fonction.js"></script>
</head>
<body>
<div class="opacité">
         <!--div contenant le logo et le texte-->
        <div class="header">
            <div id="logo"><img src="../IMG/INTEGRATIONPHP/Images/logo-QuizzSA.png" alt=""></div>
            <div class="texte"><h2>Le plaisir de jouer</h2></div>
        </div>
        <!--partie inscription-->
        <div class="whitefont">
            <div class="whitefont1">
                <div class="whitefont2">
                    <div class="whitefont3">
                        <div class="blocgauche">
                            <div class="titre">
                                <h2>S’INSCRIRE</h2>
                                <p>Pour tester votre niveau de culture générale</p>
                                <div class="soulign"></div>
                            </div>
                            <form action="" method="post" id="myForm" enctype="multipart/form-data">
                                <!-- Prénom -->
                                <label for="prenom">Prénom</label><br>
                                <input type="text" name="prenom" id="prenom" error="error1" placeholder="Prenom"><br><br><br><br>
                                <div class="error" id="error1"></div>

                                <!-- Nom -->
                                <label for="nom">Nom</label><br>
                                <input type="text" name="nom" id="nom" error="error2" placeholder="Nom"><br><br><br><br>
                                <div class="error" id="error2"></div>

                                <!-- Login -->
                                <label for="login">Login</label><br>
                                <input type="text" name="login" id="login" error="error3" placeholder="Login"><br><br><br><br>
                                <div class="error" id="error3"></div>

                                <!-- Password -->
                                <label for="pwd">Password</label><br>
                                <input type="password" name="pwd" id="pwd" error="error4" placeholder="Password" style="float: left; margin-left: 30px; width: 80%;
                                height: 10px; font-family: 'Open sans'; border-radius: 5px;     border: 1px solid silver;
                                padding: 20px; font-size: 15px; color: rgb(92, 92, 92);"><br><br><br><br>
                                <div class="error" id="error4"></div>

                                <!-- Confirmer password -->
                                <label for="confpwd">Confirm Password</label><br>
                                <input type="password" name="confpwd" id="confpwd" error="error5" placeholder="Confirm Password" style="float: left; 
                                margin-left: 30px; width: 80%;height: 10px; font-family: 'Open sans'; border-radius: 5px; border: 1px solid silver;
                                padding: 20px; font-size: 15px; color: rgb(92, 92, 92);"><br><br><br><br><br>
                                <div class="error" id="error5"></div>

                                <!-- Boutton créer compter et choisir fichier -->
                                <label for="avatar" style="color: black; font-size: 20px;">Avatar</label>

                                <input type="file" name="avatars" id="avatars" onchange="handleFiles(files)">

                                <input type="submit" value="Choisir un fichier" name="envoyer" style="margin-left: 230px"><br><br>
                                <input type="submit" value="Creer un Compte" name="envoie" style="margin-top: -5px"><br><br>
                            </form>
                        </div>
                        <div class="blocdroite">
                            <div class="avatar">
                                <span id="preview"></span>
                            </div>
                            <h3>Avatar du joueur</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


  <!--Validation avec JavaScript-->
    <script>
    var myForm = document.getElementById('myForm');
        myForm.addEventListener('submit', function(e){           
            
            var error4 = document.getElementById('error4');

            var pwd=document.getElementById('pwd');
            var confpwd=document.getElementById('confpwd');
            if(pwd.value!=confpwd.value || pwd.value.length<8 || pwd.value==""){
              error4.innerHTML = "Le mot de passe et la confirmation du mot de passe doit être identique";
                e.preventDefault();
                
            }else{
                error4.innerHTML = "";
            }
        });

        var myForm = document.getElementById('myForm');
        myForm.addEventListener('submit', function(e){           
            
            var error1 = document.getElementById('error1');
            var error2 = document.getElementById('error2');
            var error3 = document.getElementById('error3');

            var prenom=document.getElementById('prenom');
            var nom=document.getElementById('nom');
            var login=document.getElementById('login');
            let myRegex= /^[a-zA-Z\s]+$/;
            let myRegexlog= /^[a-zA-Z0-9\s]+$/;

            if(prenom.value.trim()=="" || myRegex.test(prenom.value)==false){
              error1.innerHTML = "Le prénom ne doit contenir que des caractères alphabétiques";
                e.preventDefault();
                
            }else{
                error1.innerHTML = "";
            }

            if(nom.value.trim()=="" || myRegex.test(nom.value)==false){
              error2.innerHTML = "Le nom ne doit contenir que des caractères alphabétiques";
                e.preventDefault();
                
            }else{
                error2.innerHTML = "";
            }

            if(login.value.trim()=="" || myRegexlog.test(login.value)==false){
              error3.innerHTML = "Login doit être unique";
                e.preventDefault();
                
            }else{
                error3.innerHTML = "";
            }

        });
       
    </script>

<?php
    if(isset($_POST['envoie'])){

        $dossier = "../IMG/Avatar/";
        $fichier = $dossier . basename($_FILES["avatars"]["name"]);
        $erreur = 1;
        $extension = strtolower(pathinfo($fichier,PATHINFO_EXTENSION));
        // Vérifie le chemin du fichier temporaire
        if(isset($_POST["envoyer"])) {
            $check = getimagesize($_FILES["avatars"]["tmp_name"]);
            if($check !== false) {
                echo "Le fichier est une image - " . $check["mime"] . ".";
                $erreur = 1;
            } else {
                echo "Le fichier n'est pas une image.";
                $erreur = 0;
            }
        }
        // Vérification de la taille du fichier
        if ($_FILES["avatars"]["size"] > 500000) {  
            echo "Le fichier est trop gros...!";
            $erreur = 0;
        }
        // Type de fichiers autoriser
        if($extension != "jpg" && $extension != "png" && $extension != "jpeg") {
            echo "Vous devez uploader un fichier de type png, jpg, jpeg!";
            $erreur = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($erreur == 0) {
            echo "Désolé, le fichier n'est pas téléchargé.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["avatars"]["tmp_name"], $fichier)) {
            $photo = basename( $_FILES["avatars"]["name"]);
            } else {
                echo "Une erreur est survenu lors du téléchargement de ton fichier.";
            }
        }



        $json = file_get_contents('../JSON/Utilisateur.json');
        $json = json_decode($json,true);
        $bool=false;
        foreach ($json as $key ) {
            if($_POST['login']==$key['login']){
                $bool = true;
            }
        }
        if($bool == true){
            echo "Ce login exist!";
        }
        else{
            $user = array();
            $user['prenom'] = $_POST['prenom'];
            $user['nom'] = $_POST['nom'];
            $user['login'] = $_POST['login'];
            $user['password'] = $_POST['pwd'];
            $user['role'] = 'Joueur';
            $user['avatar'] = $photo;
            $json[] = $user;
            $json = json_encode($json);
            $json = file_put_contents('../JSON/Utilisateur.json',$json);

            echo "<script type='text/javascript'>document.location.replace('./PageJoueur.php');</script>";
        }
        
    }
?>

    
</body>
</html>