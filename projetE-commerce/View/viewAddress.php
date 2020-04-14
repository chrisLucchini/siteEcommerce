<form action="<?= HTTP ?>?action=commande" method="POST">
<div class="myRow">
    <div class="myCol-12 myCol-sm-12">
        <div class="form-address">

        <h3>Choisissez une adresse de livraison</h3>

    
<?php

foreach($_SESSION['user']->getAdresse() as $adresse) {

    ?>

        <div class="myCol-12 myCol-sm-12">
                <input type="radio" name="adr_livraison" value='<?= $adresse->getId_adresse()?>'/><label for=""><?= $adresse->getAdresse_ligne1() .", " .$adresse->getAdresse_ligne2().", " .$adresse->getVille() .", ".$adresse->getCode_postal().", ".$adresse->getRegion() ?></label>
                
        </div>
            
            
            <?php
}
?>
        <div class="myCol-12 myCol-sm-12">
            <a href="<?= HTTP ?>?action=addAddress"><div class="myBtn">
                Ajouter une adresse

            </div></a>

        </div>
    </div>

</div>
</div>

<div class="myRow">
    
    <div class="myCol-4 myCol-sm-4">
        <input type="submit" class="myBtn"  value="Passer commande"/>
        
    </div>
    
    
    
</div>
</form>
