<?php
/**
 *
 * The template for displaying the front page.
 *
 * 
 *
 * @since Ianua 1.0.0
 *
 * @package Ianua
 */
?>

<?php if (is_page()) : ?>
<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/content', 'frontpage'); ?>
<?php endwhile; ?>
<?php endif ;?>
<?php if (is_front_page() && !is_page()) : ?>
  <?php get_template_part('templates/content', 'frontpageblog'); ?>
<?php endif ;?>