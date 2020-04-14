<?php

// require_once("Modele.php");
require_once("Caracteristique.php");
class CaracteristiqueModel extends Modele {

    private static $instance = null;
    const TABLE_ID = "id_carac";
    const ATT_TYPE = "type";
    const ATT_VALEUR =  "valeur";
    const ATT_TYPEVALEUR = "typevaleur";
    const ATT_CATEGORIEPRODUIT ="categorie_produit";
    const ATT_CATEGORIECARAC ="categorie_caracteristique";
    const ATT_NIVEAU ="niveau";

    private function __construct() {


    }
    public static function get_instance() {

        if(is_null(self::$instance)) {

            self::$instance = new CaracteristiqueModel();
        }
        return self::$instance;

    }

    public function verify_exist($type, $valeur, $categorie_produit, $categorie_caracteristique) {

        $sql = "SELECT * FROM caracteristique WHERE type = '$type' AND valeur = '$valeur' AND categorie_produit = '$categorie_produit' AND categorie_caracteristique = '$categorie_caracteristique'";
        $resultat = $this->executerRequete($sql);
        return $resultat->rowCount() == 1;
    }

    public function createCarac($type, $valeur, $categorie_produit, $categorie_caracteristique, $niveau) {

        $type_valeur_caracteristique = $type . " " . $valeur;
        $sql = "INSERT INTO caracteristique (type_valeur_caracteristique, type, valeur, typevaleur, categorie_produit, categorie_caracteristique, niveau) VALUES('$type_valeur_caracteristique', '$type', '$valeur', 'String', '$categorie_produit', '$categorie_caracteristique', '$niveau')";
        $resultat = $this->executerRequete($sql);

    }

    public function updateNiveauCarac($id_carac, $niveau) {

        $sql = "UPDATE caracteristique SET niveau = '$niveau' WHERE id_carac = '$id_carac'";
        $this->executerRequete($sql);
    }

    public function getCaracteristique($carac) {

        $caracteristique = new Caracteristique();
        $caracteristique->setId_carac($carac[self::TABLE_ID]);
        $caracteristique->setType($carac[self::ATT_TYPE]);
        $caracteristique->setValeur($carac[self::ATT_VALEUR]);
        $caracteristique->setTypeValeur($carac[self::ATT_TYPEVALEUR]);
        $caracteristique->setCategorie_produit($carac[self::ATT_CATEGORIEPRODUIT]);
        $caracteristique->setCategorie_caracteristique($carac[self::ATT_CATEGORIECARAC]);
        $caracteristique->setNiveau($carac[self::ATT_NIVEAU]);

        return $caracteristique;

    }

    public function get_all_principale_caracteristiques_categorie($categorie){

        $sql = "SELECT * FROM caracteristique WHERE niveau = 'principale' AND categorie_produit = '$categorie'";
        $res = $this->executerRequete($sql);
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_all_caracteristiques_categorie($categorie) {

        $sql = "SELECT * FROM caracteristique WHERE categorie_produit = '$categorie'";
        $res = $this->executerRequete($sql);

        $donneesCarac = $res->fetchAll(PDO::FETCH_ASSOC);

        //Initialisation de différents tableau de données pour pouvoir mieux découper dans la vue
        $data = [];
        $type = [];

        $donnees = [];
        foreach($donneesCarac as $carac) {

            //parcours des données et definition de la clé correspondant à la catégorie de la caractéristique
            $data[$carac['categorie_caracteristique']] = [];
            $type[$carac['categorie_caracteristique']] =[];
        }
        foreach($donneesCarac as $carac) {
            //push des données caracteristique dans la clé correspondant à la catégorie caracteristique
            array_push($data[$carac['categorie_caracteristique']], $carac);
            if(!in_array($carac['type'], $type[$carac['categorie_caracteristique']])){
                //push des données de type dans la clé correspondant à la catégorie caracteristique
                array_push($type[$carac['categorie_caracteristique']], $carac['type']);
            }
        }
        $donnees['caracteristiques'] = $data;
        $donnees['type'] = $type;
        return $donnees;
        
    }

    public function getValeurOnType($type, $categorie) {

        $sql = "SELECT valeur from caracteristique where type = '$type' AND categorie_produit = '$categorie'";
        $res = $this->executerRequete($sql);
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getIdFromTypeValeurCarac($type, $Valeur, $categorie) {

        $typeValeur = $type . " " . $Valeur;
        $sql = "SELECT id_carac from caracteristique where type_valeur_caracteristique = '$typeValeur' AND categorie_produit = '$categorie'";
        $res = $this->executerRequete($sql);
        $donnees = $res->fetch();
        return $donnees['id_carac'];


    }

    public function updateCarac($id_carac, $id_produit, $oldId) {

        $sql = "UPDATE caracteristiqueproduit SET id_carac = '$id_carac' WHERE id_produit = '$id_produit' AND id_carac = '$oldId'";
        $res = $this->executerRequete($sql);

    }

    public function deleteCarac($id_produit, $id_carac) {

        $sql = "DELETE FROM caracteristiqueproduit WHERE id_produit = '$id_produit' AND id_carac = '$id_carac'";
        $this->executerRequete($sql);

    }

    public function addCarac($id_carac, $id_produit) {

        $sql = "INSERT INTO caracteristiqueproduit (id_produit, id_carac) VALUES('$id_produit', '$id_carac')";
        $this->executerRequete($sql);
    }

    public function getCategorieCarac($categorie_produit) {

        $sql = "SELECT DISTINCT(categorie_caracteristique) FROM caracteristique WHERE categorie_produit = '$categorie_produit'";
        $res = $this->executerRequete($sql);
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTypeCarac($categorie_produit) {

        $sql = "SELECT DISTINCT(type) FROM caracteristique WHERE categorie_produit = '$categorie_produit'";
        $res = $this->executerRequete($sql);
        return $res->fetchAll(PDO::FETCH_ASSOC);

    }
    public function getValeurCarac($categorie_produit) {

        $sql = "SELECT DISTINCT(valeur) FROM caracteristique WHERE categorie_produit = '$categorie_produit'";
        $res = $this->executerRequete($sql);
        return $res->fetchAll(PDO::FETCH_ASSOC);

    }

}

// $caracBdd = CaracteristiqueModel::get_instance();
// $carac = $caracBdd->getCaracteristiqueByid(1);
// var_dump($carac);