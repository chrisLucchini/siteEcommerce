<?php
class ControllerCaracteristiques{

    public function getInformation($id_produit) {

        $data = [];

        $produitBdd = ProduitModel::get_instance();
        $produit = $produitBdd->getProduitById($id_produit);
        $data['produit'] = $produit;

        $caracBdd = CaracteristiqueModel::get_instance();
        $caracteristiques = $caracBdd->get_all_caracteristiques_categorie($produit->getSous_categorie());
        $categorie_carac = $caracBdd->getCategorieCarac($produit->getSous_categorie());
        
        foreach($categorie_carac as $cat) {

            $data['categorie_carac'][] = $cat['categorie_caracteristique'];
        }
        $data['caracteristiques'] = $caracteristiques['caracteristiques'];
        $data['type'] = $caracteristiques['type'];

        return $data;

    }

    public function getValeur() {

        $donnees = [];
        $donnees['id_select'] = $_GET['id_select'];

        $type = addslashes($_GET['type']);
        $produitBdd = ProduitModel::get_instance();
        $produit = $produitBdd->getProduitById($_GET['id_produit']);
        // echo($produit->getSous_categorie());

        $caracBdd = CaracteristiqueModel::get_instance();
        $valeurs = $caracBdd->getValeurOnType($type, trim($produit->getSous_categorie()));
        $donnees['valeurs'] = $valeurs;
        
        echo(json_encode($donnees));
    }

    public function updateCarac() {

        $valeurs = json_decode($_POST['valeur']);
        $type = json_decode($_POST['type']);
        $niveau = json_decode($_POST['niveau']);
        $id_caracOld = json_decode($_POST['id_carac']);
        $caracBdd = CaracteristiqueModel::get_instance();
        $produitBdd = ProduitModel::get_instance();
        $categorie = $produitBdd->getSous_categorie_produit($_POST['id_produit']);
        for($i = 0; $i< count($valeurs); $i++) {

            $id_carac = $caracBdd->getIdFromTypeValeurCarac(addslashes($type[$i]), addslashes($valeurs[$i]), $categorie);
            $caracBdd->updateCarac($id_carac, $_POST['id_produit'], $id_caracOld[$i]);
            $caracBdd->updateNiveauCarac($id_carac, $niveau[$i]);
            // echo($id_carac);

        }
    }
    public function addCarac() {

        $valeurs = json_decode($_POST['valeur']);
        $type = json_decode($_POST['type']);
        $caracBdd = CaracteristiqueModel::get_instance();
        $produitBdd = ProduitModel::get_instance();
        $categorie = $produitBdd->getSous_categorie_produit($_POST['id_produit']);
        for($i = 0; $i< count($valeurs); $i++) {

            $id_carac = $caracBdd->getIdFromTypeValeurCarac(addslashes($type[$i]), addslashes($valeurs[$i]), $categorie);
            $caracBdd->addCarac($id_carac, $_POST['id_produit']);

        }
        echo('yooo');
    }

    public function createCarac() {

        if($_POST['valeur'][0] != '' && $_POST['type'][0] != '' && $_POST['categorie'][0] != '') {


            $valeurs = json_decode($_POST['valeur']);
            $type = json_decode($_POST['type']);
            $categorie_carac = json_decode($_POST['categorie']);
            $niveau = json_decode($_POST['niveau']);
            // echo($valeurs[0]);
           
    
            $caracBdd = CaracteristiqueModel::get_instance();
            $produitBdd = ProduitModel::get_instance();
            $categorie_produit = $produitBdd->getSous_categorie_produit($_POST['id_produit']);
            for($i = 0; $i< count($valeurs); $i++) {
    
                if(!$caracBdd->verify_exist(addslashes(ucfirst($type[$i])), addslashes(ucfirst($valeurs[$i])), $categorie_produit, addslashes(strtoupper($categorie_carac[$i])))) {
    
                    echo(addslashes(ucfirst($type[$i])));
                    $caracBdd->createCarac(addslashes(ucfirst($type[$i])), addslashes(ucfirst($valeurs[$i])), $categorie_produit, addslashes(strtoupper($categorie_carac[$i])), $niveau[$i]);
    
                }
    
            }
        }
        
    }

    public function deleteCarac() {

        $caracBdd = CaracteristiqueModel::get_instance();
        $caracBdd->deleteCarac($_POST['id_produit'], $_POST['id_carac']);
    }

    public function getHtmlAjaxCarac() {

        $donnees = $this->getInformation($_GET['id_produit']);

        $type = $donnees['type'];
        $caracteristiques = $donnees['caracteristiques'];

        $dataView = [];
        $data = [];
        $categorie = str_replace("_", " ", $_GET['categorie']);
        $data['categorie'] = $_GET['categorie'];
        $data['id_select'] = $_GET['id_select'];
        $data['id_produit'] = $_GET['id_produit'];

        $dataView['type'] = $type;
        $dataView['categorie'] = $categorie;
        $dataView['caracteristiques'] = $caracteristiques;

        $vue = new View("AjaxDeleteCarac.php");
        ob_start();
        $vue->genereFichier($dataView);
        $html = ob_get_clean();
        $data['html'] = $html;
        echo(json_encode($data));
     
    }

    public function getHtmlCreateCarac(){

        $produitBdd = ProduitModel::get_instance();
        $caracBdd = CaracteristiqueModel::get_instance();

        $categorie_produit = $produitBdd->getSous_categorie_produit($_GET['id_produit']);
        $categorie_carac = $caracBdd->getCategorieCarac($categorie_produit);
        $typeCarac = $caracBdd->getTypeCarac($categorie_produit);
        $valeurCarac = $caracBdd->getValeurCarac($categorie_produit);
        
        $champs = [];
        $champs['categorie_caracteristique'] = $categorie_carac;
        $champs['type'] = $typeCarac;
        $champs['valeur'] = $valeurCarac;
        $html = "<div class='myRow'>";
        $html .= "<div class='myCol-3'><label>Categorie caracteristiques</label><input class='newCategorie' list='categorie' type='text'/><datalist id = 'categorie'>";
        foreach($champs['categorie_caracteristique'] as $value) {

            $html .= "<option value='". $value['categorie_caracteristique']."'>";
        }
        $html .= "</datalist>";
        $html .= "</div>";

        $html .= "<div class='myCol-3'><label>Type</label><input class='newType' list='type' type='text'/><datalist id = 'type'>";
        foreach($champs['type'] as $value) {

            $html .= "<option value='". $value['type']."'>";
        }
        $html .= "</datalist>";
        $html .= "</div>";

        $html .= "<div class='myCol-3'><label>Valeur</label><input class='newVal' list='valeur' type='text'/><datalist id = 'valeur'>";
        foreach($champs['valeur'] as $value) {

            $html .= "<option value='". $value['valeur']."'>";
        }
        $html .= "</datalist>";
        $html .= "</div>";
        $html .="<div class='myCol-3'><select name='niveau' id = 'niveau' class='newLvl'><option value='principale'>principale</option><option value='secondaire' selected>secondaire</option></select></div>";
        $html.="<div class='myCol-9'></div>";
        $html .= "<button class='creer' id='creer-".$_GET['id_produit']."'>creer </button>";
        echo($html);
    }
}