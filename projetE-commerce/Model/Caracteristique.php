<?php

class Caracteristique {

    private $id_carac;
    private $type;
    private $valeur;
    private $typeValeur;
    private $categorie_produit;
    private $categorie_caracteristique;
    private $niveau;

    public function getId_carac(){return $this->id_carac;}
    public function getType(){return $this->type;}
    public function getValeur(){return $this->valeur;}
    public function getTypeValeur(){return $this->typeValeur;} 
    public function getCategorie_produit(){return $this->categorie_produit;}
    public function getCategorie_caracteristique(){return $this->categorie_caracteristique;}
    public function getNiveau(){return $this->niveau;}

    public function setId_carac($id_carac){$this->id_carac = $id_carac;}
    public function setType($type){$this->type = $type;}
    public function setValeur($valeur){$this->valeur = $valeur;}
    public function setTypeValeur($typeValeur){$this->typeValeur = $typeValeur;}
    public function setCategorie_produit($categorie_produit){$this->categorie_produit = $categorie_produit;}
    public function setCategorie_caracteristique($categorie_caracteristique){$this->categorie_caracteristique = $categorie_caracteristique;}
    public function setNiveau($niveau){$this->niveau = $niveau;}
}