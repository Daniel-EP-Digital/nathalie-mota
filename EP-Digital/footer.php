</main><!-- #content -->

<footer id="colophon" class="site-footer" role="contentinfo">
    <div class="site-info">
        <?php
        wp_nav_menu( array(
            'theme_location' => 'menu-footer',
            'menu_class'     => 'footer-menu',
        ) );
        ?>
    </div><!-- .site-info -->
</footer><!-- #colophon -->

<?php wp_footer(); ?>

<?php get_template_part('templates_part/contact-modal'); ?>

</body>
</html>