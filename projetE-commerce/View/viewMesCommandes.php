<div class="myRow">

    <div class="myCol-12">

        <h2>Mes commandes:</h2>

    </div>

</div>

<?php
foreach($donnees as $commandes) {

    ?>
    <div class="myRow">
        <div class="myCol-12">
            <div class="commande">
                <div class="date-commande">commande du <?=$commandes->getDate_commande();?>:</div>

                <?php
        
        foreach($commandes->getTabLigneCommande() as $ligneCommande) {


            ?>
            <div class="myRow">
                <div class="myCol-3">
                    <img src="<?=$ligneCommande->getProduit()->getImagePrincipale() ?>" alt="">
                </div>
                <div class="myCol-2">
                    <div class="desc-commande"><?=$ligneCommande->getProduit()->getDesignation()?></div>
                </div>
                <div class="myCol-2">
                    <div class="desc-commande"> Quantite x<?=$ligneCommande->getQuantite();?></div>
                </div>
                <div class="myCol-2">
                    <div class="desc-commande">Prix unitaire ttc: <?=$ligneCommande->getPrix_ttc()?></div>
                </div>

            </div>

            <?php
        }
        ?>
        <div class="myRow">
            <div class="myCol-9">
            </div>
            <div class="myCol-3"><div class="montant-commande">Montant Total ttc: <?= $commandes->getMontant_ttc()?>€</div></div>
        </div>
        
        </div>
        </div>
    </div>
    <?php
}
