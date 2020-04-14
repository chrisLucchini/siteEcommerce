<?php

class Adresse {

    private $id_adresse;
    private $prenom_nom;
    private $ville;
    private $adresse_ligne1;
    private $adresse_ligne2;
    private $region;
    private $code_postal;
    private $telephone;

    public function getId_adresse(){return $this->id_adresse;}
    public function getPrenom_nom(){return $this->prenom_nom;}
    public function getVille(){return $this->ville;}
    public function getAdresse_ligne1(){return $this->adresse_ligne1;} 
    public function getAdresse_ligne2(){return $this->adresse_ligne2;} 
    public function getRegion(){return $this->region;} 
    public function getCode_postal(){return $this->code_postal;}
    public function getTelephone(){return $this->telephone;}

    public function setId_adresse($id_adresse){$this->id_adresse = $id_adresse;}
    public function setPrenom_nom($prenom_nom){$this->prenom_nom = $prenom_nom;}
    public function setVille($ville){$this->ville = $ville;}
    public function setAdresse_ligne1($adresse_ligne1){$this->adresse_ligne1 = $adresse_ligne1;}
    public function setAdresse_ligne2($adresse_ligne2){$this->adresse_ligne2 = $adresse_ligne2;} 
    public function setRegion($region){$this->region = $region;}
    public function setCode_postal($code_postal){$this->code_postal = $code_postal;}
    public function setTelephone($telephone){$this->telephone = $telephone;}

}