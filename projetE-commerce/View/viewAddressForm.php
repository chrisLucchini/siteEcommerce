<div class="myRow">
    <div class="myCol-12 myCol-sm-12">
        <div class="form-registration">
            <h1 class="form-title">Ajout d'adresse</h1>
            <form action="<?= HTTP ?>?action=addAddress&submit=ok" method="POST">
                <div class="myRow">
                    <div class="myCol-12 myCol-sm-12">
                        <label class="label-form">Prenom et nom:</label>

                    </div>

                </div>
                <div class="myRow">
                    <div class=" myCol-6 myCol-sm-12">
                        <input type="text" name="prenom_nom" class="input-mid-size" placeholder="Prenom Nom">
                    </div>


                </div>
                <div class="myRow">
                    <div class="myCol-12 myCol-sm-12">
                        <label class="label-form">Adresse Ligne 1:</label>

                    </div>

                </div>
                <div class="myRow">
                    <div class="myCol-12 myCol-sm-12">
                        <input name="adresse_ligne1" type="text" class="input-long-size" placeholder="Avenue, Rue ...">
                    </div>

                </div>
                <div class="myRow">
                    <div class="myCol-12 myCol-sm-12">
                        <label class="label-form">Adresse Ligne 2:</label>

                    </div>

                </div>
                <div class="myRow">
                    <div class="myCol-12 myCol-sm-12">
                        <input type="text" name="adresse_ligne2" class="input-long-size" placeholder="Batiment, N°Appartement...">
                    </div>

                </div>
                
                <div class="myRow">
                    <div class="myCol-12 myCol-sm-12">
                        <label class="label-form">Ville:</label>

                    </div>

                </div>
                <div class="myRow">
                    <div class="myCol-12 myCol-sm-12">
                        <input type="text" name="ville" class="input-long-size" placeholder="Ex: Ajaccio">
                    </div>

                </div>
                <div class="myRow">
                    <div class="myCol-12 myCol-sm-12">
                        <label class="label-form">Région:</label>

                    </div>

                </div>
                <div class="myRow">
                    <div class="myCol-12 myCol-sm-12">
                        <input type="text" name="region" class="input-long-size" placeholder="Ex: Corse du sud">
                    </div>

                </div>
                <div class="myRow">
                    <div class="myCol-12 myCol-sm-12">
                        <label class="label-form">Code postal:</label>

                    </div>

                </div>
                <div class="myRow">
                    <div class="myCol-12 myCol-sm-12">
                        <input type="text" name="code_postal" class="input-long-size" placeholder="Ex: 20090">
                    </div>

                </div>
                <div class="myRow">
                    <div class="myCol-12 myCol-sm-12">
                        <label class="label-form">Numéro de téléphone:</label>

                    </div>

                </div>
                <div class="myRow">
                    <div class="myCol-12 myCol-sm-12">
                        <input type="tel" name="telephone" class="input-long-size" placeholder="Ex: 0620572922">
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