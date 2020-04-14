<?php
class LigneCommande{

    private $produit;
    private $quantite;
    private $prix_ht;
    private $prix_ttc;

    public function __construct($produit, $prix_ht, $prix_ttc) {

        $this->produit = $produit;
        $this->prix_ht = $prix_ht;
        $this->prix_ttc = $prix_ttc;
        $this->quantite = 1;
    }

    public function increaseQte() {

        $this->quantite++;
    }
    public function decreaseQte() {

        $this->quantite--;
        return $this->quantite;
    }

    public function getProduit(){return $this->produit;}
    public function getQuantite(){return $this->quantite;}
    public function getPrix_ht(){return $this->prix_ht;}
    public function getPrix_ttc(){return $this->prix_ttc;}
    
    public function setProduit($produit){$this->produit = $produit;}
    public function setQuantite($quantite){$this->quantite = $quantite;}
    public function setPrix_ht($prix_ht){$this->prix_ht = $prix_ht;}
    public function setPrix_ttc($prix_ttc){$this->prix_ttc = $prix_ttc;}

}