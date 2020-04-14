<?php
$descriptions = $donnees->getDescriptions();
$caracteristiques = $donnees->getCaracteristiques();
$categorieCarac = $donnees->get_categorie_caracteristique_in_array();
$alternImage = 0;
$i_img = 0;
?>

<div class="myRow">
    <div class="myCol-12">
        <h3 class='title-prod'><?=$donnees->getDesignation()?></h3>
        <p class='mini-technique'><?=$donnees->getMini_description_technique()?></p>

    </div>

</div>
<div class='myRow'>
    <div class='myCol-4'>
            <div class='imageProduit'>
                <div class="carouselProduct">
                    <figure>
                        <?php
                            foreach($donnees->getImages() as $imagesC) {

                                if($imagesC->getType() == "carroussel") {
                                ?>
                                    <img src="<?=$imagesC->getSource()?>" alt="" />
                                    <?php
                                }
                            }
                        ?>
                        
                        
                    </figure>
                    <nav>
                        <button class="nav prev">Prev</button>
                        <button class="nav next">Next</button>
                    </nav>
                </div>
    
            </div>
    </div>
    <div class='myCol-4'>
            <div>
            <?php
            if(!empty($donnees->getAvis())) {

                for($i=0; $i<5; $i++){

                    if($i < $donnees->avgAvis()){

                        ?>
                        <i class="fa fa-star gold" style="cursor: none;"></i>
                        <?php
                    }
                    else {

                        ?>
                        <i class="fa fa-star" style="cursor: none;"></i>
                        <?php
                    }
                }
            }
            ?>
            </div>
            <a href="#avis">(<?=$donnees->getCountAvis() ?> avis client)</a>
            <p class='mini-desc'><?=$donnees->getMini_description_produit()?></p>        
    </div>
    <div class='myCol-4'>
            <div class="panier">
                <div class="prix"><?=$donnees->getPrix_ttc()."€"?></div>
                <a class='btn-panier' id='btn-<?=$donnees->getId_produit()?>'><div class="addPanier">Ajouter au panier</div></a>
            </div>
    </div>

</div>
<div class='myRow'>
    <div class='myCol-12'>
        <h2 class='title2'>DESCRIPTIF</h2>
    </div>
</div>
    <?php
        foreach($descriptions as $description) {

            if($description->getCategorie_description() == "principale") {
                ?>
            <div class='myRow description'>
            <div class="myCol-12">
                    <h3 class='title-desc'><?=$description->getTitre_description()?></h3>
                    <p><?=$description->getText_description()?></p>
                </div>
            </div>
            <?php
            }
            else if($alternImage % 2 == 0 && $description->getCategorie_description() == "secondaire"){
                ?>
            <div class="myRow description">
                <div class="myCol-6 myCol-lg-12">
                    <h3 class='title-desc'><?=$description->getTitre_description()?></h3>
                    <p><?=$description->getText_description()?></p>
                </div>
                
                <div class="myCol-6 myCol-lg-12">
                        <img class='img-desc'src="<?=$description->getImage_description()?>" alt="">
                </div>
            </div>
            <?php
            $i_img++;
            $alternImage++;

            }
            else if($alternImage % 2 > 0 && $description->getCategorie_description() == "secondaire"){
                ?>
            <div class="myRow description">
                <div class="myCol-6 myCol-lg-12">
                        <img class='img-desc'src="<?=$description->getImage_description()?>" alt="">
                </div>
                <div class="myCol-6 myCol-lg-12">
                    <h3 class='title-desc'><?=$description->getTitre_description()?></h3>
                    <p><?=$description->getText_description()?></p>
                </div>

            </div>
            <?php
            $i_img++;
            $alternImage++;

            }

        }
?>
<div class="myRow">
    <h2 class='title2'>FICHE TECHNIQUE</h2>
</div>
<div class="myRow">
    <table>
        <tbody>

<?php
        foreach($categorieCarac as $cat) {

            ?>
            <tr>
                <td class="td-titre-carac"><?=$cat?></td>
            </tr>
<?php
        foreach($caracteristiques as $caracteristique) {
            

            if($caracteristique->getCategorie_caracteristique() == $cat){
                ?>
                <tr>
                <td></td>
                    <td class="td-carac">
                        <?=$caracteristique->getType()?>
                    </td>
                    <td class="td-carac">
                        <?=$caracteristique->getValeur()?>
                    </td>
                </tr>
                <?php


            }
        }
        
        }
        ?>


        </tbody>
    </table>
</div>

<div class="myRow">
    <h2 class='title2'>DONNER SON AVIS</h2>
</div>
<?php
if(isset($_SESSION['user'])) {
    ?>
<div class="myRow">
    <div class="myCol-12 myCol-sm-12">
        <div class="form-registration">
            
            <form action="<?=HTTP?>?action=addAvis&idUser=<?=$_SESSION['user']->getId_utilisateur()?>&idProduct=<?=$_GET['idProduct'] ?>" method="POST">
                
                <div class="myRow">
                    <div class="myCol-12">
                        <div class="rating">
                            <div class="stars">
                                <input type="radio" name="rating" class="fa fa-star" value='1'>
                                <input type="radio" name="rating" class="fa fa-star" value='2'>
                                <input type="radio" name="rating" class="fa fa-star" value='3'>
                                <input type="radio" name="rating" class="fa fa-star" value='4'>
                                <input type="radio" name="rating" class="fa fa-star" value='5'>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="myRow">
                    <div class="myCol-12 myCol-sm-12">
                        <label class="label-form">TITRE</label>

                    </div>

                </div>
                <div class="myRow">
                    <div class="myCol-12 myCol-sm-12">
                        <input type="text" name="titre" class="input-long-size">
                    </div>

                </div>
                <div class="myRow">
                    <div class="myCol-12 myCol-sm-12">
                        <label class="label-form">AVIS</label>

                    </div>

                </div>
                <div class="myRow">
                    <div class="myCol-12 myCol-sm-12">
                        <textarea name="texte_avis" class="long-textarea" > </textarea>
                    </div>
                </div>
                
                
                <div class="myRow">
                    <div class="myCol-12 myCol-sm-12">
                        <input type="submit" class="input-submit" value="Valider">
                    </div>

                </div>
            </form>

        </div>

    </div>
</div>
<?php
}
if(!empty($donnees->getAvis())){

    ?>

    <div class="myRow">
        <h2 class='title2' id='avis'>LISTE AVIS</h2>
    </div>
<?php
    foreach($donnees->getAvis() as $avis) {

        ?>
        <div class='myRow bloc-avis'>
            <div class='myRow'>
                <div class='myCol-1 myCol-sm-1'></div>
                <div class='myCol-1 myCol-sm-1'>
                    <?php
                        for($i=0; $i<5; $i++){

                            if($i<$avis->getNote()){

                                ?>
                                <i class="fa fa-star gold" style="cursor: none;"></i>
                                <?php
                            }
                            else {

                                ?>
                                <i class="fa fa-star" style="cursor: none;"></i>
                                <?php
                            }
                        }
                    ?>
                </div>
                <div class='myCol-2 myCol-sm-2' style="font-weight: bold;"><?=$avis->getTitre() ?></div>
            </div>
            <div class='myRow'>
                <div class='myCol-2 myCol-sm-2'></div>
                <div class='myCol-8 myCol-sm-8'><?=$avis->getTexte_avis() ?></div>
            </div>
        </div>
        <?php
    }

}
?>

<script>
notif();
carrouselProduct();
ratingEvent()
</script>
