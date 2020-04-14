<?php
foreach($donnees as $produitView) {
    
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