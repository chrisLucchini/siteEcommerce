<div class="myRow">
    <div class="myCol-12 myCol-sm-12">
        <div class="form-registration">
            <h1 class="form-title">Modification</h1>
            
            <form action="/dev_2019/siteEcommerce/projetE-commerce/index.php?admin=updateInfoProduit&id_produit=<?=$donnees->getId_produit()?>" method="POST">
                
                <div class="myRow">
                    <div class="myCol-12 myCol-sm-12">
                        <label class="label-form">DESIGNATION:</label>

                    </div>

                </div>
                <div class="myRow">
                    <div class="myCol-12 myCol-sm-12">
                        <input name="designation" type="text" class="input-long-size" value='<?= $donnees->getDesignation() ?>'>
                    </div>

                </div>
                <div class="myRow">
                    <div class="myCol-12 myCol-sm-12">
                        <label class="label-form">MARQUE</label>

                    </div>

                </div>
                <div class="myRow">
                    <div class="myCol-12 myCol-sm-12">
                        <input type="text" name="marque" class="input-long-size" value='<?= $donnees->getMarque() ?>'>
                    </div>

                </div>
                <div class="myRow">
                    <div class="myCol-12 myCol-sm-12">
                        <label class="label-form">MODELE</label>

                    </div>

                </div>
                <div class="myRow">
                    <div class="myCol-12 myCol-sm-12">
                        <input type="text" name="modele" class="input-long-size" value='<?= $donnees->getModele() ?>'>
                    </div>

                </div>
                <div class="myRow">
                    <div class="myCol-12 myCol-sm-12">
                        <label class="label-form">CATEGORIE</label>

                    </div>

                </div>
                <div class="myRow">
                    <div class="myCol-12 myCol-sm-12">
                        <input type="text" name="categorie" class="input-long-size" value='<?= $donnees->getCategorie() ?>'>
                    </div>

                </div>
                <div class="myRow">
                    <div class="myCol-12 myCol-sm-12">
                        <label class="label-form">SOUS-CATEGORIE</label>

                    </div>

                </div>
                <div class="myRow">
                    <div class="myCol-12 myCol-sm-12">
                        <input type="text" name="sous_categorie" class="input-long-size" value='<?= $donnees->getSous_categorie() ?>'>
                    </div>

                </div>
                <div class="myRow">
                    <div class="myCol-12 myCol-sm-12">
                        <label class="label-form">PRIX</label>

                    </div>

                </div>
                <div class="myRow">
                    <div class="myCol-12 myCol-sm-12">
                        <input type="text" name="prix" class="input-long-size" value='<?= $donnees->getPrix() ?>'>
                    </div>

                </div>
                <div class="myRow">
                    <div class="myCol-12 myCol-sm-12">
                        <label class="label-form">DESCRIPTION PRODUIT</label>

                    </div>

                </div>
                <div class="myRow">
                    <div class="myCol-12 myCol-sm-12">
                        <textarea name="mini_description_produit" class="long-textarea" ><?= $donnees->getMini_description_produit() ?> </textarea>
                    </div>
                </div>
                <div class="myRow">
                    <div class="myCol-12 myCol-sm-12">
                        <label class="label-form">DESCRIPTION TECHNIQUE</label>

                    </div>

                </div>
                <div class="myRow">
                    <div class="myCol-12 myCol-sm-12">
                        <textarea name="mini_description_technique" class="long-textarea" ><?= $donnees->getMini_description_technique() ?> </textarea>
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