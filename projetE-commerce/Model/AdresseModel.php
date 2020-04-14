<?php

require_once('Modele.php');

class AdresseModel extends Modele {

    private static $instance = null;

    const TABLE_ID = "id_adresse";
    const ATT_NOM = "prenom_nom";
    const ATT_VILLE = "ville";
    const ATT_ADR1 ="adresse_ligne1";
    const ATT_ADR2 ="adresse_ligne2";
    const ATT_REGION ="region";
    const ATT_CPD  ="code_postal";
    const ATT_TEL ="telephone";
    const ATT_IDUSER ="id_utilisateur";

    
    private function __construct() {


    }

    public static function get_instance() {

        if(is_null(self::$instance)) {

            self::$instance = new AdresseModel();
        }
        return self::$instance;

    }

    public function addAddress($data) {

        $sql = "INSERT INTO adresse (prenom_nom, ville, adresse_ligne1, adresse_ligne2, region, code_postal, telephone, id_utilisateur) VALUES('".$data[self::ATT_NOM]."','".$data[self::ATT_VILLE]."','".$data[self::ATT_ADR1]."','".$data[self::ATT_ADR2]."','".$data[self::ATT_REGION]."','".$data[self::ATT_CPD]."','".$data[self::ATT_TEL]."','".$data[self::ATT_IDUSER]."')";
        $this->executerRequete($sql);
        return $this->bdd->lastInsertId();
    }

    public function getAdresse($data) {

        $adresse = new Adresse();
        $adresse->setId_adresse($data[self::TABLE_ID]);
        $adresse->setPrenom_nom($data[self::ATT_NOM]);
        $adresse->setAdresse_ligne1($data[self::ATT_ADR1]);
        $adresse->setAdresse_ligne2($data[self::ATT_ADR2]);
        $adresse->setVille($data[self::ATT_VILLE]);
        $adresse->setRegion($data[self::ATT_REGION]);
        $adresse->setCode_postal($data[self::ATT_CPD]);
        $adresse->setTelephone($data[self::ATT_TEL]);

        return $adresse;


    }


}

// $data = ["prenom_nom" => "Christophe Lucchini", "ville" => "Ajaccio", "adresse_ligne1" => "Les hauts de petra di mare", "adresse_ligne2" => "Bat.D", "region" => "Corse", "code_postal" => "20090", "telephone" => "0620572922", "id_utilisateur" => "6"];

// $adrBdd = AdresseModel::get_instance();
// $adrBdd->addAddress($data);