<?php
/**
 * The Template for displaying products in a product category. Simply includes the archive template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/taxonomy-product_cat.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see       http://docs.woothemes.com/document/template-structure/
 * @package   WooCommerce/Templates
 * @version     1.6.4
 */

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

//get_header( 'shop' );
get_template_part('templates/content', 'store');?>


<?php //woocommerce_product_loop_start(); //Output the start of a product loop. By default this is a UL.

global $wp_query;
// get the query object

$cat_obj = $wp_query->get_queried_object();

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

//do_action('woocommerce_before_main_content');
?>

 <?php if (apply_filters('woocommerce_show_page_title', true)) : ?>

        <h1 class="page-title"><?php woocommerce_page_title(); ?></h1>

    <?php endif; ?>

    <?php
        /**
         * woocommerce_archive_description hook.
         *
         * @hooked woocommerce_taxonomy_archive_description - 10
         * @hooked woocommerce_product_archive_description - 10
         */
        do_action('woocommerce_archive_description');
    ?>  
 <div class="row iw-product-list <?php //wc_product_cat_class('', $category); ?>">

            <div id="product-wrapper" class="iw-products bgrid-half tab-bgrid-half stack group">    
     
    <?php $term       = get_queried_object();
  
    $slug = '';
    if (!empty($term->term_id)) {
        if ($term->parent == 0) {
            $parent_id = $term->term_id;
                        
        // echo "Category";
        // echo '<pre>',print_r($term,1),'</pre>';                        
                        
            $slug = $term->slug;
        } else {
            $parent_id = $term->term_id;
                        
            $termVar = get_term($parent_id, 'product_cat');
            // echo "Sub Category";
            // echo '<pre>',print_r($termVar,1),'</pre>';
                       
            $slug = $term->slug;
        }
    }
                
    if (!empty($slug)) {
        $args = array( 'post_type' => 'product',
        'posts_per_page' => -1,
        'product_cat' => $slug,
        'orderby' => 'rand' );
        $loop = new WP_Query($args);
        //do_action('woocommerce_before_shop_loop');
        while ($loop->have_posts()) :
            $loop->the_post();
            global $product, $woocommerce_loop; ?>
                            <div class="bgrid product-item iw-wordpress">
                                               <div class="item-wrap">
                                                    <?= $product->get_image($size = 'shop_catalog', $attr = array(), $placeholder = true);?>
                                                    <?php if ($product->is_on_sale()) {
                                                        echo '<div class="sticker">Sale</div>';
}?>
                                                    <a href="<?= $product->get_permalink();?>" class="overlay">                                          
                                    <div class="product-item-table">
                                        <div class="product-item-cell">
                                            <h5><?php the_title(); // (4.2) ?></h5>
                                            <p class="price"><?= $product->get_price_html();?></p>
                                                <div class="button">View Product</div>
                                        </div>  <!-- /product-item-cell -->
                                    </div> <!-- /product-item-table -->
                                                    </a>
                                                </div> <!-- /item-wrap -->
                    </div> <!-- /product-item -->
    
        <?php                                                                                                                                                                                                             endwhile; ?>
    <?php wp_reset_query();
    }
                                ?>
<!-- /product-wrapper -->
    <!-- /iw-post-list -->


<?php
    /**
     * woocommerce_after_main_content hook.
     *
     * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
     */
    do_action('woocommerce_after_main_content');
     // $queried_object = get_queried_object();
     // var_dump( $queried_object );
?>
