<?php
class Description{

    private $id_description;
    private $titre_description;
    private $text_description;
    private $categorie_description;
    private $image_description;

    public function __construct($data) {

        $this->id_description = $data[DescriptionModel::TABLE_ID];
        $this->titre_description = $data[DescriptionModel::ATT_TITRE];
        $this->text_description = $data[DescriptionModel::ATT_TEXT];
        $this->categorie_description = $data[DescriptionModel::ATT_CATEGORIE];
        $this->image_description = $data[DescriptionModel::ATT_IMAGE];
    }

    public function getId_description(){return $this->id_description;}
    public function getTitre_description(){return $this->titre_description;}
    public function getText_description(){return $this->text_description;}
    public function getCategorie_description(){return $this->categorie_description;}
    public function getImage_description(){return $this->image_description;}
    
    public function setId_description($id_description){$this->id_description = $id_description;}
    public function setTitre_description($titre_description){$this->titre_description = $titre_description;}
    public function setText_description($text_description){$this->text_description = $text_description;}
    public function setCategorie_description($categorie_description){$this->categorie_description = $categorie_description;}
    public function setImage_description($image_description){$this->image_description = $image_description;}
}

// $description = new Description(1);
// echo($description->getText_description());
// var_dump($description);