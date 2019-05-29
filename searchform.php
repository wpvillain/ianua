<?php
/**
 *
 * Template for displaying search forms in Ianua
 *
 * @since Ianua 1.0.0
 *
 * @package Ianua
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="text" class="text-search search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'ianua' ); ?>" value="<?php echo get_search_query(); ?>" name="s" kl_virtual_keyboard_secure_input="on" />	
	<input type="submit" value="Search" class="submit-search">
</form>
