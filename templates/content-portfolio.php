<?php the_content(); ?>
<?php
          $args = array(
            'post_type' => 'ianua_portfolio_cpt', // enter custom post type
            'orderby' => 'date',
            'order' => 'DESC',
          );
              
          $loop = new WP_Query($args);
          if ($loop->have_posts()) :
              while ($loop->have_posts()) :
                  $loop->the_post();
                  global $post;
                    echo '<div class="portfolio">';
                    echo '<h3>' . get_the_title() . '</h3>';
                    echo '<div class="portfolio-image">'. get_the_post_thumbnail($id).'</div>';
                    echo '<div class="portfolio-work">'. get_the_content().'</div>';
                    echo '</div>';
              endwhile;
          endif;
        ?>
<?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'ianua'), 'after' => '</p></nav>']);
