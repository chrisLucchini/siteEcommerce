 <?php
// session_start();

 class Panier {

    private $tabligne_commande = [];
    private $quantite_total = 0;
    private $montant_ttc = 0;
    private $montant_ht = 0;

    public function ajouterProduit($produit) {
        
        if(empty($this->tabligne_commande)){
            
            $ligneCommande = new LigneCommande($produit, $produit->getPrix(), $produit->getPrix_ttc());
            
            $this->tabligne_commande[$produit->getId_produit()] = $ligneCommande;
            
            $this->montant_ht += $produit->getPrix();
            $this->montant_ttc += $produit->getPrix_ttc();
            $this->quantite_total++;
            
            
        }
        else {
            
            if(!array_key_exists($produit->getId_produit(), $this->tabligne_commande)) {
                
                $ligneCommande = new LigneCommande($produit, $produit->getPrix(), $produit->getPrix_ttc());
                
                $this->tabligne_commande[$produit->getId_produit()] = $ligneCommande;
                $this->montant_ttc += $produit->getPrix_ttc();
                $this->montant_ht += $produit->getPrix();
                $this->quantite_total++;
                
            }//Si le produit existe deja dans le panier on augmente la quantite
            else{
                
                $this->tabligne_commande[$produit->getId_produit()]->increaseQte();
                $this->montant_ttc += $produit->getPrix_ttc();
                $this->montant_ht += $produit->getPrix();
                $this->quantite_total++;
            }
            
        }
        
    }
    
    public function enleverProduit($produit) {
        
        if(key_exists($produit->getId_produit(), $this->tabligne_commande)) {
            
            $reste = $this->tabligne_commande[$produit->getId_produit()]->decreaseQte();
            if($reste == 0) {
                
                unset($this->tabligne_commande[$produit->getId_produit()]);
            }
            $this->montant_ttc -= $produit->getPrix_ttc();
            $this->montant_ht -= $produit->getPrix();
            $this->quantite_total --;
        }
    }

    public function getTabligne_commande()
    {
        return $this->tabligne_commande;
    }

    public function getMontant_ttc()
    {
        return $this->montant_ttc;
    }

    public function getMontant_ht()
    {
        return $this->montant_ht;
    }

    /**
     * Get the value of quantite_total
     */ 
    public function getQuantite_total()
    {
        return $this->quantite_total;
    }
 }
