<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product, $woocommerce_loop;

if ( empty( $product ) || ! $product->exists() ) {
	return;
}

if ( ! $related = wc_get_related_products( $product->get_id(), $args['posts_per_page'] )) {
	return;
}

$args = apply_filters( 'woocommerce_related_products_args', array(
	'post_type'            => 'product',
	'ignore_sticky_posts'  => 1,
	'no_found_rows'        => 1,
	'posts_per_page'       => $posts_per_page,
	'orderby'              => $orderby,
	'post__in'             => $related,
	'post__not_in'         => array( $product->get_id() )
) );

$products                    = new WP_Query( $args );
$woocommerce_loop['name']    = 'related';
$woocommerce_loop['columns'] = apply_filters( 'woocommerce_related_products_columns', $columns );

if ( $products->have_posts() ) : ?>

	<div class="row iw-product-list">
		<div class="twelve columns header-part">
			<h3><?php _e( 'Related Products', 'woocommerce' ); ?></h3>
		</div>
		<div id="product-wrapper" class="iw-products bgrid-third tab-bgrid-half stack group">

			<?php woocommerce_product_loop_start(); ?>

				<?php while ( $products->have_posts() ) : $products->the_post(); $url = get_permalink( $products->post->ID ); ?>
					<div class="bgrid product-item iw-wordpress">
		               <div class="item-wrap">
			               	<?= $product->get_image( $size = 'shop_catalog', $attr = array(), $placeholder = true );?>
	                           <?php if ($product->is_on_sale( )) {
	                               echo '<div class="sticker">Sale</div>';
	                           }?>
	                            <a href="<?= $url;?>" class="overlay">                                          
	                                <div class="product-item-table">
	                                    <div class="product-item-cell">
	                                        <h5><?php the_title(); // (4.2) ?></h5>
	                                        <p class="price"><?= $product->get_price_html();?></p>
					                        <div class="button">Add to Cart</div>
			     					    </div> 
				                      	
				                     </div>                    
				                 </a>
		               </div>
	    		</div> <!-- /product-item -->

			<?php endwhile; // end of the loop. ?>
		</div> <!-- /product-wrapper -->

			<?php woocommerce_product_loop_end(); ?>

	</div>

<?php endif;

wp_reset_postdata();
