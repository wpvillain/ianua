<?php
/**
 *
 * Template Name: Portfolio
 *
 * The template for displaying the portolio.
 *
 * @since Ianua 1.0.0
 *
 * @package Ianua
 */
?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/content', 'portfolio'); ?>
<?php endwhile; ?>
