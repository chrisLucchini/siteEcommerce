<?php

class View {

    private $fichier;
    private $erreur;

    public function __construct($fichier, $erreur=null) {

        if($fichier != "Erreur") {

            $this->fichier = "View/view".$fichier;
        }
        else {
            $this->erreur = $erreur;
            $this->fichier = "View/view".$fichier.".php";
        }
    }

    public function genere($donnees = null, $title = "HighTech") {

        $produitBdd = ProduitModel::get_instance();
        $categorieLayout = $produitBdd->getAllCategorie();
        $sous_categorieLayout = $produitBdd->getAllSousCategorie();

        ob_start();
        require_once($this->fichier);

        $contenu = ob_get_clean();
        require_once("layout.php");
        
    }

    public function genereErreur() {

        $produitBdd = ProduitModel::get_instance();
        $categorieLayout = $produitBdd->getAllCategorie();
        $sous_categorieLayout = $produitBdd->getAllSousCategorie();
        $title = "Erreur";
        $erreur = $this->erreur;
        ob_start();

        require_once($this->fichier);

        $contenu = ob_get_clean();
        require_once("layout.php");
    }

    public function genereFichier($donnees = null) {

        require_once($this->fichier);
    }
}