<?php

class ControllerImage{


    public function controlPost() {

        if(isset($_POST['submitImg']) && !empty($_POST['nameImg'])){

            $imageBdd = ImageModel::get_instance();

            $config = PATH_SITE."image";

            $produitBdd = ProduitModel::get_instance();
            $produit = $produitBdd->getProduitWithoutDesc($_GET['id_produit']);
            $designation = str_replace(" ", "_", $produit->getDesignation());
            if(!file_exists($config."/".$produit->getSous_categorie()."")){

                mkdir($config."/".$produit->getSous_categorie()."", 0700);
            }
            if(!file_exists($config."/".$produit->getSous_categorie()."/".$produit->getMarque()."")){

                mkdir($config."/".$produit->getSous_categorie()."/".$produit->getMarque()."", 0700);
            }
            if(!file_exists($config."/".$produit->getSous_categorie()."/".$produit->getMarque()."/". $designation ."")){

                mkdir($config."/".$produit->getSous_categorie()."/".$produit->getMarque()."/". $designation ."", 0700);
            }

            $name_and_extension = explode('.', $_FILES['fic']['name']);

            $nameFile = $_POST['nameImg'].".".$name_and_extension[1];
            move_uploaded_file($_FILES['fic']['tmp_name'], $config."/".$produit->getSous_categorie() ."/". $produit->getMarque() ."/". $designation ."/".$_FILES['fic']['name']);
            rename($config."/".$produit->getSous_categorie() ."/". $produit->getMarque() ."/". $designation ."/".$_FILES['fic']['name'], $config."/".$produit->getSous_categorie() ."/". $produit->getMarque() ."/". $designation ."/".$nameFile);
            $source = "/".$produit->getSous_categorie() ."/". $produit->getMarque() ."/". $designation ."/".$nameFile;

            $type = $_POST['type'];
            $imageBdd->addImage($source, $type, $produit->getId_produit());
            echo("<script>window.location.href = window.location.href;</script>");
        }
        
    }

    public function get_image($id_produit) {

        $imageBdd = ImageModel::get_instance();
        $images = $imageBdd->getAllImageProduit($id_produit);

        return $images;

    }

    public function deleteImage() {

        if(isset($_POST['id_image'])) {

            $source_image = str_replace("http://localhost/", "C:/wamp/www/", $_POST['source_image']);
            unlink($source_image);
            $imageBdd = ImageModel::get_instance();
            $imageBdd->deleteImage($_POST['id_image']);

            echo($_POST['id_image']);
        }
    }
}