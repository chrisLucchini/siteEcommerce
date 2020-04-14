<div id='id_prod'><?= $_GET['id_produit']?></div>
<div class="myRow">
    <div class="myCol-12">
        <h1>AJOUT / MODIFICATION DE DESCRIPTION</h1>
    </div>
</div>

<?php

foreach($donnees['description'] as $description) {
    if(is_null($description)) continue;

    ?>
<div class="myRow">
    <div class="myCol-6">

        <a class='descript'><h3 id='bloc-<?=$description->getId_description()?>'>MODIFICATION DE LA DESCRIPTION: <?=$description->getTitre_description()?></h3></a>
    </div>
    <div class="myCol-3" style='display: flex; align-items: center;'>
        <div class='delete-btn' id='del-<?= $description->getId_description() ?>'>SUPPRIMER</div>
    </div>

</div>
<div style="border: 1px solid grey; display:none;" class="blocDesc" id='b-<?=$description->getId_description()?>'>
    <div class="myRow">
        <div class="myCol-12">
            <input placeholder='titre' id='titre-<?=$description->getId_description()?>' type="text" class="input-long-size" value="<?=$description->getTitre_description() ?>"/>
        </div>
        <div class="myCol-6">
            <textarea name="description" id="text-<?=$description->getId_description() ?>" class="long-textarea"><?=$description->getText_description()?></textarea>
        </div>
        <div class='myCol-6'>
            <img id="img-<?= $description->getId_description()?>"src="<?= $description->getImage_description() ?>" alt="" />

        </div>
    </div>
    <div class="myRow">
        <div class="myCol-12">
            <h3>changer l'image de la description: </h3>
        </div>
        <?php

        foreach($donnees['images'] as $image) {

            ?>
            <div class="myCol-3">
                <img id="<?= $image->getId_image() ?>-<?=$description->getId_description()?>" class='radioImg' src="<?= $image->getSource()?>" alt="">
            </div>

            <?php
        }

        ?>

    </div>
    <div class="myRow">
        <div class="myCol-12">
            <div class="myBtn" id="submit-<?=$description->getId_description()?>">Valider</div>
        </div>

    </div>
</div>
    <?php
}
?>
<a id='addDesc'>AJOUTER DESCRIPTION</a>
<form action="" id="formDesc">

    <div class="myRow">
        <div class="myCol-12">
            <input placeholder="titre" id='titre' type="text" class="input-long-size"/>
        </div>
    </div>
    <div class="myRow">
        <div class="myCol-6">
                <textarea id='text' name="description" class="long-textarea"></textarea>
        </div>
        <div class='myCol-6'>
            <img class='imageDesc' src="" alt="">
        </div>
    </div>
    <div class="myRow">
        <div class="myCol-6">
            TYPE:
                <select name="type" id="type">
                    <option value="principale">Principale</option>
                    <option value="secondaire" selected="selected">Secondaire</option>
                </select>
        </div>
    </div>
    <div class="myRow">
        <div class="myCol-12">
            <h3>changer l'image de la description: </h3>
        </div>
        <?php

        foreach($donnees['images'] as $image) {

            ?>
            <div class="myCol-3">
                <img id="<?= $image->getId_image() ?>" class='addImg' src="<?= $image->getSource()?>" alt="">
            </div>

            <?php
        }

        ?>

    </div>
    <div class="myRow">
        <div class="myCol-12">
            <div class="addSubmit">Ajouter description</div>
        </div>
    </div>


</form>
<div class="myRow">
    <a href="<?= HTTP ?>?admin=addProduit&id_produit=<?=$_GET['id_produit'] ?>">Retour</a>

</div>

<script type="text/javascript">
    initEventDescription();
</script>
