
/* 
DEBUT CODE FILTRE PAGINATION ACCUEIL 
*/

/*Mise en Place de la Pagination Infinie en AJAX */
var currentPage = 1;

jQuery(document).ready(function($) {
    $('#load-more').on('click', function() {
        var button = $(this);
        var page = button.data('page');
        var maxPages = button.data('max-pages');
        
        if (page >= maxPages) {
            button.hide();
            return;
        }

        $.ajax({
            url: ajaxurl, // Le point de terminaison de l'API WordPress
            type: 'post',
            data: {
                action: 'load_more_photos',
                page: page + 1,
            },
            success: function(response) {
                $('.photo-grid').append(response);
                button.data('page', page + 1);
                
                if (button.data('page') >= maxPages) {
                    button.hide();
                }
            }
        });
    });
});

/*Code JavaScript pour les Filtres et le Tri */

jQuery(document).ready(function($) {
    function loadPhotos() {
        $.ajax({
            url: my_ajax_object.ajaxurl, // Nouvelle référence
            type: 'POST',
            data: {
                action: 'filter_photos',
                category: $('#category-filter').val(),
                format: $('#format-filter').val(),
                order: $('#order-filter').val(),
                page: currentPage
            },
            success: function(response) {
                // Traiter la réponse ici
                $('#photo-grid').append(response);
            }
        });
    }
    
    

    $('#category-filter, #format-filter, #sort-order').on('change', function() {
        loadPhotos();
    });
});

/* 
FIN CODE FILTRE PAGINATION ACCUEIL 
*/


/*
DEBUT CODE LIGHTBOX Initialiser Fancybox 
*/

jQuery(document).ready(function($) {
    $('[data-fancybox="gallery"]').fancybox({
        buttons: [
            'zoom',
            'slideShow',
            'fullScreen',
            'thumbs',
            'close'
        ],
        caption: function (instance, item) {
            var $orig = $(item.opts.$orig); // L'élément d'origine

            // Ajout de logs pour déboguer
            console.log('Élément d\'origine:', $orig);
            console.log('Attribut data-reference:', $orig.attr('data-reference'));
            console.log('Attribut data-category:', $orig.attr('data-category'));

            // Récupérer les valeurs d'attribut directement depuis l'élément d'origine
            var ref = $orig.attr('data-reference') || 'Référence non disponible';
            var category = $orig.attr('data-category') || 'Catégorie non disponible';

            // Retourner la légende formatée
            return 'Référence de la photo : ' + ref + ' <span>Catégorie : ' + category + '</span>';
        },
        loop: true,
        arrows: true,
        infobar: false,
        protect: true,
        toolbar: true,
        animationEffect: "zoom",
        transitionEffect: "fade",
        afterLoad: function(instance, current) {
            // Remplace les titres par les versions en français
            $('.fancybox-button--arrow_left').attr('title', 'Précédente');
            $('.fancybox-button--arrow_right').attr('title', 'Suivante');
        }
    });
});







/* DEBUTCODE CONTACT MODAL */

document.addEventListener('DOMContentLoaded', function() {
    var modal = document.getElementById('contactModal');
    var modalOverlay = document.getElementById('modalOverlay');
    var openModalButtons = document.querySelectorAll('.openContactModal');

    // Fonction pour ouvrir la modale
    function openModal(reference) {
        // Préremplir le champ Réf. photo
        var refPhotoField = document.getElementById('ref-photo');
        if (refPhotoField) {
            refPhotoField.value = reference; // Pré-remplit le champ avec la référence
        }
        modalOverlay.style.display = 'flex'; // Utilisez 'flex' pour activer le centrage CSS
    }

    // Fonction pour fermer la modale
    function closeModal() {
        modalOverlay.style.display = 'none';
    }

    // Gestionnaire d'événements pour les boutons ou liens d'ouverture de la modale
    openModalButtons.forEach(function(button) {
        button.addEventListener('click', function(e) {
            e.preventDefault(); // Empêcher le comportement par défaut du lien

            // Récupérer la référence depuis un attribut data ou depuis la page elle-même
            var reference = button.getAttribute('data-reference') || '';

            // Appel de la fonction openModal avec la référence
            openModal(reference);
        });
    });

    // Gestionnaire d'événements pour les clics sur l'overlay
    modalOverlay.addEventListener('click', function(event) {
        // Si l'utilisateur clique sur l'overlay, fermez la modale
        if (event.target === modalOverlay) {
            closeModal();
        }
    });

    // Empêche la fermeture de la modale lorsque l'on clique sur le contenu de la modale
    modal.addEventListener('click', function(event) {
        event.stopPropagation();
    });
});


/* FIN CODE CONTACT MODAL */ 





