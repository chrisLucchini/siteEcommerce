<tr>
            <td></td>
            <td  class="td-titre-carac"  id='hiddenT-<?=$_GET['id_select'] ?>'>
                <select name="" id="typeH-<?=$_GET['id_select']?>-<?=$_GET['id_produit']?>" class="select-type-H">
        
                    <?php
                        foreach($donnees['type'][$donnees['categorie']] as $key => $value) {

                            ?>
                                <option value="<?= $value?>"><?= $value?></option>
                            <?php
                                                                                 
                        }

                    ?>      
                </select>
            </td>
            <td  class="td-titre-carac" id='hiddenT-<?=$_GET['id_select']?>'>
                <select name="" id="valeurH-<?=$_GET['id_select'] ?>" class="select-val-H">
                    
                    <?php
                    foreach($donnees['caracteristiques'][$donnees['categorie']] as $carac) {
                        
                        ?>
                        <option value="<?=$carac['valeur'] ?>"><?=$carac['valeur'] ?></option>

                        <?php
                        
                    }

                    ?>
                    
                </select>
            </td>
        </tr>