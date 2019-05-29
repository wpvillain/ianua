<?php get_template_part('templates/content', 'store');
    /**
   *
   * https://roots.io/using-woocommerce-with-sage/
   *
     * woocommerce_before_main_content hook.
     *
     * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
     * @hooked woocommerce_breadcrumb - 20
     */
    
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;


do_action('woocommerce_before_main_content');
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

    <div class="row iw-product-list">

            <div class="twelve columns header-part">

                <h3>Featured Products</h3>

            </div> 

            <div id="product-wrapper" class="iw-products bgrid-third tab-bgrid-half stack group">
                <?php
                    $params = array(
                                'posts_per_page' => -1,
                                'post_type' => 'product',
                                'columns' => 4
                                ); // (1)
                    $wc_query = new WP_Query($params); // (2)
                    $product = wc_get_product($wc_query->post);
                    $woocommerce_loop['name']    = 'ianua-product-archive';
                    $woocommerce_loop['columns'] = apply_filters( 'ianua_product_archive_columns', $params['columns']);
                    ?>
                    <?php if ($wc_query->have_posts()) : // (3) ?>
                        <?php woocommerce_product_loop_start(); ?>
                        <?php while ($wc_query->have_posts()) : // (4)
                                    $wc_query->the_post(); // (4.1) ?>
                                        <div <?php post_class(); ?>>
                                           <div class="item-wrap">
                                               <?= $product->get_image( $size = 'shop_catalog', $attr = array(), $placeholder = true );?>
                                               <?php if ($product->is_on_sale( )) {
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
                        <?php endwhile; ?>
                        <?php woocommerce_product_loop_end(); ?>
                        <?php wp_reset_postdata(); // (5) ?>
                    <?php else:  ?>
                            <p>
                                 <?php _e( 'No Products' ); // (6) ?>
                            </p>
                    <?php endif; ?>
            </div> <!-- /product-wrapper -->
    </div> <!-- /iw-post-list -->

<?php
    /**
     * woocommerce_after_main_content hook.
     *
     * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
     */
    do_action('woocommerce_after_main_content');
?>