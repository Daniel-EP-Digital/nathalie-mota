document.addEventListener('DOMContentLoaded', function() {
    const categoryFilter = document.getElementById('category-filter');
    const formatFilter = document.getElementById('format-filter');
    const sortOrder = document.getElementById('sort-order');
    const loadMoreButton = document.getElementById('load-more');
    const photoGrid = document.getElementById('photo-grid');

    let page = 1;
    const photosPerPage = 8; // Assurez-vous que ce nombre correspond à celui utilisé dans votre requête WP_Query

    function fetchPhotos() {
        const category = categoryFilter.value;
        const format = formatFilter.value;
        const order = sortOrder.value;

        const data = {
            action: 'filter_photos',
            category: category,
            format: format,
            order: order,
            page: page
        };

        fetch(ajaxurl.ajaxurl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams(data)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                if (page === 1) {
                    photoGrid.innerHTML = data.data.html;
                } else {
                    photoGrid.innerHTML += data.data.html;
                }

                // Masquer le bouton "Charger plus" si moins de photos que prévu sont retournées
                if (data.data.html.trim() === '' || data.data.html.split('class="photo-item"').length - 1 < photosPerPage) {
                    loadMoreButton.style.display = 'none';
                } else {
                    loadMoreButton.style.display = 'block';
                }
            } else {
                console.error('Erreur lors du chargement des photos:', data);
            }
        })
        .catch(error => console.error('Erreur lors de la requête:', error));
    }

    categoryFilter.addEventListener('change', function() {
        page = 1;
        fetchPhotos();
    });

    formatFilter.addEventListener('change', function() {
        page = 1;
        fetchPhotos();
    });

    sortOrder.addEventListener('change', function() {
        page = 1;
        fetchPhotos();
    });

    loadMoreButton.addEventListener('click', function() {
        page++;
        fetchPhotos();
    });
});