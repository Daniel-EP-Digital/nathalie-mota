/* DEBUT CODE MENU MOBILE */

document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.querySelector('.menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu-container');

    if (menuToggle && mobileMenu) {
        console.log('Éléments trouvés :', menuToggle, mobileMenu);

        menuToggle.addEventListener('click', function() {
            console.log('Bouton menu burger cliqué');
            const isExpanded = menuToggle.getAttribute('aria-expanded') === 'true';
            menuToggle.setAttribute('aria-expanded', !isExpanded);
            mobileMenu.classList.toggle('open');
            menuToggle.classList.toggle('open');
            console.log('Classes après clic :', mobileMenu.className, menuToggle.className);
            console.log('Attribut aria-expanded :', menuToggle.getAttribute('aria-expanded'));
        });
    } else {
        console.error('Un ou plusieurs éléments sont introuvables');
    }
});

/* FIN CODE MENU MOBILE */ 