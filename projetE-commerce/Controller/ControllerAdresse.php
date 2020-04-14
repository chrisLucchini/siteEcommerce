<?php

class ControllerAdresse {

    public function controlPost() {

        if(!empty($_POST['prenom_nom']) && !empty($_POST['adresse_ligne1']) && !empty($_POST['adresse_ligne2']) && !empty($_POST['ville']) && !empty($_POST['region'])  && !empty($_POST['code_postal'])&& !empty($_POST['telephone'])) {

            $data = [];
            $data['prenom_nom'] = addslashes(htmlspecialchars($_POST['prenom_nom'])) ;
            $data['adresse_ligne1'] = addslashes(htmlspecialchars($_POST['adresse_ligne1'])) ;
            $data['adresse_ligne2'] = addslashes(htmlspecialchars($_POST['adresse_ligne2'])) ;
            $data['ville'] = addslashes(htmlspecialchars($_POST['ville'])) ;
            $data['region'] = addslashes(htmlspecialchars($_POST['region'])) ;
            $data['code_postal'] = addslashes(htmlspecialchars($_POST['code_postal'])) ;
            $data['telephone'] = addslashes(htmlspecialchars($_POST['telephone'])) ;

            $data['id_utilisateur'] = $_SESSION['user']->getId_utilisateur();

            // On récupère l'adresseModel pour gestion en bdd
            $adrBdd = AdresseModel::get_instance();
            // On enregistre l'adresse en bdd et on recupere l'id
            $id_adresse = $adrBdd->addAddress($data);

            $data['prenom_nom'] = stripslashes($data['prenom_nom']);
            $data['adresse_ligne1'] = stripslashes($data['adresse_ligne1']);
            $data['adresse_ligne2'] = stripslashes($data['adresse_ligne2']);
            $data['ville'] = stripslashes($data['ville']);
            $data['region'] = stripslashes($data['region']);
            $data['code_postal'] = stripslashes($data['code_postal']);
            $data['telephone'] = stripslashes($data['telephone']);

            $data['id_adresse'] = $id_adresse;

            $adresse = $adrBdd->getAdresse($data);
            $_SESSION['user']->initAdresse($adresse);
            
        }
        else {

            throw new Exception("Veuillez remplir tous les champs");
            
        }
    }
}