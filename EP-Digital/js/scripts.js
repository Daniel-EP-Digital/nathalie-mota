/* DEBUTCODE CONTACT MODAL */

document.addEventListener('DOMContentLoaded', function() {
    var modal = document.getElementById('contactModal');
    var modalOverlay = document.getElementById('modalOverlay');
    var openModalButtons = document.querySelectorAll('.openContactModal');

    // Fonction pour ouvrir la modale
    function openModal() {
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
            openModal();
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

/* DEBUT CODE MENU MOBILE */

document.addEventListener('DOMContentLoaded', function() {
    var menuToggle = document.querySelector('.menu-toggle');
    var mobileMenu = document.getElementById('mobile-menu');
    var burgerIcon = document.querySelector('.burger-icon');
    var closeIcon = document.querySelector('.close-icon');

    if (menuToggle && mobileMenu) {
        menuToggle.addEventListener('click', function() {
            var isOpen = mobileMenu.classList.toggle('open');
            menuToggle.setAttribute('aria-expanded', isOpen);

            // Toggle the display of the icons
            if (isOpen) {
                burgerIcon.style.display = 'none';
                closeIcon.style.display = 'inline';
            } else {
                burgerIcon.style.display = 'inline';
                closeIcon.style.display = 'none';
            }
        });
    }
});



/* FIN CODE MENU MOBILE */ 



