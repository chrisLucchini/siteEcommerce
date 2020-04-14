<?php
// require_once("Modele.php");
require_once("Description.php");

class DescriptionModel extends Modele{

    const TABLE_ID = "id_description";
    const ATT_TITRE = "titre_description";
    const ATT_TEXT =  "text_description";
    const ATT_CATEGORIE = "categorie_description";
    const ATT_IMAGE ="id_image";
    private static $instance = null;
    
    private function __construct() {


    }

    public static function get_instance() {

        if(is_null(self::$instance)) {

            self::$instance = new DescriptionModel();
        }
        return self::$instance;
    }

    public function get_description($data) {

        $description = new Description($data);
        //image description:
        $imagebdd = ImageModel::get_instance();
        $description->setImage_description($imagebdd->get_image_description($data['id_image'])->getSource());

        return $description;
    }

    public function get_description_with_id_produit($id_produit) {

        $sql = "SELECT * FROM description WHERE id_produit = '$id_produit'";
        $res = $this->executerRequete($sql);
        $donnees = $res->fetchAll();

        return $donnees;
    }

    public function updateDesc($id_description,$titre_description, $text_description, $id_image) {

        $sql = "UPDATE description SET titre_description = '$titre_description', text_description = '$text_description', id_image = '$id_image' WHERE id_description = '$id_description'";
        $this->executerRequete($sql);
    }

    public function addDesc($titre_description, $text_description,$categorie_description, $id_image, $id_produit) {

        if($id_image != null) {

            $sql = "INSERT INTO description (titre_description, text_description, categorie_description, id_image, id_produit) VALUES('$titre_description','$text_description', '$categorie_description', '$id_image', '$id_produit')";
        }
        else {
            $sql = "INSERT INTO description (titre_description, text_description, categorie_description, id_produit) VALUES('$titre_description','$text_description', '$categorie_description', '$id_produit')";
        }
        $this->executerRequete($sql);
    }

    public function deleteDescription($id_description) {

        $sql = "DELETE FROM description WHERE id_description ='$id_description'";
        $this->executerRequete($sql);
    }
}

// var_dump($description);