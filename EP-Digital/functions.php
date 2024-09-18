<?php 

function theme_slug_setup() {
    add_theme_support('title-tag');

    // Support pour logo personnalisé.
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-width'  => true,
        'flex-height' => true,
    ));

    // Enregistrement d'un emplacement de menu
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'theme-slug'),
    ));
}
add_action('after_setup_theme', 'theme_slug_setup');

function load_custom_styles() {
    wp_enqueue_style('custom-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'load_custom_styles');

// INTEGRER Fancybox dans le Template "photo-item.php" 
function enqueue_fancybox_scripts() {
    wp_enqueue_style('fancybox-css', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css');
    wp_enqueue_script('fancybox-js', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js', array('jquery'), null, true);    
}
add_action('wp_enqueue_scripts', 'enqueue_fancybox_scripts');



// RELIER AU FICHIER custom.js

function enqueue_custom_scripts() {
    wp_enqueue_script('custom-js', get_template_directory_uri() . '/js/custom.js', array('jquery'), null, true);
    wp_localize_script('custom-js', 'ajaxurl', array('ajaxurl' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');

// CODE AJAX POUR LES FILTRES 

function filter_photos() {
    $paged = isset($_POST['page']) ? $_POST['page'] : 1;
    $category = isset($_POST['category']) ? $_POST['category'] : '';
    $format = isset($_POST['format']) ? $_POST['format'] : '';
    $order = isset($_POST['order']) ? $_POST['order'] : 'date';

    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => 8, // Affichez 8 photos par page
        'paged' => $paged,
        'orderby' => $order,
        'order' => 'DESC',
    );

    if ($category) {
        $args['tax_query'][] = array(
            'taxonomy' => 'categorie',
            'field' => 'slug',
            'terms' => $category,
        );
    }

    if ($format) {
        $args['tax_query'][] = array(
            'taxonomy' => 'format',
            'field' => 'slug',
            'terms' => $format,
        );
    }

    $photo_query = new WP_Query($args);

    ob_start();
    if ($photo_query->have_posts()) :
        while ($photo_query->have_posts()) : $photo_query->the_post();
            get_template_part('templates_part/photo-item');
        endwhile;
    endif;
    $html = ob_get_clean();

    wp_reset_postdata();

    wp_send_json_success(array('html' => $html));
}
add_action('wp_ajax_filter_photos', 'filter_photos');
add_action('wp_ajax_nopriv_filter_photos', 'filter_photos');

function load_more_photos() {
    $paged = isset($_POST['page']) ? $_POST['page'] + 1 : 2;

    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => 4, // Charger 4 photos supplémentaires
        'paged' => $paged,
    );

    $photo_query = new WP_Query($args);

    ob_start();
    if ($photo_query->have_posts()) :
        while ($photo_query->have_posts()) : $photo_query->the_post();
            get_template_part('templates_part/photo-item');
        endwhile;
    endif;
    $html = ob_get_clean();

    wp_reset_postdata();

    wp_send_json_success(array('html' => $html));
}
add_action('wp_ajax_load_more_photos', 'load_more_photos');
add_action('wp_ajax_nopriv_load_more_photos', 'load_more_photos');

// OPTION MENU FOOTER
function my_theme_add_footer_menu() {
    register_nav_menu('menu-footer', __('Footer Menu', 'my-theme'));
}
add_action('init', 'my_theme_add_footer_menu');

// Ajoute le script de la custom-modal
function theme_enqueue_scripts() {
    wp_enqueue_script('custom-modal', get_stylesheet_directory_uri() . '/js/scripts.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'theme_enqueue_scripts');

// AJOUT CODE AJAXURL POUR FAIRE FONCTIONNER LES FILTRES 
function my_enqueue_scripts() {
    wp_enqueue_script('my-custom-js', get_template_directory_uri() . '/js/scripts.js', array('jquery'), null, true);

    // Localiser la variable ajaxurl pour l'utiliser dans le JS
    wp_localize_script('my-custom-js', 'my_ajax_object', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
    ));
}
add_action('wp_enqueue_scripts', 'my_enqueue_scripts');

// AJOUT CODE JS POUR LE BURGER ET MENU MOBILE 

function enqueue_burger_menu_script() {
    wp_enqueue_script('burger-menu-js', get_template_directory_uri() . '/js/burger-menu.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_burger_menu_script');

// FIN // AJOUT CODE JS POUR LE BURGER ET MENU MOBILE 