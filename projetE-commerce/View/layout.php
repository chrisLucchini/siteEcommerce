<!DOCTYPE html>
<html lang="fr">
    <head>
        <link rel = "stylesheet" href = "View/fontawesome/css/all.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
        <script type="text/javascript" src="./View/script/fonctions.js"></script>

        <link href="https://fonts.googleapis.com/css?family=Tomorrow&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="View/MyCss/mycss.css">
        <title><?=$title?></title>
    </head>
    <body>
        <header>
            <nav class="menu-principal">
                <div class="brand">
                    <a href="<?= HTTP?>">Tek-Deal</a>
                </div>
                <div id="menuToggle">
                    <!--
                    A fake / hidden checkbox is used as click reciever,
                    so you can use the :checked selector on it.
                    -->
                    <input type="checkbox" />
                    
                    <!--
                    Some spans to act as a hamburger.
                    
                    They are acting like a real hamburger,
                    not that McDonalds stuff.
                    -->
                    <span></span>
                    <span></span>
                    <span></span>
                    
                    <!--
                    Too bad the menu has to be inside of the button
                    but hey, it's pure CSS magic.
                    -->
                    <ul id="menu">
                    <?php
                    $i = 0;
                    foreach($categorieLayout as $categorieL){

                    ?>
                        <li class='categorie-menu' id='menu-<?= $i ?>'><a href="<?= HTTP ?>?action=categorie&categorie=<?=$categorieL['categorie']?>"><?=$categorieL['categorie']?></a>
                            <ul class='sous-menu' id='sous-menu-<?= $i ?>'>
                                <?php
                                foreach($sous_categorieLayout as $sous_categorie){

                                    if($sous_categorie['categorie'] == $categorieL['categorie']) {
                                        ?>
                                        <li><a href="<?= HTTP ?>?action=sous_categorie&sous_categorie=<?=$sous_categorie['sous_categorie']?>"><?=$sous_categorie['sous_categorie']?></a></li>
                                        <?php


                                    }
                                }

                                ?>
                            </ul>

                        </li>
                    <?php
                    $i++;
                        }
                    ?>                
                    </ul>
                </div>

                <!-- <div class="group-button">
                   
                    <div id="deroulMenu">

                        <!-- <ul>
                            <li class="onglet">
                                <input type="search" class="searchBar">
                            </li>
                            <?php
                            // if(!isset($_SESSION['user'])) {
                            //     ?>
                                <li class="onglet">
                                   <a href="/dev_2019/siteEcommerce/projetE-commerce/?action=login">Connexion</a>
                                </li>
                                <div class="separateur"></div>
                                <li class="onglet">
                                    <a href="/dev_2019/siteEcommerce/projetE-commerce/?action=registration">Inscription</a>
                                </li>
                                <?php
                            // }
                            // else {
                                ?>
                                <li class="onglet">
                                   <a href="/dev_2019/siteEcommerce/projetE-commerce/?action=deconnect">Deconnexion</a>
                                </li>
                                <?php
                            // }
                            ?>
                        </ul> -->
    
                    <!-- </div>

                </div> -->
                <div class="espace"></div>
                
                
                
                    <?php
                    if(isset($_SESSION['user'])) {

                        if($_SESSION['user']->getNiveau() == '2') {

                            echo("<div class='onglet'>");
                            echo("<a href='".HTTP."?admin=accueil'>ADMIN</a>");
                            echo("</div>");
                            echo("<div class='separateurMenu'></div>");

                        }
                        echo("<div class='onglet'>");
                        echo("<a href='".HTTP."?action=mesCommandes'>Bonjour ".$_SESSION['user']->getPseudo()."</a>");
                        echo("</div>");
                        echo("<div class='separateurMenu'></div>");
                        echo("<div class='onglet'>");
                        echo("<a href='".HTTP."?action=panier'><i class='fas fa-shopping-bag icon-panier'></i><div class='bulle-panier'></div></a>");
                        echo("</div>");
                        echo("<div class='separateurMenu'></div>");  
                        echo("<div class='onglet'>");
                        echo("<a href='".HTTP."?action=deconnect'>Deconnexion</a>");
                        echo("</div>");

                    }
                    else {

                        echo("<div class='onglet'>");
                        echo("<a href='".HTTP."?action=registration'>Inscription</a>");
                        echo("</div>");
                        echo("<div class='separateurMenu'></div>");  
                        echo("<div class='onglet'>");
                        echo("<a href='".HTTP."?action=login'>Connexion</a>");
                        echo("</div>");
                    }
                    
                    ?>
                
    
            </nav>
            
            <div aria-live="polite" aria-atomic="true" class = 'bloc-notif'>
                <div class="toast">
                    <div class="toast-header">
                    <strong class="mr-auto">Panier</strong>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="toast-body">
                    Produit ajouté au panier !
                    </div>
                </div>
            </div>
        </header>
        
        
        <div class="myContainer">
            <?=$contenu?>
        </div>

        <!-- <footer class="footer">
            <div class="blocFooter">
                <div class="copyright">Copyright © 2020 : Tous droit réservés</div>
                <div class="infoFooter">
                    <div class="linkFooter">
                        <a href="">Engagement de fidélité</a>
                    </div>
                    <div class="linkFooter">
                        <a href="">condition d'utilisation</a>
                    </div>
                    <div class="linkFooter">
                        <a href="">Mentions Légales</a>
                    </div>
                    <div class="linkFooter">
                        <a href="">Plan du site</a>
                    </div>
                </div>
            </div>
            
        </footer> -->

        
    </body>
    <script>
        menu_dropdown();
        initCountPanier();
    </script>
</html>