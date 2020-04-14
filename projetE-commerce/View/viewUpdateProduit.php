<div class="MyRow">
    <div class="MyCol-12">
        <h2>MODIFICATION DE LA FICHE DU PRODUIT: <?= $donnees->getDesignation() ?> </h2>

    </div>

</div>
<div class="MyRow">
    <div class="MyCol-12">
        <a href="<?= HTTP ?>?admin=formProduit&id_produit=<?=$donnees->getId_produit()?>"><h3>INFORMATION PRODUIT</h3></a>
        <a href="<?= HTTP ?>?admin=addImage&id_produit=<?=$donnees->getId_produit()?>"><h3>AJOUT D'IMAGE</h3></a>
        <a href="<?= HTTP ?>?admin=addDescription&id_produit=<?=$donnees->getId_produit()?>"><h3>GESTION DES DESCRIPTIONS</h3></a>
        <a href="<?= HTTP ?>?admin=addCarac&id_produit=<?=$donnees->getId_produit()?>"><h3>GESTION DES CARACTERISTIQUES</h3></a>
        <a href="<?= HTTP ?>?admin=updateProduit"><h3>TOUS LES PRODUITS</h3></a>
    </div>
</div>
