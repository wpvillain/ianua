<?php // Search Results ?>

<?php //if (!have_posts()) : ?>
  <!-- <div class="alert alert-warning"> -->
    <?php // _e('Sorry, no results were found.', 'ianua'); ?>
  <!-- </div> -->
  <?php // get_search_form(); ?>
<?php // endif; ?>

<?php get_template_part('templates/content', 'search'); ?>

<?php the_posts_navigation(); ?>
