<?php 
function theme_slug_setup() {
    add_theme_support( 'title-tag' );

        // Support pour logo personnalisé.
        add_theme_support( 'custom-logo', array(
            'height'      => 100,
            'width'       => 400,
            'flex-width'  => true,
            'flex-height' => true,
        ) );
    
        // Enregistrement d'un emplacement de menu
        register_nav_menus( array(
            'primary' => esc_html__( 'Primary Menu', 'theme-slug' ),
        ) );
 }
 add_action( 'after_setup_theme', 'theme_slug_setup' );
 
 function load_custom_styles() {
    wp_enqueue_style('custom-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'load_custom_styles');

// OPTION MENU FOOTER

function my_theme_add_footer_menu() {
    register_nav_menu( 'menu-footer', __( 'Footer Menu', 'my-theme' ) );
}
add_action( 'init', 'my_theme_add_footer_menu' );

// Ajoute le script de la custom-modal

function theme_enqueue_scripts() {
    wp_enqueue_script('custom-modal', get_stylesheet_directory_uri() . '/js/scripts.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'theme_enqueue_scripts');
