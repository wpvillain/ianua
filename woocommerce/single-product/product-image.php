<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
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
 * @version     2.6.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $product, $woocommerce;

$attachment_ids = $product->get_gallery_image_ids(); 

if ( $attachment_ids ) {
		$loop 		= 0;?>

			<div class="product-slider flexslider magnific-wrap">
				<ul class="slides">
						<?php foreach ( $attachment_ids as $attachment_id ) { 
							//$image_class = implode( ' ', $classes );
							$props       = wc_get_product_attachment_props( $attachment_id, $post );?>
							<li>
								<a href="<?= $props['url'];?>" class="magnific" title="Denim Shirt">
								<?= wp_get_attachment_image( $attachment_id, apply_filters( 'shop_catalog', 'shop_catalog' ), 0, $props ); ?>
							</a>
							</li>

						<?php 
					} ?>
				</ul>
			</div>
				<?php }
