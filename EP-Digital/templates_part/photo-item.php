<div class="photo-item" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>'); background-size: cover; background-position: center;">
         <a class="icon-open-lightboxe" href="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>" 
                data-fancybox="gallery" 
                class="lightboxe-icon" 
                data-reference="<?php echo esc_attr(get_post_meta(get_the_ID(), 'reference', true)); ?>" 
                data-category="<?php echo esc_attr(wp_strip_all_tags(get_the_term_list(get_the_ID(), 'categorie', '', ', ', ''))); ?>">
                <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="17" cy="17" r="17" fill="black"/>
                    <line x1="15" y1="10.5" x2="10" y2="10.5" stroke="white"/>
                    <line y1="-0.5" x2="5" y2="-0.5" transform="matrix(-1 8.74227e-08 8.74227e-08 1 15 24)" stroke="white"/>
                    <line x1="9.5" y1="16" x2="9.5" y2="10" stroke="white"/>
                    <line y1="-0.5" x2="6" y2="-0.5" transform="matrix(4.37114e-08 1 1 -4.37114e-08 10 18)" stroke="white"/>
                    <line y1="-0.5" x2="5" y2="-0.5" transform="matrix(1 -8.74227e-08 -8.74227e-08 -1 19 10)" stroke="white"/>
                    <line y1="-0.5" x2="6" y2="-0.5" transform="matrix(-4.37114e-08 -1 -1 4.37114e-08 24 16)" stroke="white"/>
                    <line x1="19" y1="23.5" x2="24" y2="23.5" stroke="white"/>
                    <line x1="24.5" y1="18" x2="24.5" y2="24" stroke="white"/>
                </svg>
        </a>



    <a href="<?php the_permalink(); ?>" class="photo-link">
        <div class="photo-overlay"></div>
        <i class="photo-info eye-icon fa-solid fa-eye"></i>
        <span class="photo-info photo-reference">
            <?php 
            $photo_reference = get_post_meta(get_the_ID(), 'reference', true);
            echo !empty($photo_reference) ? esc_html($photo_reference) : 'Référence non disponible'; 
            ?>
        </span>

    </a>

    <span class="photo-info photo-category">
            <?php the_terms(get_the_ID(), 'categorie'); ?>
    </span>


</div>
