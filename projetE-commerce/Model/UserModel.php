<?php

// require_once("Modele.php");

class UserModel extends Modele {

    private static $instance = null;
    const TABLE_ID = "id_utilisateur";
    const ATT_NOM = "nom";
    const ATT_PRENOM =  "prenom";
    const ATT_PSEUDO = "pseudo";
    const ATT_MAIL ="mail_utilisateur";
    const ATT_PSWD ="pass_utilisateur";
    const ATT_DATEINSCRIPTION ="date_inscription";
    const ATT_NIVEAU ="niveau";

    private function __construct() {


    }

    public function registration ($nom, $prenom, $pseudo, $mail,$password_user) {

        if(!$this->verifyExist($pseudo)) {
            $sql = "INSERT INTO utilisateur (nom, prenom, pseudo, mail_utilisateur, pass_utilisateur) VALUES('$nom', '$prenom', '$pseudo','$mail', '$password_user')";
            $this->executerRequete($sql);
            // throw new Exception("inscription réussie !");
            
        }
        else {

            throw new Exception("Pseudo déja existant");
        }
    }
    public function updateUser($id_utilisateur, $nom, $prenom, $pseudo, $mail) {

        if(!$this->verifyExist($pseudo)) {
            $sql = "UPDATE utilisateur SET nom = '$nom', prenom = '$prenom', pseudo = '$pseudo', mail_utilisateur = '$mail' WHERE id_utilisateur = '$id_utilisateur'";
            $this->executerRequete($sql);
            throw new Exception("Utilisateur modifié !");
        }
        else {

            throw new Exception("Pseudo déja existant");
        }
    }

    public function deleteUser($id_user) {

        $sql = "DELETE FROM utilisateur WHERE id_utilisateur = '$id_user'";
        $this->executerRequete($sql);
    }

    public function connection($pseudo, $password_user) {

        $sql = "SELECT * FROM utilisateur WHERE pseudo = '$pseudo' AND pass_utilisateur = '$password_user'";
        $resultat = $this->executerRequete($sql);
        var_dump($resultat);
        return $resultat;
    }

    public function verifyExist($pseudo) {

        $sql = "SELECT * FROM utilisateur WHERE pseudo = '$pseudo'";
        $resultat = $this->executerRequete($sql);
        return $resultat->rowCount() == 1;
    }

    public function getPasswordUser($pseudo) {

        $sql = "SELECT pass_utilisateur FROM utilisateur WHERE pseudo = '$pseudo'";
        $resultat = $this->executerRequete($sql);
        $donnees = $resultat->fetch();

        return $donnees[self::ATT_PSWD];


    }

    public function getAllUsers() {

        $sql = "SELECT * FROM utilisateur";
        $res = $this->executerRequete($sql);
        $donnees = $res->fetchAll();

        return $donnees;
    }

    public function getUsersFromData() {

        $donnees = $this->getAllUsers();
        $tabUsers = [];

        foreach($donnees as $donnee) {


            $user = new User();
            $user->setId_utilisateur($donnee[self::TABLE_ID]);
            $user->setNom($donnee[self::ATT_NOM]);
            $user->setPassword($donnee[self::ATT_PSWD]);
            $user->setPrenom($donnee[self::ATT_PRENOM]);
            $user->setPseudo($donnee[self::ATT_PSEUDO]);
            $user->setEmail_user($donnee[self::ATT_MAIL]);
            $user->setDate_inscription($donnee[self::ATT_DATEINSCRIPTION]);
            $user->setNiveau($donnee[self::ATT_NIVEAU]);

            array_push($tabUsers, $user);

        }
        return $tabUsers;
    }

    public function getUserFromId($id_user) {

        $sql = "SELECT * FROM utilisateur WHERE id_utilisateur = '$id_user'";
        $res = $this->executerRequete($sql);
        $donnees = $res->fetch();

        $user = new User();
        $user->setId_utilisateur($donnees[self::TABLE_ID]);
        $user->setNom($donnees[self::ATT_NOM]);
        $user->setPassword($donnees[self::ATT_PSWD]);
        $user->setPrenom($donnees[self::ATT_PRENOM]);
        $user->setPseudo($donnees[self::ATT_PSEUDO]);
        $user->setEmail_user($donnees[self::ATT_MAIL]);
        $user->setDate_inscription($donnees[self::ATT_DATEINSCRIPTION]);
        $user->setNiveau($donnees[self::ATT_NIVEAU]);

        $adrBdd = AdresseModel::get_instance();
        $donneesAdresses = $this->getAdresseByIdUser($user->getId_utilisateur());

        foreach($donneesAdresses as $adresse) {

            $user->initAdresse($adrBdd->getAdresse($adresse));
        }

        return $user;


    }
    public function getUserFromPseudoPassword($pseudo, $password, $passwordBdd) {

        if(password_verify($password, $passwordBdd)) {

            $sql = "SELECT * FROM utilisateur WHERE pseudo = '$pseudo' AND pass_utilisateur = '$passwordBdd'";
            $resultat = $this->executerRequete($sql);

            if($resultat->rowCount() != 1) {
                return null;
            }
            $donnees = $resultat->fetch();
            
            $user = new User();
            $user->setId_utilisateur($donnees[self::TABLE_ID]);
            $user->setNom($donnees[self::ATT_NOM]);
            $user->setPassword($donnees[self::ATT_PSWD]);
            $user->setPrenom($donnees[self::ATT_PRENOM]);
            $user->setPseudo($donnees[self::ATT_PSEUDO]);
            $user->setEmail_user($donnees[self::ATT_MAIL]);
            $user->setDate_inscription($donnees[self::ATT_DATEINSCRIPTION]);
            $user->setNiveau($donnees[self::ATT_NIVEAU]);

            $adrBdd = AdresseModel::get_instance();
            $donneesAdresses = $this->getAdresseByIdUser($user->getId_utilisateur());

            foreach($donneesAdresses as $adresse) {

                $user->initAdresse($adrBdd->getAdresse($adresse));
            }

            $panier = new Panier();
            $user->setPanier($panier);
    
            return $user;
        }
        
    }

    public function getAdresseByIdUser($id_utilisateur) {

        $sql = "SELECT * FROM adresse WHERE id_utilisateur = $id_utilisateur";
        $res = $this->executerRequete($sql);
        $data = $res->fetchAll();

        return $data;

    }

    public static function get_instance() {

        if(is_null(self::$instance)) {

            self::$instance = new UserModel();
        }
        return self::$instance;

    }

    
}