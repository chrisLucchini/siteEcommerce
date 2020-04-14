<?php
require_once("Modele.php");
require_once("simplehtmldom_1_9_1/simple_html_dom.php");
class InitBDD extends Modele {

    public function addCaracProduit($id_carac, $id_produit){

        $sql = "INSERT INTO caracteristiqueproduit (id_carac, id_produit) VALUES ('$id_carac', '$id_produit')";
        $this->executerRequete($sql);


    }
    public function getCarac($categorie) {

        $sql = "SELECT id_carac from caracteristique WHERE categorie_produit = '$categorie'";
        $res = $this->executerRequete($sql);
        $donnees = $res->fetchAll();

        return $donnees;
    }

    public function createProduit($designation, $marque, $modele, $categorie, $sous_categorie, $prix, $mini_description_technique, $mini_description_produit){

        $designation = addslashes($designation);
        $marque = addslashes($marque);
        $modele = addslashes($modele);
        $categorie = addslashes($categorie);
        $sous_categorie = addslashes($sous_categorie);
        $mini_description_technique = addslashes($mini_description_technique);
        $mini_description_produit = addslashes($mini_description_produit);

        $sql = "INSERT INTO produit (designation, marque, modele, categorie, sous_categorie, prix, mini_description_technique, mini_description_produit) VALUES('$designation', '$marque', '$modele', '$categorie', '$sous_categorie', '$prix', '$mini_description_technique', '$mini_description_produit')";
        $this->executerRequete($sql);
    }

    public function getIdProduit($designation) {

        $sql = "SELECT id_produit from produit WHERE designation = '$designation'";
        $res = $this->executerRequete($sql);

        $id_produit = $res->fetch();
        return $id_produit['id_produit'];
    }

    public function createCaracteristique($type, $valeur, $typevaleur, $categorie_produit, $categorie_caracteristique) {

        $type = addslashes($type);
        $valeur = addslashes($valeur);
        $type_valeur_caracteristique = $type . " " . $valeur;
        $typevaleur = addslashes($typevaleur);
        $categorie_produit = addslashes($categorie_produit);
        $categorie_caracteristique = addslashes($categorie_caracteristique);

        $sql = "INSERT INTO caracteristique (type_valeur_caracteristique, type, valeur, typevaleur, categorie_produit, categorie_caracteristique) VALUES('$type_valeur_caracteristique', '$type', '$valeur', '$typevaleur', '$categorie_produit', '$categorie_caracteristique')";
        $this->executerRequete($sql);
    }

    public function get_id_carac($type, $valeur, $categorie_produit) {

        $type = addslashes($type);
        $valeur = addslashes($valeur);
        $categorie_produit = addslashes($categorie_produit);

        $sql = "SELECT id_carac from caracteristique WHERE type = '$type' AND valeur = '$valeur' AND categorie_produit = '$categorie_produit'";
        $res = $this->executerRequete($sql);
        $id = $res->fetch();

        return $id['id_carac'];

    }
    
    public function verifCaracExist($type, $valeur, $categorie_produit){

        $type = addslashes($type);
        $valeur = addslashes($valeur);
        $type_valeur_caracteristique = $type . " " . $valeur;
        $categorie_produit = addslashes($categorie_produit);

        $sql = "SELECT COUNT(*) FROM caracteristique WHERE type_valeur_caracteristique = '$type_valeur_caracteristique' AND categorie_produit = '$categorie_produit'";
        $res = $this->executerRequete($sql);
        $cpt = $res->fetch();

        return $cpt["COUNT(*)"];



    }
    public function createImage($source, $type, $id_produit) {

        $sql = "INSERT INTO image (source, type, id_produit) VALUES('$source', '$type', '$id_produit')";
        $this->executerRequete($sql);
    }

    public function getIdImage($source) {

        $sql = "SELECT id_image from image WHERE source = '$source'";
        $res = $this->executerRequete($sql);
        $id_image = $res->fetch();

        return $id_image['id_image'];

    }

    public function createDescription($id_produit, $id_image, $titre_description, $text_description, $categorie_description) {

        $titre_description = addslashes($titre_description);
        $text_description = addslashes($text_description);
        $categorie_description = addslashes($categorie_description);

        $sql = "INSERT INTO description (id_produit, id_image, titre_description, text_description, categorie_description) VALUES('$id_produit', '$id_image', '$titre_description', '$text_description', '$categorie_description')";
        $this->executerRequete($sql);
    }

    

}

function getCaracOnHtml($link) {

    $html = file_get_html($link);
    $typevaleur = [];
    $tab = $html->find('tr');
    foreach($tab as $trElement) {

        if($trElement->getAttribute("class") == "feature") {

            $categorie = $trElement->children(0)->children(0)->innertext;
            $categorie = htmlspecialchars_decode($categorie, ENT_QUOTES);
            // echo($categorie ."\n");
            $type = $trElement->children(1)->children(0)->innertext;
            $type = htmlspecialchars_decode($type, ENT_QUOTES);
            // echo($type . "\n");
            $valeur = $trElement->children(2);
            if($valeur->last_child() != null) {
                
                        $chaine = trim($valeur->last_child()->innertext);
                        $chaine = preg_replace('/\s{2,}/', ' ', $chaine);
                        $chaine = htmlspecialchars_decode($chaine, ENT_QUOTES);
                        $typevaleur[$categorie][$type] = $chaine;
                    }
            else {
        
                $chaine = trim($valeur->innertext);
                $chaine = preg_replace('/\s{2,}/', ' ', $chaine);
                $chaine = htmlspecialchars_decode($chaine, ENT_QUOTES);
                $typevaleur[$categorie][$type] = $chaine;
            }
        }
        else {

            // $categorie = $trElement->children(0)->children(0)->innertext;
            // echo($categorie ."\n");
            $typeDom = $trElement->children(0);
            $childrenTr = $trElement->children();
            $nbChildrenTr = count($childrenTr);
            $type = $trElement->children(0)->children(0)->innertext;
            $type = htmlspecialchars_decode($type, ENT_QUOTES);
            if($nbChildrenTr == 1) {

                $valeur = $trElement->first_child();
            }
            else {
                $valeur = $trElement->children(1);
            }

            if($valeur->last_child() != null) {
                
                        $chaine = trim($valeur->last_child()->innertext);
                        $chaine = preg_replace('/\s{2,}/', ' ', $chaine);
                        $chaine = htmlspecialchars_decode($chaine, ENT_QUOTES);
                        $typevaleur[$categorie][$type] = $chaine;
                    }
            else {
        
                $chaine = trim($valeur->innertext);
                $chaine = preg_replace('/\s{2,}/', ' ', $chaine);
                $chaine = htmlspecialchars_decode($chaine, ENT_QUOTES);
                $typevaleur[$categorie][$type] = $chaine;
            }


        }
    }

    return $typevaleur;

}

$bdd = new InitBDD();
$typeValeur = getCaracOnHtml("https://www.ldlc.com/fiche/PB00208997.html");
var_dump($typeValeur);

$categorie_produit = "PC Portable";
$designation = "HP ZBook 15 G6 (6TU91EA)";





/* CREATE CARAC */
// foreach($typeValeur as $categorieKEY => $categorieVALUE) {
    
//     foreach($categorieVALUE as $type => $valeur) {

//         echo($bdd->verifCaracExist($type, $valeur, $categorie_produit));
//         if($bdd->verifCaracExist($type, $valeur, $categorie_produit) < 1){
            
//             echo("categorie: $categorieKEY type: $type valeur: $valeur \n");
//             $bdd->createCaracteristique($type, $valeur , "String", $categorie_produit, $categorieKEY);
//         }

//     }
// }




/* CREATE PRODUIT */
// $bdd->createProduit($designation,"HP", "ZBook 15 G6 (6TU91EA)", "Informatique", $categorie_produit, 2999.95, "Intel Core i7-9850H 32 Go SSD 512 Go 15.6 LED Full HD NVIDIA Quadro RTX 3000 6 Go Wi-Fi AX/Bluetooth Windows 10 Professionnel 64 bits", "Gagnez en confort et en efficacité avec la station de travail mobile HP ZBook 15 G6 ! A la fois mobile et très performante, elle sera idéale pour les professionnels du graphisme. Avec ses fonctions de sécurité avancées et sa conception haut de gamme, c'est un parfait compagnon de travail.");



/* ADD CARAC */
// $id_produit = $bdd->getIdProduit($designation);
//     foreach($typeValeur as $categorieKEY => $categorieVALUE) {
        
//         foreach($categorieVALUE as $type => $valeur) {
            
//             $id_carac = $bdd->get_id_carac($type, $valeur, $categorie_produit);
//             $bdd->addCaracProduit($id_carac, $id_produit);        

//     }
// }


/* CREATE IMAGE */
// $id_produit = $bdd->getIdProduit($designation);
// $bdd->createImage("source", "type", $id_produit);

// $id_produit = $bdd->getIdProduit($designation);
// $bdd->createImage("/Pc_Portable/HP/ZBook_15_G6_(6TU91EA)/carroussel1.jpg", "carroussel", $id_produit);
// $bdd->createImage("/Pc_Portable/HP/ZBook_15_G6_(6TU91EA)/carroussel2.jpg", "carroussel", $id_produit);
// $bdd->createImage("/Pc_Portable/HP/ZBook_15_G6_(6TU91EA)/carroussel3.jpg", "carroussel", $id_produit);
// $bdd->createImage("/Pc_Portable/HP/ZBook_15_G6_(6TU91EA)/carroussel4.jpg", "carroussel", $id_produit);
// $bdd->createImage("/Pc_Portable/HP/ZBook_15_G6_(6TU91EA)/carroussel5.jpg", "carroussel", $id_produit);
// $bdd->createImage("/Pc_Portable/HP/ZBook_15_G6_(6TU91EA)/description1.jpg", "description", $id_produit);
// $bdd->createImage("/Pc_Portable/HP/ZBook_15_G6_(6TU91EA)/description2.jpg", "description", $id_produit);
// $bdd->createImage("/Pc_Portable/HP/ZBook_15_G6_(6TU91EA)/description3.jpg", "description", $id_produit);
// $bdd->createImage("/Pc_Portable/HP/ZBook_15_G6_(6TU91EA)/marque.jpg", "marque", $id_produit);
// $bdd->createImage("/Pc_Portable/HP/ZBook_15_G6_(6TU91EA)/principale.jpg", "principale", $id_produit);


/* CREATE DESCRIPTION */
// $id_produit = $bdd->getIdProduit($designation);
// $id_image = $bdd->getIdImage("source");
// $bdd->createDescription($id_produit, $id_image, "titre_description", "text_description", "categorie_description");

// $id_produit = $bdd->getIdProduit($designation);

// $id_image = $bdd->getIdImage("/Pc_Portable/HP/ZBook_15_G6_(6TU91EA)/description1.jpg");
// $bdd->createDescription($id_produit, $id_image, "Hautes performances pour les professionnels","Gagnez en confort et en efficacité avec la station de travail mobile HP ZBook 15 G6 ! A la fois mobile et très performante, elle sera idéale pour les professionnels du graphisme. Avec ses fontions de sécurité avancées et sa conception haut de gamme, c'est un parfait compagnon de travail.

// Le PC portable HP ZBook 15 G6 (6TU91EA) offre de hautes performances et un fonctionnement rapide grâce à son processeur Intel Core i7-9850H, ses 32 Go de mémoire DDR4, son SSD M.2 PCIe de 512 Go et sa puce graphique NVIDIA Quadro RTX 3000 avec 6 Go de mémoire dédiée.  ", "principale");
// $id_image = $bdd->getIdImage("/Pc_Portable/HP/ZBook_15_G6_(6TU91EA)/description1.jpg");
// $bdd->createDescription($id_produit, $id_image, "PERFORMANCES POUR LES PROFESSIONNELS", "Equipé d'un processeur Intel Core i7 de 9e génération, d'un SSD au format PCIe et d'une puce graphique professionnelle NVIDIA Quadro RTX 3000, cette station de travail mobile est conçue pour supporter les charges de travail les plus lourdes.. Avec en prime un système de refroidissement très efficace, il maintient une parfaite stabilité même en utilisation intensive. Pour un éventail de possibilités étendu, le HP ZBook 15 G6 dispose d'un port HDMI 2.0b et de 2 connecteurs Thunderbolt 3 au format USB-C supportant le signal DisplayPort 1.4.", "secondaire");
// $id_image = $bdd->getIdImage("/Pc_Portable/HP/ZBook_15_G6_(6TU91EA)/description2.jpg");
// $bdd->createDescription($id_produit, $id_image, "CONFORT ET SÉCURITÉ EN DÉPLACEMENT", "Grâce à son écran IPS de 15.6 pouces anti-reflets avec résolution Full HD, cet ordinateur portable HP offre un vrai confort de travail. Grâce à sa conception robuste et légère et grâce à ses fonctions de sécurité avancées il sera idéal pour les déplacements réguliers. La puce TPM 2.0 (Trusted Platform Module), le lecteur d'empreinte digitale et le lecteur de carte à puce pourront vous aider à sécuriser vos données.", "secondaire");
// $id_image = $bdd->getIdImage("/Pc_Portable/HP/ZBook_15_G6_(6TU91EA)/description3.jpg");
// $bdd->createDescription($id_produit, $id_image, "UN PC PORTABLE CONÇU POUR ÉVOLUER", "Le PC portable HP ZBook 15 G6 est un véritable outil professionnel. Pour vous faciliter l'entretien et la mise à jour des composants, il bénéficie d'un panneau arrière facile et rapide à retirer. La mémoire et le stockage sont également simples et rapides d'accès. En quelques secondes c'est fait !", "secondaire");



