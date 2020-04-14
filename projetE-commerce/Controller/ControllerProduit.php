<?php
require_once("Model/ProduitModel.php");
class ControllerProduit {

    /**
     * Fonction de recuperation du produit
     */
    public function controlProd($id_product) {

        $produitBdd = ProduitModel::get_instance();
        $produit = $produitBdd->getProduitById($id_product);
        return $produit;
    }
    /**
     * On recupere tous les produits
     */
    public function getAllProduits($categorie) {

        $data = [];

        $produits = [];
        $marque = [];
        $carac = [];

        $produitBdd = ProduitModel::get_instance();
        $sous_categorie = $produitBdd->getSousCategorieByCategorie($categorie);
        $donnees = $produitBdd->getAllProductByCategorie($categorie);

        $caracBdd = CaracteristiqueModel::get_instance();
        foreach($sous_categorie as $cat) {

            $donneesCarac[$cat['sous_categorie']] = $caracBdd->get_all_principale_caracteristiques_categorie($cat['sous_categorie']);

        }
        foreach($donneesCarac as $key => $value) {

            foreach($value as $c){

                if(!array_key_exists ( $c['type'], $carac) ){
    
                    $carac[$c['type']] = [];
                    $carac[$c['type']][$c['id_carac']] = $c['valeur'];
    
                }
                else {
    
                    $carac[$c['type']][$c['id_carac']] = $c['valeur'];
                }
            }

        }

        

        foreach($donnees as $donnee) {

            $p = $produitBdd->getProduitById($donnee['id_produit']);
            $produits[] = $p;
            $marque[$p->getMarque()] = 0;
        }

        $data['produits'] = $produits;
        $data['marque'] = $marque;
        $data['caracteristiques'] = $carac;

        return $data;
        
    }

    public function getAllProduitsSousCategorie($categorie) {

        $data = [];

        $produits = [];
        $carac = [];
        $marque = [];

        $caracBdd = CaracteristiqueModel::get_instance();
        $donneesCarac = $caracBdd->get_all_principale_caracteristiques_categorie($categorie);
        foreach($donneesCarac as $c) {

            if(!array_key_exists ( $c['type'], $carac) ){

                $carac[$c['type']] = [];
                $carac[$c['type']][$c['id_carac']] = $c['valeur'];

            }
            else {

                $carac[$c['type']][$c['id_carac']] = $c['valeur'];
            }
        }

        $produitBdd = ProduitModel::get_instance();
        $donnees = $produitBdd->getAllProductBySousCategorie($categorie);

        foreach($donnees as $donnee) {

            $p = $produitBdd->getProduitById($donnee['id_produit']);
            $produits[] = $p;
            $marque[$p->getMarque()] = 0;
        }

        $data['produits'] = $produits;
        $data['caracteristiques'] = $carac;
        $data['marque'] = $marque;
        return $data;
        
    }
    public function getAllProduitsAdmin() {

        $produits = [];
        $produitBdd = ProduitModel::get_instance();
        $donnees = $produitBdd->getAllProducts();

        foreach($donnees as $donnee) {

            $produits[] = $produitBdd->getProduitById($donnee['id_produit']);
        }
        
        return $produits;
        
    }
    
    public function controlPost() {
        
        if(!empty($_POST[ProduitModel::$ATT_DESCPRODUIT])&& !empty($_POST[ProduitModel::$ATT_CATEGORIE]) && !empty($_POST[ProduitModel::$ATT_MODELE])&& !empty($_POST[ProduitModel::$ATT_DESIGNATION]) && !empty($_POST[ProduitModel::$ATT_PRIX])&& !empty($_POST[ProduitModel::$ATT_MARQUE]) && !empty($_POST[ProduitModel::$ATT_DESCTECHNIQUE])&& !empty($_POST[ProduitModel::$ATT_SOUS_CATEGORIE])) {

            $produitBdd = ProduitModel::get_instance();
            $data = [];
            foreach(ProduitModel::$CHAMP as $champ) {

                $data[$champ] = addslashes(htmlspecialchars($_POST[$champ]));
            }

            // var_dump($data);
            $id_produit = $produitBdd->addProduit($data);
            // $produit = $produitBdd->getProduitWithoutDesc($id_produit);
            // var_dump($id_produit);
            header("Location: http://localhost/dev_2019/siteEcommerce/projetE-commerce/?admin=addProduit&id_produit=$id_produit");

        }

    }

    public function controlAvis(){

        if(!empty($_POST['titre']) && !empty($_POST['texte_avis'])){

            if(!isset($_POST['rating'])){

                $rating = '0';
            }
            else{

                $rating = htmlspecialchars($_POST['rating']);
            }
            $titre = addslashes(htmlspecialchars($_POST['titre']));
            $texte_avis = addslashes(htmlspecialchars($_POST['texte_avis']));
            $id_user = $_GET['idUser'];
            $id_produit = $_GET['idProduct'];

            $avisBdd = AvisModel::get_instance();
            $avisBdd->addAvis([AvisModel::$ATT_IDUSER => $id_user,
                               AvisModel::$ATT_IDPRODUCT => $id_produit,
                               AvisModel::$ATT_TITRE => $titre,
                               AvisModel::$ATT_TEXTE => $texte_avis,
                               AvisModel::$ATT_NOTE => $rating]);
            header("Location: ".HTTP."?action=produit&idProduct=".$id_produit);
        }
        else {

            throw new Exception("Veuillez compléter le formulaire !");
        }
    }
    public function controlPostUpdate() {
        
        if(!empty($_POST[ProduitModel::$ATT_DESCPRODUIT])&& !empty($_POST[ProduitModel::$ATT_CATEGORIE]) && !empty($_POST[ProduitModel::$ATT_MODELE])&& !empty($_POST[ProduitModel::$ATT_DESIGNATION]) && !empty($_POST[ProduitModel::$ATT_PRIX])&& !empty($_POST[ProduitModel::$ATT_MARQUE]) && !empty($_POST[ProduitModel::$ATT_DESCTECHNIQUE])&& !empty($_POST[ProduitModel::$ATT_SOUS_CATEGORIE])) {

            $produitBdd = ProduitModel::get_instance();
            $data = [];
            foreach(ProduitModel::$CHAMP as $champ) {

                $data[$champ] = addslashes(htmlspecialchars($_POST[$champ]));
            }

            var_dump($data);
            $produitBdd->updateProduit($data, $_GET['id_produit']);
            // $produit = $produitBdd->getProduitWithoutDesc($id_produit);
            // var_dump($id_produit);
            header("Location: http://localhost/dev_2019/siteEcommerce/projetE-commerce/?admin=addProduit&id_produit=".$_GET['id_produit']);

        }

    }

    public function productFiltre() {

        $filtre = json_decode($_POST['filtres'], true);
        $marque = $_POST['marque'];
        $produitBdd = ProduitModel::get_instance();

        $id_produit1 = [];
        $id_produit2 = [];

        $data = [];
        $i = 0;
        if(!empty($filtre) || $marque != ""){
            
            if(!empty($filtre) && $marque != ""){

                foreach($filtre as $donnees) {
    
                    if($i == 0){
    
                        $id_carac = explode('-', $donnees)[0];
                        $idList = $produitBdd->getIdProduitWithIdCarac($id_carac);
                        foreach($idList as $c) {
    
                            $id_produit1[] = $c['id_produit'];
                        }
                        
                    }
                    else {
    
                        $id_carac = explode('-', $donnees)[0];
                        $idList = $produitBdd->getIdProduitWithIdCarac($id_carac);
                        foreach($idList as $c) {
    
                            $id_produit2[] = $c['id_produit'];
                        }
                        $id_produit1 = array_intersect($id_produit1, $id_produit2);
                        $id_produit2 = [];
    
                    }
                    $i++;
    
                }

                //On recupere les id liés à la marque
                $idBymarque = $produitBdd->getIdProductByMarque($marque);
                foreach($idBymarque as $idM){
                    //On les stocke dans un tableau
                    $id_produit2[] = $idM['id_produit'];
                }
                //Et on extrai les mêmes id correspondant aux caracteristques filtre.
                $id_produit1 = array_intersect($id_produit1, $id_produit2);
                foreach($id_produit1 as $id) {
        
                    $data[] = $produitBdd->getProduitById($id);
                }
        
                return $data;
            }
            else if($marque != "") {

                $marque = $_POST['marque'];
                $categorie = $_POST['categorie'];
                $produitBdd = ProduitModel::get_instance();

                $id_produit1 = [];
                $id_produit2 = [];

                $data = [];

                $idByCat = $produitBdd->getIdProductBycategorie($categorie);
                foreach($idByCat as $idC){
                    //On les stocke dans un tableau
                    $id_produit1[] = $idC['id_produit'];
                }

                //On recupere les id liés à la marque
                $idBymarque = $produitBdd->getIdProductByMarque($marque);
                foreach($idBymarque as $idM){
                    //On les stocke dans un tableau
                    $id_produit2[] = $idM['id_produit'];
                }

                $id_produit1 = array_intersect($id_produit1, $id_produit2);
                
                foreach($id_produit1 as $id) {
        
                    $data[] = $produitBdd->getProduitById($id);
                }
        
                return $data;


            }
            else if(!empty($filtre) ){

                foreach($filtre as $donnees) {
    
                    if($i == 0){
    
                        $id_carac = explode('-', $donnees)[0];
                        $idList = $produitBdd->getIdProduitWithIdCarac($id_carac);
                        foreach($idList as $c) {
    
                            $id_produit1[] = $c['id_produit'];
                        }
                        
                    }
                    else {
    
                        $id_carac = explode('-', $donnees)[0];
                        $idList = $produitBdd->getIdProduitWithIdCarac($id_carac);
                        foreach($idList as $c) {
    
                            $id_produit2[] = $c['id_produit'];
                        }
                        $id_produit1 = array_intersect($id_produit1, $id_produit2);
                        $id_produit2 = [];
    
                    }
                    $i++;
    
                }

                foreach($id_produit1 as $id) {
        
                    $data[] = $produitBdd->getProduitById($id);
                }
        
                return $data;

            }
        }
        else{

            return "vide";
        }
    }
}