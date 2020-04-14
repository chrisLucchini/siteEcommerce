<?php

class Image{

    
    public $config = HTTP."image";
    private $id_image;
    private $source;
    private $type;

    
    public function getSource(){return $this->source;}
    public function getId_image(){return $this->id_image;}
    public function getType(){return $this->type;}
    public function setId_image($id_image){$this->id_image = $id_image;}
    public function setSource($source){$this->source =$this->config.$source;}
    public function setType($type){$this->type = $type;}
}

// $img = new Image(1);
// echo("<img src='".$img->getSource()."'></img>");