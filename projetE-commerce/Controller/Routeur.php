<?php


class Routeur {

    private $ctrlConnect;
    private $ctrlRegister;
    private $ctrlProduct;
    private $ctrlPanier;
    private $ctrlAdresse;
    private $ctrlCommande;
    private $ctrlUser;
    private $ctrlImage;
    private $ctrlDescription;
    private $ctrlCaracteristiques;


    public function __construct() {

        $this->ctrlRegister = new ControllerRegistration();
        $this->ctrlConnect = new ControllerConnection();
        $this->ctrlProduct = new ControllerProduit();
        $this->ctrlPanier = new ControllerPanier();
        $this->ctrlAdresse = new ControllerAdresse();
        $this->ctrlCommande = new ControllerCommande();
        $this->ctrlUser = new ControllerUser();
        $this->ctrlImage = new ControllerImage();
        $this->ctrlDescription = new ControllerDescription();
        $this->ctrlCaracteristiques = new ControllerCaracteristiques();
    }

    public function routerRequete() {

        try {

            if(isset($_GET['action'])) {

                if($_GET['action'] == "registration" && isset($_POST["pseudo"])) {

                    $this->ctrlRegister->controlPost();
                }
                else if($_GET['action'] == "login"  && isset($_POST["pseudo"])) {

                    $this->ctrlConnect->controlPost();
                }
                else if($_GET['action'] == "deconnect") {

                    $this->ctrlConnect->deconnect();
                }
                else if($_GET['action'] == "registration") {

                    $vue = new View("Registration.php");
                    $title = $_GET['action'];
                    $vue->genere(null, $title);
                }
                else if($_GET['action'] == "login") {

                    $vue = new View("Connection.php");
                    $title = $_GET['action'];
                    $vue->genere(null, $title);
                }

                if($_GET['action'] == "addAvis") {

                    $this->ctrlProduct->controlAvis();
                }

                else if($_GET['action'] == "submitOrder" && isset($_SESSION['user'])) {

                    $vue = new View("Address.php");
                    $vue->genere();
                }
                else if($_GET['action'] == "addAddress" && isset($_GET['submit']) && isset($_SESSION['user'])) {

                    $this->ctrlAdresse->controlPost();
                    $vue = new View("Address.php");
                    $vue->genere();
                }
                else if($_GET['action'] == "addAddress" && isset($_SESSION['user'])) {

                    $vue = new View("AddressForm.php");
                    $vue->genere();
                }

                else if($_GET['action'] == "commande" && isset($_SESSION['user'])) {

                    $this->ctrlPanier->controlCommande();
                }
    
                else if($_GET['action'] == "decreasePanier" && isset($_GET['id_produit']) && isset($_SESSION['user'])) {

                    $vue = new View("Panier.php");
                    $this->ctrlPanier->decreasePanier($_GET['id_produit']);
                    $title = $_GET['action'];

                    $vue->genere(null, $title);
                }

                else if($_GET['action'] == "panier" && isset($_GET['id_produit']) && isset($_SESSION['user'])) {

                    $this->ctrlPanier->controlPanier($_GET['id_produit']);
                    // echo($_SESSION['user']->getPanier()->getQuantite_total());

                }
                else if($_GET['action'] == "panier") {

                    if(isset($_SESSION['user'])) {
                        
                        $vue = new View("Panier.php");
                        $title = $_GET['action'];
    
                        $vue->genere(null, $title);
                    }
                    else{

                        throw new Exception("Veuillez vous connecter afin d'accéder à votre panier");
                    }


                }
                else if($_GET['action'] == "produit" && isset($_GET['idProduct'])) {

                    $vue = new View("Product.php");
                    $title = $_GET['action'];
                    $donnees = $this->ctrlProduct->controlProd($_GET['idProduct']);

                    $vue->genere($donnees, $title);
                    
                }
                else if($_GET['action'] == "categorie" && isset($_GET['categorie'])) {

                    $vue = new View("allProducts.php");
                    $donnees = $this->ctrlProduct->getAllProduits($_GET['categorie']);
                    $title = $_GET['categorie'];
                    $vue->genere($donnees, $title);
                }
                else if($_GET['action'] == "sous_categorie" && isset($_GET['sous_categorie'])) {

                    $vue = new View("allProducts.php");
                    $donnees = $this->ctrlProduct->getAllProduitsSousCategorie($_GET['sous_categorie']);
                    $title = $_GET['sous_categorie'];
                    $vue->genere($donnees, $title);
                }
                else if($_GET['action'] == "ajaxFiltre") {

                    $donnees = $this->ctrlProduct->productFiltre();
                    // print_r($donnees);
                    if($donnees != "vide") {

                        $vue = new View('AjaxProductFilter.php');
                        $vue->genereFichier($donnees);
                    }
                    else {

                        echo('null');
                    }
                }

                else if ($_GET['action'] == "mesCommandes" && isset($_SESSION['user'])) {

                    $vue = new View("MesCommandes.php");
                    $commande = $this->ctrlCommande->controlCommande();
                    $vue->genere($commande, "Mes commandes");
                }

                else if($_GET['action'] == 'getCountPanier') {

                    echo($_SESSION['user']->getPanier()->getQuantite_total());
                }
                else {
                    $vue = new View("Accueil.php");
                    $vue->genere();

                }
                
            }
            else {
                $vue = new View("Accueil.php");
                $vue->genere();
            }
        }
        catch(Exception $e) {

            $erreur = $e->getMessage();
            $vue = new View("Erreur", $erreur);
            $vue->genereErreur();
        }
    }

    public function requeteAdmin() {

        try{
            
            if(isset($_GET['admin'])) {

                $admin = $_GET['admin'];

                if($admin == "accueil") {

                    $vue = new View("Admin.php");
                    $vue->genere();

                }
                else if($admin == "utilisateur" && isset($_GET['id_user'])) {

                    $user = $this->ctrlUser->controlUser($_GET['id_user']);
                    $vue = new View("UtilisateurAdmin.php");
                    $vue->genere($user, "Admin Utilisateur");


                }
                else if($admin == "utilisateurs") {

                    $donnees = $this->ctrlUser->controlDisplayUsers();
                    $vue = new View("Utilisateurs.php");
                    $vue->genere($donnees, "Admin Utilisateur");


                }
                else if($admin == "updateUser" && isset($_GET['id_user'])) {

                    $this->ctrlUser->controlUpdateUser($_GET['id_user']);

                    
                }
                else if($admin == "deleteUser" && isset($_GET['id_user'])) {

                    $this->ctrlUser->controlDeleteUser($_GET['id_user']);

                    
                }
                else if($admin == "produits") {

                    $vue = new View("AdminProduits.php");
                    $vue->genere();
                }
                else if($admin == "formProduit" && isset($_GET['id_produit'])) {

                    $vue = new View("FormUpdateProduit.php");
                    $produitBdd = ProduitModel::get_instance();
                    $produit = $produitBdd->getProduitWithoutDesc($_GET['id_produit']);
                    $vue->genere($produit);
                }
                else if($admin == "formProduit") {

                    $vue = new View("FormProduit.php");
                    $vue->genere();
                }

                else if($admin == "updateInfoProduit") {

                    $this->ctrlProduct->controlPostUpdate();

                }
                else if($admin == "addProduit" && isset($_GET['id_produit'])) {

                    $produitBdd = ProduitModel::get_instance();
                    $produit = $produitBdd->getProduitWithoutDesc($_GET['id_produit']);
                    $vue = new View("UpdateProduit.php");
                    $vue->genere($produit, "fiche produit");
                }
                else if($admin == "addProduit") {

                    $this->ctrlProduct->controlPost();
                }
                else if($admin == "addImage" && isset($_GET['id_produit'])) {

                    $donnees = $this->ctrlImage->get_image($_GET['id_produit']);
                    $vue = new View("FormAddImage.php");
                    $vue->genere($donnees, "Gestion image produit");
                    $this->ctrlImage->controlPost();
                }
                else if($admin == "addDescription" && isset($_GET['id_produit'])) {

                    $donnees = [];
                    $donnees["description"] = $this->ctrlDescription->getDesc($_GET['id_produit']);
                    $donnees["images"] = $this->ctrlDescription->getImgDesc($_GET['id_produit']);
                    $vue = new View("FormAddDesc.php");
                    $vue->genere($donnees, "Ajout de description");
                }
                else if($admin == "updateProduit") {

                    $vue = new View("allProductsAdmin.php");
                    $donnees = $this->ctrlProduct->getAllProduitsAdmin();
                    $title = "produits";
                    $vue->genere($donnees, $title);
                }
                else if($admin == "controlDesc") {

                    $this->ctrlDescription->controlAjaxPostUpdate();
                }
                else if($admin == "addDescAjax") {

                    $this->ctrlDescription->controlAjaxPostAdd();
                }
                else if($admin == "addCarac" && !empty($_GET['id_produit'])) {
                    
                    $donnees = $this->ctrlCaracteristiques->getInformation($_GET['id_produit']);
                    $vue = new View("Caracteristiques.php");
                    $vue->genere($donnees, "Gestion des caracteristiques");
                }
                
                /* AJAX */
                
                else if($admin == "deleteImgAjax") {

                    $this->ctrlImage->deleteImage();
                }
                else if($admin == "delDescAjax") {

                    $this->ctrlDescription->deleteDescription();
                }

                else if($admin == "getValeurCaracAjax") {

                   $this->ctrlCaracteristiques->getValeur();
                }
                else if($admin == "updateCaracAjax") {

                   $this->ctrlCaracteristiques->updateCarac();
                }
                else if($admin == "addCaracAjax") {

                   $this->ctrlCaracteristiques->addCarac();
                }
                else if($admin == "getTdHtmlAddCarac") {

                   $this->ctrlCaracteristiques->getHtmlAjaxCarac();
                }
                else if($admin == "getHtmlForCreateCarac") {

                   $this->ctrlCaracteristiques->getHtmlCreateCarac();
                }
                else if($admin == "createCaracAjax") {

                   $this->ctrlCaracteristiques->createCarac();
                }
                else if($admin == "deleteCaracAjax") {

                   $this->ctrlCaracteristiques->deleteCarac();
                }
                else{

                    $vue = new View("Admin.php");
                    $vue->genere();
                }
    
            }
            else {
    
                $this->routerRequete();
            }
        }
        catch(Exception $e) {

            $erreur = $e->getMessage();
            $vue = new View("Erreur", $erreur);
            $vue->genereErreur();
        }
        
    }
}