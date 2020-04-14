<div class="myRow">
    <div class="myCol-12">
        <h2>GESTION DES UTILISATEURS:</h2>
    </div>
</div>
<?php

foreach($donnees as $user) {

    if($user->getPseudo() != $_SESSION['user']->getPseudo()) {

        ?>
        <div class="myRow">
            <div class="myCol-2 user">
                <a href='<?= HTTP ?>?admin=utilisateur&id_user=<?=$user->getId_utilisateur()?>'><?=$user->getPseudo()?></a>
            </div>
            <div class="myCol-3">
                <a href="<?= HTTP ?>?admin=deleteUser&id_user=<?=$user->getId_utilisateur()?>">
                    <div class="delete-btn">SUPPRIMER</div>
                </a>
            </div>
        </div>
        <?php
    }

}