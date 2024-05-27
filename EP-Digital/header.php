<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php endif; ?>
    <?php wp_head(); ?>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,500;1,300;1,500&family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
</head>

<body <?php body_class(); ?>>
<header id="masthead" class="site-header" role="banner">
    <div class="global-header">
        <div class="site-branding">
            <?php
            if ( function_exists( 'the_custom_logo' ) ) {
            the_custom_logo();
            }
            ?>
        </div>
        <div>
            <?php
                if ( has_nav_menu( 'primary' ) ) {
                    wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'menu_id'        => 'primary-menu',
                        'container'      => 'nav',
                        'container_class'=> 'primary-menu-container',
                        'menu_class'     => 'primary-menu',
                    ) );
                }
            ?>
        </div>
            <!-- Bouton menu burger -->
            <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                <span class="burger-icon">&#9776;</span>
                <span class="close-icon" style="display: none;">&times;</span>
            </button>
        <!-- Conteneur pour le menu mobile -->

            <nav id="mobile-menu" class="mobile-menu">
                <?php
                    wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'menu_id'        => 'primary-menu-mobile',
                        'container'      => false,
                        'menu_class'     => 'primary-menu',
                    ) );
                ?>
            </nav>

    </div>

</header>

<main id="content" class="site-content">
