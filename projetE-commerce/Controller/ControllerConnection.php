<?php
require_once("Model/User.php");
require_once("Model/UserModel.php");

class ControllerConnection {

    
    public function controlPost() {

        if(!empty($_POST['pseudo']) && !empty($_POST['password'])) {

            $pseudo = htmlspecialchars($_POST['pseudo']);
            $password = htmlspecialchars($_POST['password']);
            //Récupération de l'user DAO pour gestion bdd
            $userModel = UserModel::get_instance();
            //On récupère le mot de passe hashé en bdd pour le vérifié ensuite dans la methode getUserFromPseudoPassWord
            $passwordBdd = $userModel->getPasswordUser($pseudo);
            //On instancie un new User à l'aide de la méthode getUserFromPseudoPassword:
            $userBdd = $userModel->getUserFromPseudoPassWord($pseudo, $password, $passwordBdd);
            // var_dump($userBdd);
            
            

            if(!is_null($userBdd)) {

                //On met dans une variable de session l'objet User récupéré
                $_SESSION['user'] = $userBdd;
              
                throw new Exception("Vous êtes maintenant connecté: ".$_SESSION['user']->getPseudo());
            }
            
            else {

                throw new Exception("Mauvais identifiant ou mot de passe !");
                
            }
        }
        else {

            throw new Exception("Veuillez saisir tous les champs");
            
        }
    }

    public function deconnect() {

        session_destroy();
        header("Location: ". HTTP);
    }
}