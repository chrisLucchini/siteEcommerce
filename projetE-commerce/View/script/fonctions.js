function menu_dropdown () {

        $('#menuToggle').click(function(){

            $('.sous-menu').hide();

        })
        $('.categorie-menu').hover(function() {

            $('.sous-menu').hide();
            var idM = $(this).attr('id').split('-');
            $('#sous-menu-'+idM[1]).show();
        })

}


function initCountPanier () {

    $.get(
        'http://localhost/dev_2019/siteEcommerce/projetE-commerce/?action=getCountPanier', // Le fichier cible côté serveur.
        {   
        },
        function(res){
            $('.bulle-panier').html(res);
            
        }, // Nous renseignons uniquement le nom de la fonction de retour.
        'text' // Format des données reçues.
    );
}

function notif() {

    $('.btn-panier').click(function(event){
        
        var data = $(this).attr('id').split('-');
        var id_prod = data[1];

        $.get(
            'http://localhost/dev_2019/siteEcommerce/projetE-commerce/?action=panier&id_produit='+id_prod, // Le fichier cible côté serveur.
            {
            },
            initCountPanier, // Nous renseignons uniquement le nom de la fonction de retour.
            'text' // Format des données reçues.
        );

        $('.bloc-notif').show();
        setInterval(function(){

            $('.bloc-notif').hide();
        }, 5000);

        

    })

}



function initEventDescription() {

    $('.radioImg').click(function(event){

        var data = event.target.id.split('-');
        var id_desc = data[1];
        $('#img-'+id_desc).attr('src', event.target.src);
        
    })
    $('.myBtn').click(function(event) {

        var dataDesc = event.target.id.split('-');
        var id_description = dataDesc[1];
        // console.log($('#img-'+id_description).attr('src'));
        // console.log($('#text-'+id_description).val());

        $.post(
            'http://localhost/dev_2019/siteEcommerce/projetE-commerce/?admin=controlDesc', // Le fichier cible côté serveur.
            {
                src_image : $('#img-'+id_description).attr('src'),
                titre_description: $('#titre-'+id_description).val(), // Nous supposons que ce formulaire existe dans le DOM.
                text : $('#text-'+id_description).val(),
                id_description : id_description
            },
            retour, // Nous renseignons uniquement le nom de la fonction de retour.
            'text' // Format des données reçues.
        );
    })
    $('.addSubmit').click(function(event) {


        $.post(
            'http://localhost/dev_2019/siteEcommerce/projetE-commerce/?admin=addDescAjax', // Le fichier cible côté serveur.
            {
                src_image : $('.imageDesc').attr('src'),
                titre_description: $('#titre').val(), // Nous supposons que ce formulaire existe dans le DOM.
                text : $('#text').val(),
                categorie_description: $('#type').val(),
                id_produit: $('#id_prod').html()
            },
            reloading, // Nous renseignons uniquement le nom de la fonction de retour.
            'text' // Format des données reçues.
        );
    })

    $('.addImg').click(function(event){

        $('.imageDesc').attr("src", event.target.src);

    })

    $('#addDesc').click(function(event){

        if($("#formDesc").is(":visible")){

            $('#formDesc').hide();
        }
        else {
            
            $('#formDesc').show();
        }
    })
    $('.descript').click(function(event) {

        //On splite pour récuperer l'id concatener apres le -
        var dataDesc = event.target.id.split('-');
        var id_description = dataDesc[1];

        if($("#b-"+id_description).is(":visible")){

            $('#b-'+id_description).hide();
        }
        else {
            
            $('#b-'+id_description).show();
        }

    })

    $('.delete-btn').click(function(event){

        var dataDesc = event.target.id.split('-');
        var id_description = dataDesc[1];
        // console.log(id_description);

        $.post(
            'http://localhost/dev_2019/siteEcommerce/projetE-commerce/?admin=delDescAjax', // Le fichier cible côté serveur.
            {
                id_desc : id_description
            },
            removeDivDesc, // Nous renseignons uniquement le nom de la fonction de retour.
            'text' // Format des données reçues.
        );
    })
}

function deleteImgAjax() {

    $('.delete-btn').click(function(event) {

        $.post(
            'http://localhost/dev_2019/siteEcommerce/projetE-commerce/?admin=deleteImgAjax', // Le fichier cible côté serveur.
            {
                id_image : event.target.id,
                source_image : $('#img-'+event.target.id).attr('src')
                
            },
            removeDiv, // Nous renseignons uniquement le nom de la fonction de retour.
            'text' // Format des données reçues.
        );


    })
}

function eventCarac() {


    $('.select-type').change(function(event){

        var id_select = event.target.id.split("-")[1];
        var id_produit = event.target.id.split("-")[2];
        // console.log(event.target.value);

        $.get(
            'http://localhost/dev_2019/siteEcommerce/projetE-commerce/?admin=getValeurCaracAjax', // Le fichier cible côté serveur.
            {
                type : event.target.value,
                id_select: id_select,
                id_produit: id_produit

                
            },
            updateSelect, // Nous renseignons uniquement le nom de la fonction de retour.
            'text' // Format des données reçues.
        );
    })

    $('.select-type-H').change(function(){

        var id_select = event.target.id.split("-")[1];
        var id_produit = event.target.id.split("-")[2];
        // console.log(event.target.value);

        $.get(
            'http://localhost/dev_2019/siteEcommerce/projetE-commerce/?admin=getValeurCaracAjax', // Le fichier cible côté serveur.
            {
                type : event.target.value,
                id_select: id_select,
                id_produit: id_produit

                
            },
            updateSelectHide, // Nous renseignons uniquement le nom de la fonction de retour.
            'text' // Format des données reçues.
        );


    })

    $('.hiddenCarac').click(function(event) {

        var categorie = event.target.id.split("-")[0];
        var id_select = event.target.id.split("-")[1];
        var id_produit = event.target.id.split("-")[2];

        $.get(
            'http://localhost/dev_2019/siteEcommerce/projetE-commerce/?admin=getTdHtmlAddCarac', // Le fichier cible côté serveur.
            {
                categorie : categorie,
                id_select: id_select,
                id_produit: id_produit
                
            },
            insertHtmlTd, // Nous renseignons uniquement le nom de la fonction de retour.
            'text' // Format des données reçues.
        );

    })

    $('.myBtn').click(function(){

            var typeAdd = [];
            var valeurAdd = [];

            var type = [];
            var valeur = [];
            var niveau = [];
            var id_carac = [];
            var id_produit;
            

            $('.select-type').each(function(){

                type.push($(this).val());
                id_produit = $(this).attr('id').split("-")[2];
                id_carac.push($(this).attr('id').split('-')[3]);
            });
           
            $('.select-val').each(function(){
                
                valeur.push($(this).val());
            });
            
            $('.select-lvl').each(function(){
                
                niveau.push($(this).val());
            });


            $('.select-type-H').each(function(){

                typeAdd.push($(this).val());
                id_produit = $(this).attr('id').split("-")[2];
                
            });

            $('.select-val-H').each(function(){

                valeurAdd.push($(this).val());

            });

            $.post(
                'http://localhost/dev_2019/siteEcommerce/projetE-commerce/?admin=updateCaracAjax', // Le fichier cible côté serveur.
                {
                    type : JSON.stringify(type),
                    valeur: JSON.stringify(valeur),
                    niveau: JSON.stringify(niveau),
                    id_produit: id_produit,
                    id_carac: JSON.stringify(id_carac)               
                },
                reloading, // Nous renseignons uniquement le nom de la fonction de retour.
                'text' // Format des données reçues.
            );
            $.post(
                'http://localhost/dev_2019/siteEcommerce/projetE-commerce/?admin=addCaracAjax', // Le fichier cible côté serveur.
                {
                    type : JSON.stringify(typeAdd),
                    valeur: JSON.stringify(valeurAdd),
                    id_produit: id_produit
                },
                reloading, // Nous renseignons uniquement le nom de la fonction de retour.
                'text' // Format des données reçues.
            );

    })

    $('.newCarac').click(function(){

        id_produit = $(this).attr('id').split("-")[1];

        $.get(
            'http://localhost/dev_2019/siteEcommerce/projetE-commerce/?admin=getHtmlForCreateCarac', // Le fichier cible côté serveur.
            {
                id_produit : id_produit
                
                
            },
            insertHtmlCreate, // Nous renseignons uniquement le nom de la fonction de retour.
            'text' // Format des données reçues.
        );
        
    })

    $('.delete-btn').click(function(event){

        id_produit = $(this).attr('id').split("-")[2];
        id_carac = $(this).attr('id').split("-")[1];
        $(this).parent().parent().remove();

        $.post(
            'http://localhost/dev_2019/siteEcommerce/projetE-commerce/?admin=deleteCaracAjax', // Le fichier cible côté serveur.
            {
                id_carac : id_carac,
                id_produit: id_produit
            },
            retour, // Nous renseignons uniquement le nom de la fonction de retour.
            'text' // Format des données reçues.
        );
    });


}

function updateSelect (res){

    var donnees = JSON.parse(res);
    $('#valeur-'+donnees['id_select']).empty();
    for(var i=0; i<donnees['valeurs'].length; i++) {

        $('#valeur-'+donnees['id_select']).append('<option value="'+donnees['valeurs'][i].valeur+'">'+donnees['valeurs'][i].valeur+'</option>');
        console.log(donnees['valeurs'][i]);
    }
    
}
function updateSelectHide (res){

    var donnees = JSON.parse(res);
    $('#valeurH-'+donnees['id_select']).empty();
    for(var i=0; i<donnees['valeurs'].length; i++) {

        $('#valeurH-'+donnees['id_select']).append('<option value="'+donnees['valeurs'][i].valeur+'">'+donnees['valeurs'][i].valeur+'</option>');
        console.log(donnees['valeurs'][i]);
    }
    
}
function insertHtmlTd(res) {

    var donnees = JSON.parse(res);
    console.log('#'+donnees['categorie']+'-'+donnees['id_select']+'-'+donnees['id_produit']);
    $('#'+donnees['categorie']+'-'+donnees['id_select']+'-'+donnees['id_produit']).parent().parent().append(donnees['html']);
}

function insertHtmlCreate(res) {

    var html =res;
    // console.log(html);
    $('.newCarac').parent().parent().append(html);

    $('.creer').click(function(){

        var type = [];
        var valeur = [];
        var categorie = [];
        var niveau = [];

        var id_produit = $(this).attr('id').split("-")[1];

        $('.newCategorie').each(function(){
                
            categorie.push($(this).val());
        });

        $('.newType').each(function(){

            type.push($(this).val());
            
        });

        $('.newVal').each(function(){

            valeur.push($(this).val());

        });
        $('.newLvl').each(function(){

            niveau.push($(this).val());

        });

        $.post(
            'http://localhost/dev_2019/siteEcommerce/projetE-commerce/?admin=createCaracAjax', // Le fichier cible côté serveur.
            {
                type : JSON.stringify(type),
                valeur: JSON.stringify(valeur),
                categorie: JSON.stringify(categorie),
                niveau: JSON.stringify(niveau),
                id_produit: id_produit
            },
            reloading, // Nous renseignons uniquement le nom de la fonction de retour.
            'text' // Format des données reçues.
        );


    })

}

function removeDivDesc(res) {

    console.log(res);
    $('#b-'+res.trim()).remove();
    $('#bloc-'+res.trim()).parent().parent().parent().remove();


}

function retour(res) {

    console.log(res);
}

function removeDiv(res) {
    
    console.log(res);
    $('#img-'+res.trim()).parent().parent().remove();
    $('#'+res.trim()).parent().remove();
}

function reloading(res) {

    // console.log(res);
    window.location.reload(true);
}


function init_filtre_produit(){

    var filtre = {};
    var marque = "";
    var categorie = "";

    $('.input-mid-size').change(function(){

        console.log($(this).attr('name'));
        if($(this).attr('name') == "marque"){

            if($(this).val() != "none"){

                categorie = $(this).attr('id').split("-")[1];                
                marque = $(this).val();
                console.log(marque);

            }
            else {

                marque = "";
            }

        }

        if($(this).val() != "none" && $(this).attr('name') != "marque") {

            filtre[$(this).attr('id')] = $(this).val();

        }
        else{

            delete filtre[$(this).attr('id')];
        }
        console.log(categorie);

        $.post(
            'http://localhost/dev_2019/siteEcommerce/projetE-commerce/?action=ajaxFiltre', // Le fichier cible côté serveur.
            {
                filtres : JSON.stringify(filtre),
                marque : marque,
                categorie: categorie
               
            },
            filter, // Nous renseignons uniquement le nom de la fonction de retour.
            'text' // Format des données reçues.
        );
    })
}

function filter(res){

    res = res.trim();
    if(res != 'null'){

        $('.myCol-8.produit').html(res);
    }
    else{

        reloading(res);
    }


}


function carrouselProduct() {

    
    var carousel = document.querySelector('.carouselProduct'),
    figure = carousel.querySelector('figure'),
    nav = carousel.querySelector('nav'),
    numImages = figure.childElementCount,
    theta = 2 * Math.PI / numImages,
    currImage = 0;
    
    for(var i = 2; i<numImages; i++) {

        $(".carouselProduct figure img:nth-child("+i+")").css("transform","rotateY(".concat((i-1) * theta, "rad)"));

    }
    nav.addEventListener('click', function(e){

        e.stopPropagation();
        var t = e.target;
        if (t.tagName.toUpperCase() != 'BUTTON') return;

        if (t.classList.contains('next')) {
        currImage++;
        } else {
        currImage--;
        }

        figure.style.transform = "rotateY(".concat(currImage * -theta, "rad)");


        }, true);

}

function ratingEvent() {

    $("input[class='fa fa-star']").click(function(e){

        $(this).prevAll().removeClass();
        $(this).prevAll().addClass("fa fa-star gold");
        $(this).nextAll().removeClass();
        $(this).nextAll().addClass("fa fa-star");
        $(this).removeClass();
        $(this).addClass("fa fa-star gold");

    })
}
