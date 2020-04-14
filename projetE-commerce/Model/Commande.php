<?php

class Commande {

    private $id_commande;
    private $tva;
    private $montant_ht;
    private $montant_ttc;
    private $date_commande;
    private $id_utilisateur;
    private $id_adresse_livraison;
    private $id_adresse_facturation;
    private $tabLigneCommande = [];

    public function __construct($data) {

        $this->setId_commande($data['id_commande']);
        $this->setTva($data['tva']);
        $this->setMontant_ht($data['montant_ht']);
        $this->setMontant_ttc($data['montant_ttc']);
        $this->setDate_commande($data['date_commande']);
        $this->setId_utilisateur($data['id_utilisateur']);
        $this->setId_adresse_livraison($data['id_adresse_livraison']);
        $this->setId_adresse_facturation($data['id_adresse_facturation']);
        
    }

    public function addInTabLigneCommande($ligneCommande) {

        array_push($this->tabLigneCommande, $ligneCommande); 
    }

    public function getId_commande(){return $this->id_commande;} 
    public function getTva(){return $this->tva;}
    public function getMontant_ht(){return $this->montant_ht;}
    public function getMontant_ttc(){return $this->montant_ttc;}
    public function getDate_commande(){return $this->date_commande;}
    public function getId_utilisateur(){return $this->id_utilisateur;}
    public function getId_adresse_livraison(){return $this->id_adresse_livraison;}
    public function getId_adresse_facturation(){return $this->id_adresse_facturation;}
    public function getTabLigneCommande(){return $this->tabLigneCommande;}

    public function setId_commande($id_commande){$this->id_commande = $id_commande;}
    public function setTva($tva){$this->tva = $tva;}
    public function setMontant_ht($montant_ht){$this->montant_ht = $montant_ht;}
    public function setMontant_ttc($montant_ttc){$this->montant_ttc = $montant_ttc;}
    public function setDate_commande($date_commande){$this->date_commande = $date_commande;}
    public function setId_utilisateur($id_utilisateur){$this->id_utilisateur = $id_utilisateur;}
    public function setId_adresse_livraison($id_adresse_livraison){$this->id_adresse_livraison = $id_adresse_livraison;}
    public function setId_adresse_facturation($id_adresse_facturation){$this->id_adresse_facturation = $id_adresse_facturation;}
    public function setTabLigneCommande($tabLigneCommande){$this->tabLigneCommande = $tabLigneCommande;}


}