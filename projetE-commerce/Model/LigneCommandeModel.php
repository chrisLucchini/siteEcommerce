<?php

class LigneCommandeModel extends Modele{

    private static $instance = null;

    private function __construct() {


    }

    public static function get_instance() {

        if(is_null(self::$instance)) {

            self::$instance = new LigneCommandeModel();
        }
        return self::$instance;
    }

    public function addCommande($tva, $montant_ht, $montant_ttc, $id_utilisateur, $id_livraison, $id_facturation) {

        $sql = "INSERT INTO commande(tva, montant_ht, montant_ttc, id_utilisateur, id_adresse_livraison, id_adresse_facturation) VALUES('$tva', '$montant_ht', '$montant_ttc', '$id_utilisateur', '$id_livraison', '$id_facturation')";
        $res = $this->executerRequete($sql);
        return $this->bdd->lastInsertId();
    }

    public function addLigneCommande($id_commande, $id_produit, $quantite, $prix_unitaire_ht, $prix_unitaire_ttc) {
        $sql = "INSERT INTO lignecommande(id_commande, id_produit, quantite, prix_unitaire_ht, prix_unitaire_ttc) VALUES ('$id_commande', '$id_produit', '$quantite', '$prix_unitaire_ht', '$prix_unitaire_ttc')";
        $this->executerRequete($sql);
        
    }

    // public function getLastCommande($id_utilisateur) {

    //     $sql = "SELECT * from commande WHERE id_utilisateur = '$id_utilisateur' ORDER BY date_commande DESC";
    //     $res = $this->executerRequete($sql);
    //     $data = $res->fetch();
    //     return $data;
    // }

    public function getDataLigneCommande($id_utilisateur) {

        $sql = "SELECT * FROM commande INNER JOIN lignecommande ON commande.id_commande = lignecommande.id_commande INNER JOIN produit ON lignecommande.id_produit = produit.id_produit INNER JOIN image ON image.id_produit = produit.id_produit WHERE commande.id_utilisateur = '$id_utilisateur' AND image.type = 'principale'";
        $res = $this->executerRequete($sql);
        $data = $res->fetchAll();

        return $data;

    }

    public function getDataCommande($id_utilisateur) {

        $sql = "SELECT * FROM commande where id_utilisateur = '$id_utilisateur'";
        $res = $this->executerRequete($sql);
        $data = $res->fetchAll();

        return $data;
    }

    public function getCommande($id_utilisateur) {

        // on recupère les données ligne commande de l'id_utilisateur
        $dataLigneCommande = $this->getDataLigneCommande($id_utilisateur);
        // var_dump($dataLigneCommande);
        // On récupère les commande de l'utilisateurs:
        $dataCommande = $this->getDataCommande($id_utilisateur);
        $produitBdd = ProduitModel::get_instance();

        //Initialisation d'un tableau de commande
        $tableauCommandes = [];

        //on parcourt dataCommande
        foreach($dataCommande as $commandes) {

            //On instancie une nouvelle commande
            $commande = new Commande($commandes);

            //On parcourt notre tableau de donnée de ligneCommande             
            foreach($dataLigneCommande as $ligneCommande) {

                //Si l'id du tableau ligneCommande correspond à l'id du tableau commande
                if($ligneCommande['id_commande'] == $commandes['id_commande']) {

                    //On instancie une nouvelle ligneCommande
                    $ligneCom = new LigneCommande($produitBdd->getProduitCommande($ligneCommande), $ligneCommande['prix_unitaire_ht'], $ligneCommande['prix_unitaire_ttc']);
                    //On change la quantite avec ce qu'on a en base:
                    $ligneCom->setQuantite($ligneCommande['quantite']);
                    //On ajoute la ligne commande dans le tableau de commande
                    $commande->addInTabLigneCommande($ligneCom);

                }
    
    
            }
            //On ajoute la commande dans le tableau de commande
            array_push($tableauCommandes, $commande);
        }


        return $tableauCommandes;
    }
}