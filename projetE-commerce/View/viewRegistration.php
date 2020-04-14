<div class="myRow">
    <div class="myCol-12 myCol-sm-12">
        <div class="form-registration">
            <h1 class="form-title">Inscrivez-vous</h1>
            <p>Un seul identifiant suffit pour tous nos services.
                Vous avez déjà un compte? <a href="<?= HTTP ?>?action=login">Connectez vous</a></p>
            <form action="<?= HTTP ?>?action=registration" method="POST">
                <div class="myRow">
                    <div class="myCol-12 myCol-sm-12">
                        <label class="label-form">Votre nom:</label>

                    </div>

                </div>
                <div class="myRow">
                    <div class=" myCol-6 myCol-sm-12">
                        <input type="text" name="nom" class="input-mid-size" placeholder="Nom">
                    </div>
                    <div class="myCol-6 myCol-sm-12">
                        <input type="text" name="prenom" class="input-mid-size"  placeholder="Prenom">
                        
                    </div>


                </div>
                <div class="myRow">
                    <div class="myCol-12 myCol-sm-12">
                        <label class="label-form">Votre pseudo:</label>

                    </div>

                </div>
                <div class="myRow">
                    <div class="myCol-12 myCol-sm-12">
                        <input name="pseudo" type="text" class="input-long-size" placeholder="Pseudo">
                    </div>

                </div>
                <div class="myRow">
                    <div class="myCol-12 myCol-sm-12">
                        <label class="label-form">Votre adresse mail:</label>

                    </div>

                </div>
                <div class="myRow">
                    <div class="myCol-12 myCol-sm-12">
                        <input type="email" name="mail" class="input-long-size" placeholder="Ex: user@gmail.com">
                    </div>

                </div>
                
                <div class="myRow">
                    <div class="myCol-12 myCol-sm-12">
                        <label class="label-form">Votre mot de passe:</label>

                    </div>

                </div>
                <div class="myRow">
                    <div class="myCol-12 myCol-sm-12">
                        <input type="password" name="password" class="input-long-size" placeholder="Mot de passe">
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