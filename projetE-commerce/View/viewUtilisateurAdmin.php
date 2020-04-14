<div class="myRow">
    <div class="myCol-12 myCol-sm-12">
        <div class="form-registration">
            <h1 class="form-title">Modification utilisateur: </h1>
            <form action="<?= HTTP ?>?admin=updateUser&id_user=<?=$donnees->getId_utilisateur()?>" method="POST">
                <div class="myRow">
                    <div class="myCol-12 myCol-sm-12">
                        <label class="label-form">Nom:</label>

                    </div>

                </div>
                <div class="myRow">
                    <div class=" myCol-12 myCol-sm-12">
                        <input type="text" name="nom" class="input-mid-size" value="<?=$donnees->getNom()?>"placeholder="Nom">
                    </div>
                </div>
                <div class="myRow">
                    <div class="myCol-12 myCol-sm-12">
                        <label class="label-form">Prenom:</label>

                    </div>

                </div>
                <div class="myRow">
                    <div class="myCol-12 myCol-sm-12">
                        <input type="text" name="prenom" class="input-mid-size"  value="<?=$donnees->getPrenom()?>"placeholder="Prenom">    
                    </div>
                </div>
                <div class="myRow">
                    <div class="myCol-12 myCol-sm-12">
                        <label class="label-form">Pseudo:</label>

                    </div>

                </div>
                <div class="myRow">
                    <div class="myCol-12 myCol-sm-12">
                        <input name="pseudo" type="text" class="input-long-size" value="<?=$donnees->getPseudo()?>"placeholder="Pseudo">
                    </div>

                </div>
                <div class="myRow">
                    <div class="myCol-12 myCol-sm-12">
                        <label class="label-form">Adresse mail:</label>

                    </div>

                </div>
                <div class="myRow">
                    <div class="myCol-12 myCol-sm-12">
                        <input type="email" name="mail" value="<?=$donnees->getEmail_user()?>"class="input-long-size" placeholder="Ex: user@gmail.com">
                    </div>

                </div>
                <div class="myRow">
                    <div class="myCol-12 myCol-sm-12">
                        <label class="label-form">Niveau de privilège:</label>

                    </div>

                </div>
                <div class="myRow">
                    <div class="myCol-12 myCol-sm-12">
                        <input type="text" name="niveau" value="<?=$donnees->getNiveau()?>"class="input-long-size" placeholder="Ex: user@gmail.com">
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