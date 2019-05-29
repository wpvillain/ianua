<?php
/**
 *
 * Template Name: Grid Width Page With Left Sidebar
 *
 * The template for displaying grid width pages.
 *
 * @since Ianua 1.0.0
 *
 * @package Ianua
 */
?>
<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/content', 'page'); ?>
<?php endwhile; ?>
