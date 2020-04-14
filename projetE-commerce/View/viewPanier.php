<h1>PANIER</h1>
<?php
$panier = $_SESSION['user']->getPanier();

if(!empty($panier->getTabligne_commande())) {

    foreach($panier->getTabligne_commande() as $key => $value) {

        ?>
        <div class="myRow">
            <div class="myCol-12">
                <div class="vuePanier">

                    <div class="myRow">
                        <div class="myCol-3">
                            <img src="<?= $value->getProduit()->getImagePrincipale()?>" alt="">
                        </div>
                        <div class="myCol-3">
                            <div class="designation"><?= $value->getProduit()->getDesignation()?></div>
                        </div>
                        <div class="myCol-3">
                            <div class="quantite">QUANTITE x<?= $value->getQuantite()?></div>
                        </div>
                        <div class="myCol-3">
                            <a href="<?= HTTP ?>?action=decreasePanier&id_produit=<?=$value->getProduit()->getId_produit()?>"><div class="button-decrease-panier">Enlever du panier</div></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <?php
    }
    ?>
    <div class="myRow">
        <div class="myCol-12">
            <a href="<?= HTTP ?>?action=submitOrder"><div class="myBtn">
                Valider ma commande
            </div></a>
        </div>
    </div>
<?php
}
else {
    ?>
    <div class="myRow">
        <div class="myCol-12">
            <p>Votre panier est vide</p>
        </div>
    </div>
<?php
}