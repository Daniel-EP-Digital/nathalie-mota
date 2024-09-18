<?php

get_header();
?>

<div>
    <div class="hero-section-home">
      <h1> PHOTOGRAPHE EVENT</h1>  
    </div>

</div>

<div class="catalogue-item-photo">
  <!--- Code HTML pour les Filtres et le Tri --->
  <div class="photo-filters">
    
    <form id="filter-form">
        <div class="categories-filters">
            <select class="select" id="category-filter">
                <option value="">Toutes les catégories</option>
                <?php 
                $categories = get_terms('categorie');
                foreach ($categories as $category) {
                    echo '<option value="' . $category->slug . '">' . $category->name . '</option>';
                }
                ?>
            </select>

            <select class="select" id="format-filter">
                <option value="">Tous les formats</option>
                <?php 
                $formats = get_terms('format');
                foreach ($formats as $format) {
                    echo '<option value="' . $format->slug . '">' . $format->name . '</option>';
                }
                ?>
            </select>
        </div>

        <select class="select" id="sort-order">
            <option value="date">Trier par date</option>
            <option value="title">Trier par titre</option>
            <option value="rand">Trier aléatoirement</option>
        </select>
    </form>
</div>

  <div id="photo-catalog">
    <div class="photo-grid" id="photo-grid">
        <?php
        $args = array(
            'post_type' => 'photo', // Nom de votre CPT
            'posts_per_page' => 8, // Affichez les 8 premières photos
            'orderby' => 'date',
            'order' => 'DESC'
        );
        $photo_query = new WP_Query($args);
        if ($photo_query->have_posts()) :
            while ($photo_query->have_posts()) : $photo_query->the_post();
                get_template_part('templates_part/photo-item'); // Utilisation du modèle d'affichage des photos
            endwhile;
            wp_reset_postdata();
        endif;
        ?>
    </div>

    <div class="load-more-catalogue">
      <button class="button" id="load-more" data-page="1" data-max-pages="<?php echo $photo_query->max_num_pages; ?>">Charger plus</button>
    </div>
  </div>
</div>


<?php
get_footer();
?>
