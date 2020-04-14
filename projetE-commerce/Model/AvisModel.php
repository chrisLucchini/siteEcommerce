<?php
require_once('Modele.php');
class AvisModel extends Modele {

    private static $instance = null;
    public static $TABLE_ID = "id_avis";
    public static $ATT_IDUSER = "id_utilisateur";
    public static $ATT_IDPRODUCT =  "id_produit";
    public static $ATT_NOTE = "note";
    public static $ATT_TITRE ="titre";
    public static $ATT_TEXTE ="texte_avis";

    public static $CHAMP = [];

    private function __construct() {

        self::$CHAMP[] = self::$ATT_IDUSER;
        self::$CHAMP[] = self::$ATT_IDPRODUCT;
        self::$CHAMP[] = self::$ATT_NOTE;
        self::$CHAMP[] = self::$ATT_TITRE;
        self::$CHAMP[] = self::$ATT_TEXTE;

    }
    public static function get_instance() {

        if(is_null(self::$instance)) {

            self::$instance = new AvisModel();
        }
        return self::$instance;

    }

    public function getAvis($donnees) {

        return new Avis($donnees);
    }

    public function addAvis($donnees) {

        $champ = "(";
        $values = "(";

        foreach(self::$CHAMP as $c) {

            $champ .= $c .",";
            $values .= "'".$donnees[$c]."',";


        }

        $champ = substr_replace($champ, ")", -1);
        $values = substr_replace($values, ")", -1);
        $this->saveData("avis", $champ, $values);

    }

    public function getDataAvis($champ = "*", $where = null) {

        $reqChamp = $champ;
        if(is_array($champ)) {
            
            $reqChamp = "";
            foreach($champ as $c){
                
                $reqChamp .= $c.", ";
                
            }
        }
        if(is_array($where)) {
            
            $reqWhere = "";
            foreach(self::$CHAMP as $values){

                if(key_exists($values, $where)) {

                    $reqWhere .= $values." = '". $where[$values]."' AND ";

                }

            }
        }

        if($where != null && $reqChamp != "*"){
            $reqChamp = substr_replace($reqChamp, "", -2);
            $reqWhere = substr_replace($reqWhere, "", -4);
            $donnees = $this->selectData("avis", $reqWhere, $reqChamp);
            
        }
        else if($where != null && $reqChamp == "*"){
            
            $reqWhere = substr_replace($reqWhere, "", -4);
            $donnees = $this->selectData("avis", $reqWhere, $reqChamp);
            
        }
        else if($where == null && $reqChamp != "*"){
            
            $reqChamp = substr_replace($reqChamp, "", -2);
            $donnees = $this->selectData("avis", $where, $reqChamp);
        }
        else {

            $donnees = $this->selectData("avis");
        }

        return $donnees->fetchAll(PDO::FETCH_ASSOC);

    }
}

// $donnees = [];
// $donnees[AvisModel::$ATT_IDPRODUCT] = 3;
// $donnees[AvisModel::$ATT_IDUSER] = 12;
// $donnees[AvisModel::$ATT_NOTE] = 5;
// $donnees[AvisModel::$ATT_TITRE] = "titre de mon avis";
// $donnees[AvisModel::$ATT_TEXTE] = "texte de mon avis";
// $aBdd = AvisModel::get_instance();

// $aBdd->addAvis($donnees);

// $donnees = $aBdd->getDataAvis(['note', 'id_avis'], ['note' => 5, 'id_utilisateur' => 12]);
// var_dump($donnees);