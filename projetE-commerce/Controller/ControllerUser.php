<?php

class ControllerUser {

    public function controlDisplayUsers() {

        $userBdd = UserModel::get_instance();
        $users = $userBdd->getUsersFromData();
        return $users;
    }
    
    public function controlUser($id_user) {
        
        
        $userBdd = UserModel::get_instance();
        $user = $userBdd->getUserFromId($id_user);
        return $user;

    }

    public function controlUpdateUser($id_user) {

        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $mail = htmlspecialchars($_POST['mail']);

        if ( !preg_match ( " /^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/ " , $mail ) )
            {
            throw new Exception("Adresse email invalide ! ");
            }
        $userBdd = UserModel::get_instance();
        
        $userBdd->updateUser($id_user, $nom, $prenom, $pseudo, $mail);
    }
    
    public function controlDeleteUser($id_user) {
        
        $userBdd = UserModel::get_instance();
        $userBdd->deleteUser($id_user);
        header('Location: '.HTTP.'?admin=utilisateurs');
        
    }
}