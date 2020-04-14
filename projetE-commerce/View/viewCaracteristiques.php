<?php

// var_dump($donnees);
$produit = $donnees['produit'];
$caracteristiquesProduit = $produit->getCaracteristiques();
$categorie_carac_Produit = $produit->get_categorie_caracteristique_in_array();

$categorie_carac = $donnees['categorie_carac'];


$caracteristiques = $donnees['caracteristiques'];
$type = $donnees['type'];

$id_type_valeur = 0;
// var_dump($produit);

?>
<div class="myRow">
    <h2>FICHE TECHNIQUE</h2>
</div>
<div class="myRow">
    <table>
        <tbody>

<?php
        foreach($categorie_carac as $cat) {

            if(in_array($cat, $categorie_carac_Produit)) {
                
                ?>
        <tr>
            <td class="td-titre-carac"><?=$cat?></td>
        </tr>
                <?php
        foreach($caracteristiquesProduit as $caracteristique) {
            

            if($caracteristique->getCategorie_caracteristique() == $cat){
                ?>
                <tr>
                <td></td>
                    <td class="td-carac">
                        <select name="" id="type-<?=$id_type_valeur?>-<?=$produit->getId_produit() ?>-<?=$caracteristique->getId_carac() ?>" class="select-type">
                            <option value="<?=$caracteristique->getType()?>" selected="selected"><?=$caracteristique->getType()?></option>
                            <?php
                                foreach($type[$cat] as $key => $value) {

                                    if($value != $caracteristique->getType()) {

                                    ?>
                                        <option value="<?= $value?>"><?= $value?></option>
                                    <?php
                                    }
                                    
                                    
                                }

                            ?>
                            
                        </select>
                    </td>
                    
                    <td class="td-carac">
                        <select name="" id="valeur-<?=$id_type_valeur ?>" class="select-val">
                            <option value="<?=$caracteristique->getValeur()?>" selected="selected"><?=$caracteristique->getValeur()?></option>
                            <?php
                            foreach($caracteristiques[$cat] as $carac) {
                                if($carac['type'] == $caracteristique->getType() && $carac['valeur'] != $caracteristique->getValeur()){

                                    ?>
                                    <option value="<?=$carac['valeur'] ?>"><?=$carac['valeur'] ?></option>

                                    <?php
                                }
                            }

                            ?>
                            
                        </select>
                    </td>
                    <td class="td-carac">
                        <select name="" id="niveau-<?=$id_type_valeur ?>" class="select-lvl">
                            <option value="<?=$caracteristique->getNiveau()?>" selected="selected"><?=$caracteristique->getNiveau()?></option>
                            <?php
                                if($caracteristique->getNiveau() == "secondaire") {

                                    ?>
                                    <option value="principale">principale</option>
                                    <?php
                                }
                                else{

                                    ?>
                                    <option value="secondaire">secondaire</option>
                                    <?php

                                }

                            ?>
                            
                        </select>
                    </td>
                    <td>
                        <div class='delete-btn' id='del-<?= $caracteristique->getId_carac() ?>-<?=$produit->getId_produit() ?>'>SUPPRIMER</div>
                    </td>
                </tr>
                <?php


            }
            $id_type_valeur ++;
        }
        ?>
        <tr>
            <td><a class='hiddenCarac' id='<?=str_replace(" ","_",$cat) ?>-<?=$id_type_valeur ?>-<?=$produit->getId_produit() ?>'>Ajouter caracteristique</a></td>
        </tr>
        
        <?php
        }
        else {
            ?>
            <tr>
                <td class="td-titre-carac"><?=$cat?></td>
            </tr>
            <tr>
                <td><a class='hiddenCarac' id='<?=str_replace(" ","_",$cat) ?>-<?=$id_type_valeur ?>-<?=$produit->getId_produit() ?>'>Ajouter caracteristique</a></td>
            </tr>
        <?php
        $id_type_valeur ++;

        }
        }
        ?>


        </tbody>
    </table>
</div>
<div class="myRow">
    <div class="myCol-12">
        <a class = "newCarac" id="newCarac-<?= $produit->getId_produit()?>">Créer caractéristique</a>
    </div>
</div>
<div class="myRow">
    <div class="myCol-12">
        <a href="<?= HTTP ?>?admin=addProduit&id_produit=<?= $produit->getId_produit() ?>">Retour</a>
    </div>
</div>
<div class="myRow">
        <div class="myBtn">
        Valider
        </div>
</div>
<script>eventCarac()</script>