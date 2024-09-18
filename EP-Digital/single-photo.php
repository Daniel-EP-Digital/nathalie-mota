<?php

get_header(); // Inclure l'en-tête du thème
?>

<div class="single-photo-template">
    <div class="left-column">
        <div class="photo-header">
            <h1 class="title-single-photo"><?php the_title(); // Titre du post ?></h1>
            <div class="photo-meta">
                <p>Référence : <?php echo get_post_meta(get_the_ID(), 'reference', true); // Référence ?></p>
                <?php
                // Pour la catégorie
                $categories = get_the_terms(get_the_ID(), 'categorie');
                if ($categories && !is_wp_error($categories)) {
                    $category = $categories[0]; // Récupérer le premier élément
                    echo '<p>Catégorie : ' . esc_html($category->name) . '</p>'; // Afficher le nom de la catégorie
                }

                // Pour le format
                $formats = get_the_terms(get_the_ID(), 'format');
                if ($formats && !is_wp_error($formats)) {
                    $format = $formats[0]; // Récupérer le premier élément
                    echo '<p>Format : ' . esc_html($format->name) . '</p>'; // Afficher le nom du format
                }
                ?>
                <p>Type : <?php echo get_post_meta(get_the_ID(), 'Type', true); // Type ?></p>
                <p>Année : <?php echo get_the_date('Y'); // Année de création ?></p>
            </div>
        </div>
        <div class="photo-contact">
            <p>Cette photo vous intéresse ?</p>
            <a href="#" class="button openContactModal" data-reference="<?php echo esc_attr(get_post_meta(get_the_ID(), 'reference', true)); ?>">Contact</a>

        </div>
    </div>
    <div class="right-column">
        <div class="photo-image">
            <?php if (has_post_thumbnail()) {
                the_post_thumbnail('large'); // Image mise en avant
            } ?>
        </div>
        
        <div class="navigation-photos">
        <?php
        global $post;

        // Récupérer le post précédent basé sur la date de publication
        $prev_post = get_posts(array(
            'post_type' => 'photo', // Changez ceci pour correspondre à votre type de post personnalisé
            'posts_per_page' => 1,
            'orderby' => 'date',
            'order' => 'DESC',
            'post_status' => 'publish',
            'date_query' => array(
                array(
                    'before' => get_the_date('Y-m-d H:i:s', $post->ID),
                    'inclusive' => false,
                ),
            ),
        ));

        // Récupérer le post suivant basé sur la date de publication
        $next_post = get_posts(array(
            'post_type' => 'photo', // Changez ceci pour correspondre à votre type de post personnalisé
            'posts_per_page' => 1,
            'orderby' => 'date',
            'order' => 'ASC',
            'post_status' => 'publish',
            'date_query' => array(
                array(
                    'after' => get_the_date('Y-m-d H:i:s', $post->ID),
                    'inclusive' => false,
                ),
            ),
        ));
        ?>
        <?php if (!empty($prev_post)) : ?>
            <div class="nav-photo nav-prev">
                <a href="<?php echo get_permalink($prev_post[0]->ID); ?>">
                    <div class="nav-arrow">&larr;</div>
                    <div class="nav-thumbnail">
                        <?php echo get_the_post_thumbnail($prev_post[0]->ID, 'thumbnail'); ?>
                    </div>
                </a>
            </div>
        <?php endif; ?>
        <?php if (!empty($next_post)) : ?>
            <div class="nav-photo nav-next">
                <a href="<?php echo get_permalink($next_post[0]->ID); ?>">
                    <div class="nav-arrow">&rarr;</div>
                    <div class="nav-thumbnail">
                        <?php echo get_the_post_thumbnail($next_post[0]->ID, 'thumbnail'); ?>
                    </div>
                </a>
            </div>
        <?php endif; ?>
    </div>
    </div>

</div>
<div class="related-photos">
    <h2>Vous aimerez aussi</h2>
    
    <?php
    // Récupère les termes de la taxonomie 'categorie' pour le post actuel
    $categories = get_the_terms(get_the_ID(), 'categorie');
    if ($categories && !is_wp_error($categories)) {
        $category = $categories[0]; // Récupère le premier terme de la liste
        $category_id = $category->term_id;

        // Requête pour les photos liées
        $related_photos = new WP_Query(array(
            'post_type' => 'photo',
            'posts_per_page' => 2, // Nombre de posts à afficher
            'post__not_in' => array(get_the_ID()), // Exclure le post actuel
            'orderby' => 'rand', // Ordre aléatoire
            'tax_query' => array(
                array(
                    'taxonomy' => 'categorie',
                    'field'    => 'term_id',
                    'terms'    => $category_id, // Filtrer par la catégorie actuelle
                ),
            ),
        ));

        if ($related_photos->have_posts()) : ?>
            <div class="related-photos-grid">
                <?php while ($related_photos->have_posts()) : $related_photos->the_post(); ?>
                    <?php get_template_part('templates_part/photo-item'); // Appelle le template photo-item.php ?>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        <?php endif; 
    }
    ?>
</div>



<?php
get_footer(); // Inclure le pied de page du thème
?>
