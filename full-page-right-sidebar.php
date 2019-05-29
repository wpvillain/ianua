<?php
/**
 *
 * Template Name: Full Width Page Right Sidebar
 *
 * The template for displaying full width pages without sidebars.
 *
 * @since Ianua 1.0.0
 *
 * @package Ianua
 */
?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/content', 'page'); ?>
<?php endwhile; ?>
