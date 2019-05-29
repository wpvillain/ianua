<?php if (!is_post_type_archive('product') && !is_tax( get_object_taxonomies('product')) && !is_singular( array( 'product' )) && !is_tax( 'product_cat') && !is_page_template( 'contact-page.php' )): ?>
    <?php dynamic_sidebar('sidebar-primary'); ?>
    <?php endif; ?>
    <?php if (is_page_template( 'contact-page.php' )) : ?>
        <?php dynamic_sidebar('contact-page-sidebar'); ?>
    <?php endif; ?> 
    <?php if (is_tax( 'product_cat') && !is_page_template( 'contact-page.php' )) : ?>
        <?php dynamic_sidebar('shop-main'); ?>
    <?php endif;
 
