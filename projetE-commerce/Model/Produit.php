<?php

class Produit{


    public static $TVA = 20;

    private $id_produit;
    private $categorie;
    private $sous_categorie;
    private $modele;
    private $designation;
    private $prix;
    private $marque;
    private $mini_description_technique;
    private $mini_description_produit;
    private $caracteristiques = [];
    private $descriptions = [];
    private $images = [];
    private $avis = [];

    public function __construct($data = null) {

        if(is_array($data)) {

            $this->hydrate($data);

        }
    }

    public function hydrate($donnees)
    {
        foreach ($donnees as $key => $value)
        {
            // On récupère le nom du setter correspondant à l'attribut.
            $method = 'set'.ucfirst($key);
                
            // Si le setter correspondant existe.
            if (method_exists($this, $method))
            {
            // On appelle le setter.
            $this->$method($value);
            }
        }
    }

    public function getCountAvis() {

        return count($this->getAvis());
    }

    public function avgAvis(){

        $somme = 0;
        foreach($this->getAvis() as $avis) {

            $somme += $avis->getNote();
        }

        return ceil($somme / $this->getCountAvis());
    }


    public function initDescriptions($descriptionsBdd) {

        array_push($this->descriptions, $descriptionsBdd);
    }
    public function initImage($imageBdd) {

        array_push($this->images, $imageBdd);
    }
    public function initCaracteristiques($caracBdd) {

        array_push($this->caracteristiques, $caracBdd);
    }
    public function initAvis($avis) {

        array_push($this->avis, $avis);
    }

    public function get_categorie_caracteristique_in_array(){

        $categorieCarac = [];
        foreach($this->caracteristiques as $caracteristique){

            array_push($categorieCarac, $caracteristique->getCategorie_caracteristique());
        }
        $categorieCarac = array_unique($categorieCarac);

        return $categorieCarac;
    }

    public function getId_produit(){return $this->id_produit;}
    public function getCategorie(){return $this->categorie;}
    public function getSous_categorie(){return $this->sous_categorie;}
    public function getModele(){return $this->modele;}
    public function getDesignation(){return $this->designation;}
    public function getPrix(){return $this->prix;}
    public function getMarque(){return $this->marque;}
    public function getDescriptions(){return $this->descriptions;}
    public function getCaracteristiques(){return $this->caracteristiques;}
    public function getMini_description_technique(){return $this->mini_description_technique;}
    public function getMini_description_produit(){return $this->mini_description_produit;}
    public function getImages(){return $this->images;}
    public function getPrix_ht() {return $this->prix;}
    public function getPrix_ttc() {return round($this->prix * ((self::$TVA / 100) + 1 ), 2);}
    public function getAvis(){return $this->avis;}

    
    public function setId_produit($id_produit){$this->id_produit = $id_produit;}
    public function setCategorie($categorie){$this->categorie = $categorie;}
    public function setSous_categorie($sous_categorie){$this->sous_categorie = $sous_categorie;}
    public function setModele($modele){$this->modele = $modele;}
    public function setDesignation($designation){$this->designation = $designation;}
    public function setPrix($prix){$this->prix = $prix;}
    public function setMarque($marque){$this->marque = $marque;}
    public function setDescriptions($descriptions){$this->descriptions = $descriptions;}
    public function setMini_description_produit($mini_description_produit){$this->mini_description_produit = $mini_description_produit;}
    public function setMini_description_technique($mini_description_technique){$this->mini_description_technique = $mini_description_technique;}
    public function setAvis($avis){$this->avis = $avis;}

    
    public function getImagePrincipale(){

        $images = $this->getImages();
        foreach($images as $image) {

            if($image->getType() == "principale"){

                return $image->getSource();
            }
        }
    }

}

// $produit = new Produit(1);
// var_dump($produit);