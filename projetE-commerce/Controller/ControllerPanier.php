<?php

class ControllerPanier {

    /**
     * On recupère le produit à ajouter par l'utilisateur pour l'ajouter au panier
     */
    public function controlPanier($id_produit) {

        $produitBdd = ProduitModel::get_instance();
        $produit = $produitBdd->getProduitById($id_produit);
        $_SESSION['user']->getPanier()->ajouterProduit($produit);

        // header('Location: http://localhost/dev_2019/siteEcommerce/projetE-commerce/testPanier.php');
    }
    /**
     * On enleve le produit choisis par l'utilisateur du panier (Quantite x1)
     */
    public function decreasePanier($id_produit) {

        $produitBdd = ProduitModel::get_instance();
        $produit = $produitBdd->getProduitById($id_produit);
        $_SESSION['user']->getPanier()->enleverProduit($produit);

        // header('Location: http://localhost/dev_2019/siteEcommerce/projetE-commerce/testPanier.php');
    }

    /**
     * On controle la commande à valider
     */
    public function controlCommande() {

        //On récupere en post l'id de l'adresse de livraison
        if(!empty($_POST['adr_livraison'])) {
            
            $panier = $_SESSION['user']->getPanier();

            $tva = Produit::$TVA ."%";
            $montant_ht = $panier->getMontant_ht();
            $montant_ttc = $panier->getMontant_ttc();
            $id_utilisateur = $_SESSION['user']->getId_utilisateur();
            $id_livraison = $_POST['adr_livraison'];
            $id_facturation = $_POST['adr_livraison'];
            $commandeBdd = LigneCommandeModel::get_instance();
            //On ajoute la commande en base
            $id_commande = $commandeBdd->addCommande($tva, $montant_ht, $montant_ttc, $id_utilisateur, $id_livraison, $id_facturation);
            /* On parcours le tableau de lignecommande de notre panier pour inserer
            chaque ligne avec l'id_commande qui vient d'être créer */
            foreach($panier->getTabligne_commande() as $ligneCommande) {

                $commandeBdd->addLigneCommande($id_commande, $ligneCommande->getProduit()->getId_produit(), $ligneCommande->getQuantite(), $ligneCommande->getProduit()->getPrix(), $ligneCommande->getProduit()->getPrix_ttc());
            }

            //On remet à zero le panier
            $_SESSION['user']->setPanier(new Panier());
            throw New Exception("Commande Validé !");

        }
        //Si l'adresse n'est pas choisis on ne valide pas la commande
        else {

            header('Location: http://localhost/dev_2019/siteEcommerce/projetE-commerce/?action=submitOrder');
        }
    }
}