
<div class="myRow">
      <form enctype="multipart/form-data" method="post" action="">
   <div class="myCol-12">
      <h3>Envoi d'une image</h3>
   </div>
   <div class="myCol-12">
         <input type="hidden" name="MAX_FILE_SIZE" value="250000" />
         <input type="file" name="fic" size=50 />
   </div>
   <div class="myCol-12">
         <label for="type">TYPE</label>
         <select name="type" id="type">
            <option value="principale">Principale</option>
            <option value="carroussel">Carroussel</option>
            <option value="description">Description</option>
            <option value="marque">Marque</option>
         </select>
   </div>
   <div class="myCol-12">
         <input type="text" placeholder="nom de l'image" name='nameImg'/>
   </div>
   <div class="myCol-12">

         <input type="submit" value="Envoyer" name='submitImg'/>
   </div>
   
      </form>
</div>

<div class="myRow">
<?php
foreach($donnees as $image) {
   ?>
   <div class="myCol-3">
      <div class='blocImg'>
         Type: <?=$image->getType() ?>
         <img id="img-<?=$image->getId_image() ?>" src="<?=$image->getSource() ?>" alt="">

      </div>
      <div class="myRow">
         <div class="delete-btn" id="<?= $image->getId_image() ?>">Effacer</div>
      </div>
   </div>

   <?php
}

?>
</div>
      <a href="<?= HTTP ?>?admin=addProduit&id_produit=<?=$_GET['id_produit'] ?>">Retour</a>

<script>deleteImgAjax()</script>