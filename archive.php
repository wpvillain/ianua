<?php
/**
 *
 * The template for displaying Archive pages.
 *
 * @since Ianua 1.0.0
 *
 * @package Ianua
 */
?>

<div class="row iw-post-list">
	<div class="twelve columns">
		<?php while (have_posts()) : the_post(); ?>
		<?php get_template_part('templates/content', 'archive'); ?>
		<?php endwhile; ?>
	</div>
</div>

