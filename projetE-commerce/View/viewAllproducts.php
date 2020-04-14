
<div class='myRow'>

    <div class='myCol-2 filtre-produit'>
        <div class='myRow'>
            <div class='myCol-12'><h3>FILTRER LES PRODUITS</h1></div>
        </div>
        <div class='myRow'>
            <div class='myCol-12'>
            <?php
                if(isset($_GET['categorie'])){
                ?>
                    <select class='input-mid-size' name="marque" id="marque-<?=$_GET['categorie'] ?>" style='color: black;'>
                    <?php
                }
                else if(isset($_GET['sous_categorie'])){
                ?>
                    <select class='input-mid-size' name="marque" id="marque-<?=$_GET['sous_categorie'] ?>" style='color: black;'>
                    <?php
                }
            ?>
                    <option value="none" style='font-weight: bold;' selected = "selected">--Marque--</option>
                    <?php
                        foreach($donnees['marque'] as $key => $marque) {

                            ?>
                                <option value="<?= $key ?>"><?= $key ?></option>
                            <?php
                        }

                    ?>
                </select>
            </div>
        </div>
        
        <?php
        foreach($donnees['caracteristiques'] as $key => $value){

            ?>
            <div class='myRow'>
                <div class='myCol-12'>
                    <select class='input-mid-size' name="<?= $key?>" id="<?= $key?>" style='color: black;'>
                        <option value="none" selected = "selected" style='font-weight: bold;'>--<?=$key ?>--</option>
                        <?php
                        foreach($value as $id_carac => $valeur_carac){

                            ?>
                            <option value="<?=$id_carac."-". $valeur_carac ?>"><?= $valeur_carac ?></option>
                            <?php
                        }

                        ?>
                    </select>
                </div>
            </div>

            <?php
        }

        ?>
    </div>

    <div class='myCol-8 produit'>
<?php
foreach($donnees['produits'] as $produitView) {
    
    if($produitView != null) {
        
        ?>
        <div class="myRow">
            <div class="myCol-2">
                <div class="imageProduit">
                <a href="<?= HTTP ?>?action=produit&idProduct=<?=$produitView->getId_produit()?>"><img src="<?=$produitView->getImagePrincipale()?>" alt=""></a>
                </div>
            </div>
            <div class="myCol-6">
                <h2 class='title-prod'><a style='text-decoration: none; color: #151E3F;' href="<?= HTTP ?>?action=produit&idProduct=<?=$produitView->getId_produit()?>"><?=$produitView->getDesignation()?></a></h4>
                <p class='mini-technique'><?=$produitView->getMini_description_technique()?></p>
            </div>
            <div class="myCol-2">
                <div class="prix" style='font-size: 22px;'><?=$produitView->getPrix_ttc()."€"?></div>
                <div class='btn-panier' id='btn-<?=$produitView->getId_produit()?>'style='text-align:center; cursor: pointer;'><i class='fas fa-shopping-bag mini-btn-add-panier'></i></div>
            </div>
        </div>
        <?php
    }
    
    
}

?>
    </div>

</div>
<script>
notif();
init_filtre_produit()
</script>