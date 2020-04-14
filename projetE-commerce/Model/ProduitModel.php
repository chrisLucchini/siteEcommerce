<?php

require_once("Modele.php");
require_once("Produit.php");
require_once("DescriptionModel.php");
require_once("ImageModel.php");
require_once("CaracteristiqueModel.php");

class ProduitModel extends Modele{

    public static $TABLE_ID = "id_produit";
    public static $ATT_CATEGORIE = "categorie";
    public static $ATT_SOUS_CATEGORIE = "sous_categorie";
    public static $ATT_MODELE =  "modele";
    public static $ATT_DESIGNATION = "designation";
    public static $ATT_PRIX ="prix";
    public static $ATT_MARQUE ="marque";
    public static $ATT_DESCPRODUIT ="mini_description_produit";
    public static $ATT_DESCTECHNIQUE ="mini_description_technique";

    public static $CHAMP = [];

    private static $instance = null;

    private function __construct() {

        self::$CHAMP[] = self::$ATT_CATEGORIE;
        self::$CHAMP[] = self::$ATT_SOUS_CATEGORIE;
        self::$CHAMP[] = self::$ATT_MODELE;
        self::$CHAMP[] = self::$ATT_DESIGNATION;
        self::$CHAMP[] = self::$ATT_PRIX;
        self::$CHAMP[] = self::$ATT_MARQUE;
        self::$CHAMP[] = self::$ATT_DESCPRODUIT;
        self::$CHAMP[] = self::$ATT_DESCTECHNIQUE;

    }
    public static function get_instance() {

        if(is_null(self::$instance)) {

            self::$instance = new ProduitModel();
        }
        return self::$instance;

    }
/**
 * PatternFactory de Produit par l'id
 */
    public function getProduitById($id_produit) {

        $sql = "SELECT * FROM produit INNER JOIN description ON produit.id_produit = description.id_produit WHERE produit. id_produit = '$id_produit'";
        $res = $this->executerRequete($sql);
        $donneesProduit = $res->fetchAll();
        if(!$donneesProduit) {
            $sql = "SELECT * FROM produit WHERE id_produit = '$id_produit'";
            $res = $this->executerRequete($sql);
            $donneesProduit = $res->fetch();

            $produit = new Produit($donneesProduit);

            $imageBdd = ImageModel::get_instance();

            $donneesImg = $this->getImageByIdProduit($produit->getId_produit());

            if($donneesImg) {
                
                foreach($donneesImg as $img) {
    
                    $produit->initImage($imageBdd->get_image($img));
                }
            }

            $caracBdd = CaracteristiqueModel::get_instance();
            $donneesCarac = $this->getCaracByIdProduit($produit->getId_produit());

            if($donneesCarac) {

                foreach($donneesCarac as $carac) {
    
                    $produit->initCaracteristiques($caracBdd->getCaracteristique($carac));
                }
            }

            return $produit;
        }
        // var_dump($donneesProduit);


        //Données produit:
        $produit = new Produit($donneesProduit[0]);

        //Descriptions produit:
        $descriptionBdd = DescriptionModel::get_instance();

        // $donneesDesc = $this->getDescriptionByIdProduit($produit->getId_produit());

        foreach($donneesProduit as $desc) {

            $produit->initDescriptions($descriptionBdd->get_description($desc));
        }

        //Images produit:
        $imageBdd = ImageModel::get_instance();

        $donneesImg = $this->getImageByIdProduit($produit->getId_produit());

        foreach($donneesImg as $img) {

            $produit->initImage($imageBdd->get_image($img));
        }

        //Caracteristiques produit:
        $caracBdd = CaracteristiqueModel::get_instance();
        $donneesCarac = $this->getCaracByIdProduit($produit->getId_produit());

        foreach($donneesCarac as $carac) {

            $produit->initCaracteristiques($caracBdd->getCaracteristique($carac));
        }

        //Avis produit:
        $avisBdd = AvisModel::get_instance();
        $avisProd = $this->getAvisByIdProduit($produit->getId_produit());
        if($avisProd) {

            foreach($avisProd as $donnees){

                $produit->initAvis($avisBdd->getAvis($donnees));
            }


        }

        return $produit;
    }

    public function getAvisByIdProduit($id_produit) {

        $sql = "SELECT * FROM avis WHERE id_produit = '$id_produit'";
        $res = $this->executerRequete($sql);
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProduitWithoutDesc($id_produit) {

        $sql = "SELECT * FROM produit WHERE id_produit = '$id_produit'";
        $res = $this->executerRequete($sql);
        $donnees = $res->fetch();
        $produit = new Produit($donnees);

        return $produit;

        // var_dump($produit);
    }

    public function getIdProduitWithIdCarac($id_carac) {

        $sql = "SELECT id_produit from caracteristiqueproduit WHERE id_carac = '$id_carac'";
        $res = $this->executerRequete($sql);
        return $res->fetchAll(PDO::FETCH_ASSOC);

    }

    /**
     * Recupere le produit pour l'affichage MesCommandes:
     */
    public function getProduitCommande($data) {

        $produit = new Produit($data);

        $imageBdd = ImageModel::get_instance();
        $image = $imageBdd->get_image($data);

        $produit->initImage($image);

        return $produit;


    }
/**
 * Recupere tous les id description lié au produit
 */
    public function getDescriptionByIdProduit($id_produit) {

        $sql = "SELECT * FROM description WHERE id_produit = '$id_produit'";
        $res = $this->executerRequete($sql);
        $donneesDesc = $res->fetchAll();

        return $donneesDesc;

    }
/**
 * Récupere tous les id image lié au produit
 */
    public function getImageByIdProduit($id_produit) {

        $sql = "SELECT * FROM image WHERE id_produit = '$id_produit'";
        $res = $this->executerRequete($sql);
        $donneesImg = $res->fetchAll();

        return $donneesImg;

    }

/**
 * Recupere tous les id caracteristique du produit:
 */

    public function getCaracByIdProduit($id_produit) {

        $sql = "SELECT * FROM caracteristiqueproduit INNER JOIN caracteristique ON caracteristiqueproduit.id_carac = caracteristique.id_carac WHERE id_produit = '$id_produit'";
        $res = $this->executerRequete($sql);
        $donneesCarac = $res->fetchAll();

        return $donneesCarac;
    }
/**
 * Recupere tous les produits
 */
    public function getAllProductByCategorie($categorie) {

        $sql = "SELECT * FROM produit WHERE categorie = '$categorie'";
        $res = $this->executerRequete($sql);
        $donnees = $res->fetchAll();

        return $donnees;
    }

    public function getIdProductByMarque($marque) {

        $sql = "SELECT id_produit FROM produit WHERE marque = '$marque'";
        $res = $this->executerRequete($sql);
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getIdProductBycategorie($categorie) {

        $sql = "SELECT id_produit FROM produit WHERE categorie = '$categorie' OR sous_categorie = '$categorie'";
        $res = $this->executerRequete($sql);
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllProductBySousCategorie($categorie) {

        $sql = "SELECT * FROM produit WHERE sous_categorie = '$categorie'";
        $res = $this->executerRequete($sql);
        $donnees = $res->fetchAll();

        return $donnees;
    }

    public function getAllProducts() {

        $sql = "SELECT * FROM produit";
        $res = $this->executerRequete($sql);
        $donnees = $res->fetchAll();

        return $donnees;
    }

    public function getSousCategorieByCategorie($categorie){

        $sql = "SELECT DISTINCT sous_categorie FROM produit WHERE categorie = '$categorie'";
        $res = $this->executerRequete($sql);
        $donnees = $res->fetchAll(PDO::FETCH_ASSOC);

        return $donnees;
    }
    public function getAllCategorie() {

        $sql = "SELECT DISTINCT categorie FROM produit";
        $res = $this->executerRequete($sql);
        $donnees = $res->fetchAll(PDO::FETCH_ASSOC);

        return $donnees;
    }

    public function getAllSousCategorie() {

            $sql = "SELECT DISTINCT categorie, sous_categorie FROM produit";
            $res = $this->executerRequete($sql);
            $donnees = $res->fetchAll(PDO::FETCH_ASSOC);

            return $donnees;

    }

    public function addProduit($data) {

        $sql = "INSERT INTO produit(designation, marque, modele, categorie, sous_categorie, prix, mini_description_technique, mini_description_produit) VALUES ('".$data['designation']."','".$data['marque']."','".$data['modele']."','".$data['categorie']."','".$data['sous_categorie']."','".$data['prix']."','".$data['mini_description_technique']."','".$data['mini_description_produit']."')";

        $this->executerRequete($sql);
        return $this->bdd->lastInsertId();
    }
    public function updateProduit($data, $id_produit) {

        $sql = "UPDATE produit SET designation = '".$data['designation']."', marque = '".$data['marque']."', modele = '".$data['modele']."', categorie = '".$data['categorie']."', sous_categorie = '".$data['sous_categorie']."', prix = '".$data['prix']."', mini_description_technique = '".$data['mini_description_technique']."', mini_description_produit = '".$data['mini_description_produit']."' WHERE id_produit = '$id_produit'";

        $this->executerRequete($sql);
    }

    public function getSous_categorie_produit($id_produit) {

        $sql = "SELECT sous_categorie from produit where id_produit = '$id_produit'";
        $res = $this->executerRequete($sql);
        return $res->fetch()['sous_categorie'];
    }

}


// $produitbdd = ProduitModel::get_instance();
// $produit = $produitbdd->getProduitWithoutDesc("11");
// var_dump($produit);