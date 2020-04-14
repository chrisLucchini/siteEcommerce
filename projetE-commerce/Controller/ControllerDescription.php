<?php

class ControllerDescription{

    public function getDesc($id_produit) {

        $descriptionBdd = DescriptionModel::get_instance();
        $descriptions = [];
        $donnees_description = $descriptionBdd->get_description_with_id_produit($_GET['id_produit']);

        foreach($donnees_description as $description) {

            $descriptions[] = $descriptionBdd->get_description($description);

        }
        return $descriptions;
    }

    public function getImgDesc($id_produit) {

        $imageBdd = ImageModel::get_instance();
        $images = [];
        $donnees_image = $imageBdd->getImageProduitDescription($id_produit);

        foreach($donnees_image as $image) {

            $images[] = $imageBdd->get_image($image);
        }

        return $images;
    }

    public function controlAjaxPostUpdate() {

        if(!empty($_POST['text']) && !empty($_POST['titre_description']) && !empty($_POST['categorie_description']) && !empty($_POST['id_produit'])){

            $text_description = addslashes($_POST['text']);
            $titre_description = addslashes($_POST['titre_description']);
            $id_description = $_POST['id_description'];
            $source_image = $_POST['src_image'];
            $source_image = str_replace("http://localhost/dev_2019/siteEcommerce/projetE-commerce/image", "", $source_image);
            $source_image = str_replace("%20", " ", $source_image);
    
            $imageBdd = ImageModel::get_instance();
            $id_image = $imageBdd->getIdImageWithSrc($source_image)['id_image'];
            // echo($source_image);
            // echo($id_image);
            // echo($titre_description);
            // echo($text_description);
            // echo($id_description);
    
    
            $descriptionBdd = DescriptionModel::get_instance();
            $descriptionBdd->updateDesc($id_description, $titre_description, $text_description, $id_image);
        }

    }

    public function controlAjaxPostAdd() {

        if(!empty($_POST['text']) && !empty($_POST['titre_description']) && !empty($_POST['categorie_description']) && !empty($_POST['id_produit'])) {

            $text_description = addslashes($_POST['text']);
            $titre_description = addslashes($_POST['titre_description']);
            $categorie_description = $_POST['categorie_description'];
            $source_image = htmlspecialchars_decode($_POST['src_image']);
            $id_produit = $_POST['id_produit'];
            if($source_image != ""){
                
                $source_image = str_replace("http://localhost/dev_2019/siteEcommerce/projetE-commerce/image", "", $source_image);
                $source_image = str_replace("%20", " ", $source_image);
            }
            else {
                
                $source_image = null;
            }
    
            $imageBdd = ImageModel::get_instance();
            if($source_image != null) {
                
                $data = $imageBdd->getIdImageWithSrc($source_image);
                $source_image = $data['id_image'];
                $id_produit = $data['id_produit'];
            }
    
            $descriptionBdd = DescriptionModel::get_instance();
            $descriptionBdd->addDesc($titre_description, $text_description,$categorie_description, $source_image, $id_produit);
        }

    }

    public function deleteDescription() {

        if(isset($_POST['id_desc'])) {

            $descriptionBdd = DescriptionModel::get_instance();
            $descriptionBdd->deleteDescription($_POST['id_desc']);

            echo($_POST['id_desc']);
        }
    }
}