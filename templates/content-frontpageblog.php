	<div class="row iw-post-list">
	<div class="twelve columns">

<?php
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $big = 999999999; // need an unlikely integer
// the query
    $wpb_all_query = new WP_Query(array('post_type'=>'post', 'post_status'=>'publish','paged' => $paged)); ?>

<?php if ($wpb_all_query->have_posts()) : ?>

<ul>

    <!-- the loop -->
    <?php while ($wpb_all_query->have_posts()) :
        $wpb_all_query->the_post(); ?>
        <?php get_template_part('templates/content', 'archive'); ?>
    <?php endwhile; ?>
    <!-- end of the loop -->
<?php if ($wpb_all_query->max_num_pages > 1) { // check if the max number of pages is greater than 1  ?>
    <div class="row">
            <div class="twelve columns pagenav group">
                <nav class="navigation pagination" role="navigation">
                    <h2 class="screen-reader-text">Posts navigation</h2>
                    <div class="nav-links">
                        <?= paginate_links(array(
                            'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                            'format' => '?paged=%#%',
                            'current' => max(1, get_query_var('paged')),
                            'total' => $wpb_all_query->max_num_pages
                        ));
                        ?>
                    </div>
                </nav>
            </div>
    </div>
<?php } ?>


    <?php wp_reset_postdata(); ?>

<?php else : ?>
    <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif; ?>

    </div>
</div>
