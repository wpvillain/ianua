<?php

use Ianua\Setup;
use Ianua\Wrapper;
use Ianua\Extras;
?>

<!doctype html>
<html <?php language_attributes(); ?> itemscope itemtype="http://schema.org/WebPage">
    <?php get_template_part('templates/head'); ?>
  <body id="top" <?php body_class(); ?>>
    <!--[if IE]>
      <div class="alert alert-warning">
        <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> 
        to improve your experience.', 'ianua'); ?>
      </div>
    <![endif]-->
    <?php // Start Header Part of all Pages ?>

    <?php
      do_action('get_header');
    // All pages minus front page and contact page
    if (is_page() && ! is_front_page()  && ! is_page('Contact')
        || 'post'    ===     get_post_type() && ! is_front_page() || is_404() || is_search()) {
        get_template_part('templates/header-page');
    //Front Page
    } elseif (is_front_page()) {
        get_template_part('templates/header-frontpage');
    //WooCommerce Shop Page, single product page and category page headers
    } elseif (is_post_type_archive('product') || is_singular('product') || is_tax( 'product_cat')) {
              get_template_part('templates/header-store');
    //Contact page header
    } elseif (is_page_template('contact-page.php')) {
              get_template_part('templates/header-contact');
    // All else and there seems to be nothing left really..
    } else {
        get_template_part('templates/header');
    }
    ?>

    <?php // Start Central Content Part of all Pages ?>
    <?php // All Pages minus contact page and front page first part ?>

    <?php if (!is_page_template('contact-page.php') && ! is_front_page() && ! is_404()) { ?>
        <div id="content" <?php	Extras\content_class();   ?>>
            <?php do_action('ianua_before_content_wrap'); ?>
            <div <?php	Extras\content_wrap_class();     ?>>
            <?php do_action('ianua_after_content_wrap'); ?>
    <?php } elseif (is_404()) {?>
        <div id="content" <?php Extras\content_class();   ?>>
            <?php do_action('ianua_before_content_wrap'); ?>
            <!-- <div --> <?php // Extras\content_wrap_class(); ?>
            <?php do_action('ianua_after_content_wrap'); ?>
     <?php } ?>
    
    <?php // End All Pages minus contact page and front page first part ?>
    <?php // Second part post header ?>
    <?php // Pages with left sidebar Start?>

    <?php if (is_page_template([   'grid-page-left-sidebar.php','full-page-left-sidebar.php'])) { ?>
    
        <?php if (Setup\display_sidebar()) : ?>
        <aside id="sidebar"  <?php	Extras\sidebar_class();  ?>>
        <?php include Wrapper\sidebar_path(); ?>
        </aside><!-- /.sidebar -->
        <?php endif; // end sidebars display if statement ?> 
    
        <main id="main" <?php	Extras\main_class();  ?>>
            <?php include Wrapper\template_path(); ?>
        </main><!-- /.main -->
        <?php do_action('ianua_after_main_content'); ?>
        
    <?php // End Pages with left sidebar ?>

    <?php // WooCommerce Shop Page start ?>

    <?php } elseif (taxonomy_exists('product_cat')) { ?>
        
            <main id="main" <?php	Extras\main_class();  ?>>
                <?php include Wrapper\template_path(); ?>
            </main><!-- /.main -->
            
            <?php if (Setup\display_sidebar()) : ?>
                <aside id="sidebar"  <?php	Extras\sidebar_class();  ?>>
                    <?php include Wrapper\sidebar_path(); ?>
                </aside><!-- /.sidebar -->
            <?php endif; // end sidebar display if statment ?>

            <?php do_action('ianua_after_main_content'); ?> 

    <?php // End WooCommerce Shop Page ?>
    <?php // Store category ?>

    <?php } elseif (function_exists('is_product_category')) { // store category ?>
        
            <main id="main" <?php   Extras\main_class();  ?>>
                <?php include Wrapper\template_path(); ?>
            </main><!-- /.main -->
            <?php if (Setup\display_sidebar()) : ?>
            <aside id="sidebar"  <?php  Extras\sidebar_class();  ?>>
                <?php include Wrapper\sidebar_path(); ?>
            </aside><!-- /.sidebar -->
            <?php endif; ?>
        <?php do_action('ianua_after_main_content'); ?> 
    
    <?php // End Store category ?>
    <?php // Start 404 ?>

    
    <?php // End 404 ?>
    <?php // Start Contact Page & Front Page ?>
    
    <?php } else { ?>
        
        <main id="main" <?php	Extras\main_class();  ?>>
            <?php include Wrapper\template_path(); ?>
        </main><!-- /.main -->
        <?php do_action('ianua_after_main_content'); ?> 
        <?php if (Setup\display_sidebar()) : ?>
            <aside id="sidebar"  <?php	Extras\sidebar_class();  ?>>
                <?php include Wrapper\sidebar_path(); ?>
            </aside><!-- /.sidebar -->
        <?php endif; // end sidebar display if statment ?>
    <?php } ?>

    <?php // End Contact and Front Pages ?>
    </div><!-- /.content wrap -->
    </div><!-- /.content -->
    <?php
    do_action('get_footer');
    get_template_part('templates/footer');
    wp_footer();
    ?>
  </body>
</html>