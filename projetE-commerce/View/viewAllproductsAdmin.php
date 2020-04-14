<?php
foreach($donnees as $produitView) {

    
    if($produitView != null) {
        
        ?>
        <div class="myRow">
            <div class="myCol-2">
                <div class="imageProduit">
                <a href="<?= HTTP ?>?admin=addProduit&id_produit=<?=$produitView->getId_produit()?>"><img src="<?=$produitView->getImagePrincipale()?>" alt=""></a>
                </div>
            </div>
            <div class="myCol-3">
                <h4><a href="<?= HTTP ?>?admin=addProduit&id_produit=<?=$produitView->getId_produit()?>"><?=$produitView->getDesignation()?></a></h4>
            </div>   
        </div>
        <?php
    }


}