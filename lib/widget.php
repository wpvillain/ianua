<?php

/**
 * Widget API: WP_Widget_Categories class
 *
 * @package WordPress
 * @subpackage Widgets
 * @since 4.4.0
 */


// Register our widgets
function ianua_widgets_init()
{
    register_widget('Ianua_Widget_Categories');
    register_widget('Ianua_Widget_Blog_Posts');
    register_widget('AccompanyPostWidget');
}
add_action('widgets_init', 'ianua_widgets_init');

/**
 * Core class used to implement a Categories widget.
 *
 * @since 2.8.0
 *
 * @see WP_Widget
 */
class Ianua_Widget_Categories extends WP_Widget
{

    /**
     * Sets up a new Categories widget instance.
     *
     * @since 2.8.0
     * @access public
     */
    public function __construct()
    {
        $widget_ops = array(
            'classname' => 'Widget_Categories Ianua_Widget_Categories',
            'description' => __('A list or dropdown of categories.'),
            'customize_selective_refresh' => true,
        );
        parent::__construct('ianua_categories', __('Ianua Categories'), $widget_ops);
    }

    /**
     * Outputs the content for the current Categories widget instance.
     *
     * @since 2.8.0
     * @access public
     *
     * @param array $args     Display arguments including 'before_title', 'after_title',
     *                        'before_widget', and 'after_widget'.
     * @param array $instance Settings for the current Categories widget instance.
     */
    public function widget($args, $instance)
    {
        static $first_dropdown = true;

        /** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
        $title = apply_filters('widget_title', empty($instance['title']) ? __('Categories') : $instance['title'], $instance, $this->id_base);

        $c = ! empty($instance['count']) ? '1' : '0';
        $h = ! empty($instance['hierarchical']) ? '1' : '0';
        $d = ! empty($instance['dropdown']) ? '1' : '0';

        echo $args['before_widget'];
        if ($title) {
            echo $args['before_title'] . $title . $args['after_title'];
        }

        $cat_args = array(
            'orderby'      => 'name',
            'show_count'   => $c,
            'hierarchical' => $h
        );

        if ($d) {
            $dropdown_id = ( $first_dropdown ) ? 'cat' : "{$this->id_base}-dropdown-{$this->number}";
            $first_dropdown = false;

            echo '<label class="screen-reader-text" for="' . esc_attr($dropdown_id) . '">' . $title . '</label>';

            $cat_args['show_option_none'] = __('Select Category');
            $cat_args['id'] = $dropdown_id;

            /**
             * Filters the arguments for the Categories widget drop-down.
             *
             * @since 2.8.0
             *
             * @see wp_dropdown_categories()
             *
             * @param array $cat_args An array of Categories widget drop-down arguments.
             */
            wp_dropdown_categories(apply_filters('widget_categories_dropdown_args', $cat_args));
            ?>

<script type='text/javascript'>
/* <![CDATA[ */
(function() {
    var dropdown = document.getElementById( "<?php echo esc_js($dropdown_id); ?>" );
    function onCatChange() {
        if ( dropdown.options[ dropdown.selectedIndex ].value > 0 ) {
            location.href = "<?php echo home_url(); ?>/?cat=" + dropdown.options[ dropdown.selectedIndex ].value;
        }
    }
    dropdown.onchange = onCatChange;
})();
/* ]]> */
</script>

<?php
        } else {
?>
        <ul class="cat-list group">
<?php
        $cat_args['title_li'] = '';

        /**
         * Filters the arguments for the Categories widget.
         *
         * @since 2.8.0
         *
         * @param array $cat_args An array of Categories widget options.
         */
        wp_list_categories(apply_filters('widget_categories_args', $cat_args));
?>
        </ul>
<?php
        }

        echo $args['after_widget'];
    }

    /**
     * Handles updating settings for the current Categories widget instance.
     *
     * @since 2.8.0
     * @access public
     *
     * @param array $new_instance New settings for this instance as input by the user via
     *                            WP_Widget::form().
     * @param array $old_instance Old settings for this instance.
     * @return array Updated settings to save.
     */
    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = sanitize_text_field($new_instance['title']);
        $instance['count'] = !empty($new_instance['count']) ? 1 : 0;
        $instance['hierarchical'] = !empty($new_instance['hierarchical']) ? 1 : 0;
        $instance['dropdown'] = !empty($new_instance['dropdown']) ? 1 : 0;

        return $instance;
    }

    /**
     * Outputs the settings form for the Categories widget.
     *
     * @since 2.8.0
     * @access public
     *
     * @param array $instance Current settings.
     */
    public function form($instance)
    {
        //Defaults
        $instance = wp_parse_args((array) $instance, array( 'title' => ''));
        $title = sanitize_text_field($instance['title']);
        $count = isset($instance['count']) ? (bool) $instance['count'] :false;
        $hierarchical = isset($instance['hierarchical']) ? (bool) $instance['hierarchical'] : false;
        $dropdown = isset($instance['dropdown']) ? (bool) $instance['dropdown'] : false;
        ?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

        <p><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('dropdown'); ?>" name="<?php echo $this->get_field_name('dropdown'); ?>"<?php checked($dropdown); ?> />
        <label for="<?php echo $this->get_field_id('dropdown'); ?>"><?php _e('Display as dropdown'); ?></label><br />

        <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>"<?php checked($count); ?> />
        <label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Show post counts'); ?></label><br />

        <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('hierarchical'); ?>" name="<?php echo $this->get_field_name('hierarchical'); ?>"<?php checked($hierarchical); ?> />
        <label for="<?php echo $this->get_field_id('hierarchical'); ?>"><?php _e('Show hierarchy'); ?></label></p>
        <?php
    }
}

class Ianua_Widget_Blog_Posts extends WP_Widget
{

         /**
           * Sets up a new Ianua Recent Posts widget instance.
           *
           * @since 2.8.0
           * @access public
           */
          public function __construct() {
                  $widget_ops = array(
                          'classname' => 'ianua_widget_blog_posts',
                          'description' => __( 'Your site&#8217;s most recent Posts.' ),
                          'customize_selective_refresh' => true,
                  );
                  parent::__construct( 'recent-blog-posts', __( 'Ianua Recent Blog Posts' ), $widget_ops );
                  $this->alt_option_name = 'ianua_widget_blog_posts';
          }
  
         /**
           * Outputs the content for the current Ianua Posts widget instance.
           *
           * @since 2.8.0
           * @access public
           *
           * @param array $args     Display arguments including 'before_title', 'after_title',
           *                        'before_widget', and 'after_widget'.
           * @param array $instance Settings for the Ianua Recent Posts widget instance.
           */
          public function widget( $args, $instance ) {
                  if ( ! isset( $args['widget_id'] ) ) {
                          $args['widget_id'] = $this->id;
                  }
  
                  $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Recent Posts' );
  
                  /** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
                  $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
  
                  $number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
                  if ( ! $number )
                          $number = 5;
                  $show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;
  
                  /**
                   * Filters the arguments for the Recent Posts widget.
                   *
                   * @since 3.4.0
                   *
                   * @see WP_Query::get_posts()
                   *
                   * @param array $args An array of arguments used to retrieve the recent posts.
                   */
                  $r = new WP_Query( apply_filters( 'widget_posts_args', array(
                          'posts_per_page'      => $number,
                          'no_found_rows'       => true,
                          'post_status'         => 'publish',
                          'ignore_sticky_posts' => true
                  ) ) );
  
                  if ($r->have_posts()) :
                  ?>
                  <?php echo $args['before_widget']; ?>
                  <?php //if ( $title ) {
                          //echo $args['before_title'] . $title . $args['after_title'];
                  //} ?>
                    <div class="row iw-post-list">
                          <ul>
                              <!-- the loop -->
                            <?php while ($r->have_posts()) :
                                $r->the_post(); ?>
                                <?php get_template_part('templates/content', 'archive'); ?>
                            <?php endwhile; ?>
                            <!-- end of the loop -->
                          <!-- </ul> -->
                          <?php echo $args['after_widget']; ?>
                          <?php
                          // Reset the global $the_post as this query will have stomped on it
                          wp_reset_postdata(); ?>
                    </div>
                      <?php endif;
          }
  
         /**
          * Handles updating the settings for the current Recent Posts widget instance.
          *
          * @since 2.8.0
          * @access public
          *
          * @param array $new_instance New settings for this instance as input by the user via
          *                            WP_Widget::form().
          * @param array $old_instance Old settings for this instance.
          * @return array Updated settings to save.
          */
         public function update( $new_instance, $old_instance ) {
                 $instance = $old_instance;
                 $instance['title'] = sanitize_text_field( $new_instance['title'] );
                 $instance['number'] = (int) $new_instance['number'];
                 $instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
                 return $instance;
         }

         /**
          * Outputs the settings form for the Recent Posts widget.
          *
          * @since 2.8.0
          * @access public
          *
          * @param array $instance Current settings.
          */
         public function form( $instance ) {
                 $title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
                 $number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
                 $show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
 ?>
                 <p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>
 
                 <p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:' ); ?></label>
                 <input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" /></p>
 
                 <p><input class="checkbox" type="checkbox"<?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
                 <label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Display post date?' ); ?></label></p>
 <?php
         }

}

class AccompanyPostWidget extends WP_Widget
{
  function __construct()
  {
    $widget_ops = array(
      'classname' => 'accompany-post-widget', 
      'description' => 'Displays a Accompany post with thumbnail' 
      );
    // $this->WP_Widget('AccompanyPostWidget', 'Accompany Text Widget', $widget_ops);
    // $plugin_dir = basename(dirname(__FILE__));
    // load_plugin_textdomain( 'accompany-text', false, $plugin_dir );
    parent::__construct( 'accompany-text', __( 'Accompany Text Widget' ), $widget_ops );
    $this->alt_option_name = 'accompany-post-widget';
  }

  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'number' => '','text' => '', 'imagesPath' => '','cssClass' => '') );
    //$number = $instance['number'];
    $text = $instance['text'];
    $widgetNo="widgetname".mt_rand(); //.substr(md5('widgetname'), 0, 4);
    $imagesPath= $instance['imagesPath'];
    $cssClass= $instance['cssClass'];
  ?>
  <!-- <p><label for="<?php echo $this->get_field_id('number'); ?>">Number : <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo esc_attr($number); ?>" /></label></p> -->
  <p><label for="<?php echo $this->get_field_id('text'); ?>">Text :
  <textarea class="widefat" rows="6" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text;?></textarea>
  </label></p>
  <p><label for="<?php echo $this->get_field_id('imagesPath'); ?>">images path : <input class="widefat" id="<?php echo $this->get_field_id('imagesPath'); ?>" name="<?php echo $this->get_field_name('imagesPath'); ?>" type="text" value="<?php echo esc_attr($imagesPath); ?>" /></label></p>

  <p><label for="<?php echo $this->get_field_id('cssClass'); ?>">Css Class : <input class="widefat" id="<?php echo $this->get_field_id('cssClass'); ?>" name="<?php echo $this->get_field_name('cssClass'); ?>" type="text" value="<?php echo esc_attr($cssClass); ?>" /></label></p>

  <?php
  }

  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    //$instance['number'] = $new_instance['number'];
    $instance['text'] = $new_instance['text'];
    $instance['imagesPath'] = $new_instance['imagesPath'];
    $instance['cssClass'] = $new_instance['cssClass'];
    icl_register_string('Accompany Text', 'widget body – ' . $this->id, $instance['text']);
    return $instance;
  }

  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
    echo $before_widget;
    //$number = empty($instance['number']) ? ' ' : apply_filters('widget_number', $instance['number']);
    $text = empty($instance['text']) ? ' ' : apply_filters('widget_text', $instance['text']);
    $imagesPath = empty($instance['imagesPath']) ? ' ' : apply_filters('widget_imagesPath', $instance['imagesPath']);
    $cssClass = empty($instance['cssClass']) ? ' ' : apply_filters('widget_cssClass', $instance['cssClass']);
    // WIDGET CODE GOES HERE
    echo '<div class="box '.$cssClass.'">
    <div class="round">
    <div class="con">';
    if (!empty($imagesPath)){ echo '<div class="iconBox"><img src="'.$imagesPath.'" class="icon" style="widht160px:;height:27px;margin-bottom: 2.8rem;" alt="icon"/> </div>';}
    //if (!empty($number)){ echo ' <span class="num">'.$number.'</span>';}
    //echo icl_t('Accompany Text', 'widget body – ' . $this->id, $text);
    echo wpautop( $text );
    echo ' </div>
    </div>
    </div>';
    echo $after_widget;
  }
}