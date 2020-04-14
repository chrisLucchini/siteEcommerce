<?php
// require_once("./projetE-commerce/config.inc.php");
abstract class Modele {

    // Objet PDO
    protected $bdd;
    
    protected function executerRequete($sql) {
        
        $resultat = $this->getBdd()->query($sql);
        // $this->closeBdd();
        
        return $resultat;
        


    }

    public function closeBdd() {

        $this->bdd = null;
    }

    private function getBdd() {
        
        try {
            $this->bdd = new PDO(DSN, USER, PSWD);
        } catch (PDOException $e) {
            echo 'Connexion échouée : ' . $e->getMessage();
        }

        return $this->bdd;

    }

    protected function saveData($table, $champ, $values) {

        $sql = "INSERT INTO $table $champ VALUES $values";
        // echo($sql);
        $this->executerRequete($sql);
    }

    protected function selectData($table, $where = null, $champ = '*') {

        if($where != null) {

            $sql = "SELECT $champ FROM $table WHERE $where";
        }
        else {

            $sql = "SELECT $champ FROM $table";
        }

        return $this->executerRequete($sql);

    }

}