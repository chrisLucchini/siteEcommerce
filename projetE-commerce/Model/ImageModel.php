<?php
// require_once("Modele.php");
require_once("Image.php");

class ImageModel extends Modele{

    private static $instance = null;
    const TABLE_ID = "id_image";
    const ATT_SOURCE = "source";
    const ATT_TYPE =  "type";
    const ATT_IDPROD =  "id_produit";

    private function __construct() {


    }

    public static function get_instance() {

        if(is_null(self::$instance)) {

            self::$instance = new ImageModel();
        }
        return self::$instance;
    }

    public function get_image($data) {

        $image = new Image();
        $image->setId_image($data[self::TABLE_ID]);
        $image->setSource($data[self::ATT_SOURCE]);
        $image->setType($data[self::ATT_TYPE]);

        return $image;


    }

    public function getImageProduitDescription($id_produit) {

        $sql = "SELECT * from image WHERE id_produit = '$id_produit' AND type = 'description'";

        $res = $this->executerRequete($sql);
        $donnees = $res->fetchAll();
        return $donnees;
    }

    public function get_image_description($id_image) {


        $sql = "SELECT * from image INNER JOIN description ON image.id_image = description.id_image WHERE description.id_image ='$id_image'";
        $res = $this->executerRequete($sql);
        $data = $res->fetch();
        $image = new Image();
        $image->setId_image($data[self::TABLE_ID]);
        $image->setSource($data[self::ATT_SOURCE]);
        $image->setType($data[self::ATT_TYPE]);

        return $image;


    }

    public function getIdImageWithSrc($src) {

        $sql = "SELECT * FROM image WHERE source = '$src'";
        $res = $this->executerRequete($sql);
        $donnees = $res->fetch();
        return $donnees;
    }

    public function addImage($source, $type, $id_produit) {

        $sql = "INSERT INTO image (source, type, id_produit) VALUES('$source', '$type', '$id_produit')";
        $this->executerRequete($sql);
    }

    public function getAllImageProduit($id_produit) {

        $sql = "SELECT * from image WHERE id_produit = '$id_produit'";
        $res = $this->executerRequete($sql);
        $donnees = $res->fetchAll();

        $images = [];

        foreach($donnees as $donnee) {

            $images[] = $this->get_image($donnee);
        }

        return $images;

    }

    public function deleteImage($id_image) {

        $sql = "DELETE FROM image WHERE id_image = '$id_image'";
        $this->executerRequete($sql);
    }

}