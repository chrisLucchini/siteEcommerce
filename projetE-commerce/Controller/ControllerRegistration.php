<?php
require_once("Model/User.php");
require_once("Model/UserModel.php");
class ControllerRegistration {
        
    public function controlPost() {

        if(!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['pseudo']) && !empty($_POST['mail']) && !empty($_POST['password'])) {

            $nom = htmlspecialchars($_POST['nom']);
            $prenom = htmlspecialchars($_POST['prenom']);
            $pseudo = htmlspecialchars($_POST['pseudo']);
            $mail = htmlspecialchars($_POST['mail']);
            $password_user = htmlspecialchars($_POST['password']);

            if ( !preg_match ( " /^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/ " , $mail ) )
                {
                throw new Exception("Adresse email invalide ! ");
                }
            // On hash le mot de passe pour le mettre en base de donnée:
            $password_hash = password_hash($password_user, PASSWORD_DEFAULT);
            // On récupère le userModel pour gestion en bdd
            $userBdd = UserModel::get_instance();
            // On enregistre l'user en bdd
            $userBdd->registration($nom, $prenom, $pseudo, $mail, $password_hash);
            // On récupère l'user à l'aide de la méthode getUserFromPseudoPassword
            $user = $userBdd->getUserFromPseudoPassword($pseudo, $password_user, $password_hash);
            $_SESSION['user'] = $user;
            throw new Exception("inscription réussie ! Vous êtes maintenant connecté... Bienvenue $pseudo");
            
        }
        else {

            throw new Exception("Veuillez remplir tous les champs");
            
        }


    }


}

// $c = new ControllerSubscribe();
// $c->controlPost("Lucchini", "Christophe", "lc", "christophelucchini@sfr.fr", "123");