<?php

namespace Ianua\Extras;

use Ianua\Setup;

/**
 * Add <body> classes
 */
add_filter('body_class', __NAMESPACE__ . '\\body_class');

function body_class($classes) {
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }
    
    // Add page slug if it doesn't exist
  if (is_page_template('blog.php')) {

      $classes[] = 'archive';

  }

  // Add class if sidebar is active
  if (Setup\display_sidebar()) {
    $classes[] = 'sidebar-primary';
  }

  return $classes;
}

/**
* Social buttons displayed on the header
**/

function header_social(){
    

if(get_theme_mod('ianua_header_social_facebook')){ ?>
<span><a href="<?= get_theme_mod('ianua_header_social_facebook');   ?>" target="_blank"><i class="fab fa-facebook-f"></i></a></span>

<?php } if(get_theme_mod('ianua_header_social_twitter')){ ?>

<span><a href="<?= get_theme_mod('ianua_header_social_twitter'); ?>" target="_blank"><i class="fab fa-twitter"></i></a></span>

<?php   } if(get_theme_mod('ianua_header_social_google')){  ?>

<span><a href="<?= get_theme_mod('ianua_header_social_google'); ?>" target="_blank"><i class="fab fa-google-plus"></i></a></span>

<?php   }   
    
}

/**
* A button displayed on the header
**/
function header_button(){
    
    ?>

    <a href="<?= get_theme_mod('ianua_header_button_link','#') ?>"><?=  get_theme_mod('ianua_header_button_text','')    ?></a>

<?php   
    
}

/**
 * Display the classes for the content wrap div.
 *
 * @since 1.0.0
 *
 * @param string|array $class One or more classes to add to the class list.
 * @param int|WP_Post  $post_id Optional. Post ID or post object.
 */
function content_wrap_class( $class = '', $post_id = null, $args = null ) {
    // Separates classes with a single space, collates classes for post DIV
    echo 'class="' . join( ' ', get_content_wrap_class( $class, $post_id,   $args ) ) . '"';
}

/**
 * Retrieve the classes for the content wrap div as an array.
 *
 * @since 1.0.0
 *
 * @param string|array $class   One or more classes to add to the class list.
 * @param int|WP_Post  $post_id Optional. Post ID or post object.
 * @return array Array of classes.
 * @param array        $args array of arguments for post layout.
 */
function get_content_wrap_class( $class = '', $post_id = null, $args = null ) {
    
    $classes = array();
    if ( $class ) {
        if ( ! is_array( $class ) ) {
            $class = preg_split( '#\s+#', $class );
        }
        $classes = array_map( 'esc_attr', $class );
    }
    
    if( (is_page() && !is_page_template()) || is_page_template( ['grid-page-right-sidebar.php','grid-page-left-sidebar.php','contact-page.php'] )   || is_single() || is_archive() || is_front_page() || is_404() ) {
        
        $classes[]      = 'row';
    }   

    $classes[]      = 'content-wrapper';


    $classes = array_map( 'esc_attr', $classes );

    return array_unique( $classes );
}

/**
 * Display the classes for the content div.
 *
 * @since 1.0.0
 *
 * @param string|array $class One or more classes to add to the class list.
 * @param int|WP_Post  $post_id Optional. Post ID or post object.
 */
function content_class( $class = '', $post_id = null, $args = null ) {
    // Separates classes with a single space, collates classes for post DIV
    echo 'class="' . join( ' ', get_content_class( $class, $post_id,    $args ) ) . '"';
}

/**
 * Retrieve the classes for the content div as an array.
 *
 * @since 1.0.0
 *
 * @param string|array $class   One or more classes to add to the class list.
 * @param int|WP_Post  $post_id Optional. Post ID or post object.
 * @return array Array of classes.
 * @param array        $args array of arguments for post layout.
 */
function get_content_class( $class = '', $post_id = null, $args = null ) {
    
    $classes = array();

    if ( $class ) {
        if ( ! is_array( $class ) ) {
            $class = preg_split( '#\s+#', $class );
        }
        $classes = array_map( 'esc_attr', $class );
    }
    
    if (    is_archive() || is_page_template('blog.php') || is_post_type_archive()  ) {
        
        $classes[]      = 'blog top-collapse';
    }
    
    if ( is_page('contact') ) {
    
        $classes[]      = 'collapse';
    }

    if (function_exists( 'is_product') || function_exists( 'is_product_category') ) {
    
        $classes[]      = 'e-commerce product-page half-padding-top';
    }

    if (is_404() ) {
    
        $classes[]      = 'e404 top-collapse';
    }

    if (is_search() ) {
    
        $classes[]      = 'search-page top-collapse';
    }

    $classes = array_map( 'esc_attr', $classes );

    return array_unique( $classes ); //duplicates removed
}


/**
 * Display the classes for the main tag.
 *
 * @since 1.0.0
 *
 * @param string|array $class One or more classes to add to the class list.
 * @param int|WP_Post  $post_id Optional. Post ID or post object.
 */
function main_class( $class = '', $post_id = null, $args = null ) {
    // Separates classes with a single space, collates classes for post DIV
    echo 'class="' . join( ' ', get_main_class( $class, $post_id,   $args ) ) . '"';
}

/**
 * Retrieve the classes for the main div as an array.
 *
 * @since 1.0.0
 *
 * @param string|array $class   One or more classes to add to the class list.
 * @param int|WP_Post  $post_id Optional. Post ID or post object.
 * @return array Array of classes.
 * @param array        $args array of arguments for post layout.
 */
function get_main_class( $class = '', $post_id = null, $args = null ) {
    
    $classes = array();
    if ( $class ) {
        if ( ! is_array( $class ) ) {
            $class = preg_split( '#\s+#', $class );
        }
        $classes = array_map( 'esc_attr', $class );
    }
    
    if (    Setup\display_sidebar() ) {
        $classes[]      = 'eight columns tab-whole';
    }

    if (    Setup\display_sidebar() && is_category() ) {
        $classes[]      = 'twelve columns tab-whole';
    }
    

    $classes = array_map( 'esc_attr', $classes );

    return array_unique( $classes );
}


/**
 * Display the classes for the sidebar div.
 *
 * @since 1.0.0
 *
 * @param string|array $class One or more classes to add to the class list.
 * @param int|WP_Post  $post_id Optional. Post ID or post object.
 */
function sidebar_class( $class = '', $post_id = null, $args = null ) {
    // Separates classes with a single space, collates classes for post DIV
    echo 'class="' . join( ' ', get_sidebar_class( $class, $post_id,    $args ) ) . '"';
}

/**
 * Retrieve the classes for the sidebar div as an array.
 *
 * @since 1.0.0
 *
 * @param string|array $class   One or more classes to add to the class list.
 * @param int|WP_Post  $post_id Optional. Post ID or post object.
 * @return array Array of classes.
 * @param array        $args array of arguments for post layout.
 */
function get_sidebar_class( $class = '', $post_id = null, $args = null ) {
    
    $post = get_post( $post_id );

    $classes = array();
    if ( $class ) {
        if ( ! is_array( $class ) ) {
            $class = preg_split( '#\s+#', $class );
        }
        $classes = array_map( 'esc_attr', $class );
    }
    
    if (    Setup\display_sidebar() ) {
        
        $classes[]      = 'four columns tab-whole';
    }
    
    
    $classes[]      = 'sidebar-wrapper';

    $classes = array_map( 'esc_attr', $classes );

    return array_unique( $classes );
}

/**
 * Clean up the_excerpt()
 *
 * The theme archive pages use a seperate read more so we make this 
 * return null
 */
function excerpt_more() {
  return '';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');

/**
 * Filter the excerpt length to 30 characters.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function custom_excerpt_length( $length ) {
    return 30;
}
add_filter( 'excerpt_length', __NAMESPACE__ . '\\custom_excerpt_length', 999);


/**
* Sanitize Integer Output From Customizer
*   
* @param int $value    any numeric to be checked and returned as integer.
*/
function sanitize_int( $value ){
    
    
    if ( is_numeric( $value ) ) {
        if ( is_int( $value ) ) {
            $value = absint( $value ); // Force the value into integer type.
        }
    }
    return ( 0 <= $value ) ? $value : '';
}


 /**
 * Register meta box(es).
//  */
// function register_meta_boxes() {
//     add_meta_box( 'ianua-page-meta-box', __( 'Ianua Options', 'ianua' ), __NAMESPACE__ . '\\display_callback','page', 'normal','high' );
    
//         add_meta_box( 'ianua-post-meta-box', __( 'Ianua Options', 'ianua' ), __NAMESPACE__ . '\\display_callback','post', 'side','high' );
    
// }
// add_action( 'add_meta_boxes', __NAMESPACE__ . '\\register_meta_boxes' );
 

/**
* Function to change default post gallery.
*/

function post_gallery($output, $attr) {
    global $post;

    if (isset($attr['orderby'])) {
        $attr['orderby'] = sanitize_sql_orderby($attr['orderby']);
        if (!$attr['orderby'])
            unset($attr['orderby']);
    }

    extract(shortcode_atts(array(
        'order' => 'ASC',
        'orderby' => 'menu_order ID',
        'id' => $post->ID,
        'itemtag' => 'dl',
        'icontag' => 'dt',
        'captiontag' => 'dd',
        'columns' => 3,
        'size' => 'thumbnail',
        'include' => '',
        'exclude' => ''
    ), $attr));

    $id = intval($id);
    if ('RAND' == $order) $orderby = 'none';

    if (!empty($include)) {
        $include = preg_replace('/[^0-9,]+/', '', $include);
        $_attachments = get_posts(array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));

        $attachments = array();
        foreach ($_attachments as $key => $val) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    }

    if (empty($attachments)) return '';

    // Here's your actual output, you may customize it to your need
    $output = "<div class=\"entry-content-media\"><div class=\"post-slider flexslider\">\n";
    $output .= "<ul class=\"slides\">\n";

    // Now you loop through each attachment
    foreach ($attachments as $id => $attachment) {
        // Fetch the thumbnail (or full image, it's up to you)
        $img = wp_get_attachment_image_src($id, 'full');

        $output .= "<li>\n";
        $output .= "<img src=\"{$img[0]}\" width=\"{$img[1]}\" height=\"{$img[2]}\" alt=\"\" />\n";
        $output .= "</li>\n";
    }

    $output .= "</ul>\n";
    $output .= "</div>\n</div>\n";

    return $output;
}

add_filter('post_gallery', __NAMESPACE__ . '\\post_gallery', 10, 2);
/**
 * Meta box display callback.
 *
 * @param WP_Post $post Current post object.
 */
function display_callback( $post ) {

    // Add an nonce field so we can check for it later.
    wp_nonce_field('ianua_meta_box','ianua_meta_box_nonce' );

    // Check if its a page.
    if ( isset( $post->post_type ) && 'page' == $post->post_type ) {
        
        /*
     * Use get_post_meta() to retrieve an existing value
     * from the database and use the value for the form.
     */
        
    $ianuaMeta = get_post_meta($post->ID, 'ianua_meta', 'single' );
        
    $pageGist = (   isset($ianuaMeta['pageGist'])   )? $ianuaMeta['pageGist']: ''; 
        
        echo '<div id="pageMeta"><ul><li><strong>Page Gists</strong> ( Short page description below title )</li><li>'.wp_editor( ''.$pageGist.'', 'pageGist', array ( 'wpautop' => false, 'textarea_rows' => 5 ) ).'</li></ul></div>';
    }

    // Check if its a post.
    if ( isset( $post->post_type ) && 'post' == $post->post_type ) {
        
        /*
     * Use get_post_meta() to retrieve an existing value
     * from the database and use the value for the form.
     */
    $ianuaMeta = get_post_meta($post->ID, 'ianua_featured_post', true );
    $featuredPost = isset( $ianuaMeta ) ? $ianuaMeta : 0;

?>
        <div id="postMeta"><ul><li><h3>Feature It!</h3>
            This will add it to featured slider</li><li><br>
<style scoped>
                .fpswitch {
                    position: relative; width: 50px;
                    -webkit-user-select:none; -moz-user-select:none; -ms-user-select: none;
                }
                .fpswitch .fpswitch-checkbox {
                        display: none;
                }
                .fpswitch-label {
                        display: block; overflow: hidden; cursor: pointer;
                        border: 2px solid #999999; border-radius: 0px;
                }
                .fpswitch-slider {
                        display: block; width: 200%; margin-left: -100%;
                        transition: margin 0.3s ease-in 0s;
                }
                .fpswitch-slider:before, .fpswitch-slider:after {
                        display: block; float: left; width: 50%; height: 20px; padding: 0; line-height: 16px;
                        font-size: 10px; color: white; font-family: Trebuchet, Arial, sans-serif; font-weight: bold;
                        box-sizing: border-box;
                        border: 2px solid transparent;
                        background-clip: padding-box;
                }
                .fpswitch-slider:before {
                        content: "";
                        padding-left: 10px;
                        background-color: #2E8DEF; color: #FFFFFF;
                }
                .fpswitch-slider:after {
                        content: "";
                        padding-right: 10px;
                        background-color: #CCCCCC; color: #333333;
                        text-align: right;
                }
                .fpswitch-switch {
                        display: block; width: 25px; margin: 0px;
                        background: #000000;
                        position: absolute; top: 0; bottom: 0;
                        right: 25px;
                        transition: all 0.3s ease-in 0s; 
                }
                .fpswitch-checkbox:checked + .fpswitch-label .fpswitch-slider {
                        margin-left: 0;
                }
                .fpswitch-checkbox:checked + .fpswitch-label .fpswitch-switch {
                        right: 0px; 
                }
            </style>            
            <div class="fpswitch">
                <input type="checkbox" name="featuredpost" class="fpswitch-checkbox" id="featuredpost" value="1"<?php checked( $featuredPost, 1 ); ?> />        
            <label class="fpswitch-label" for="featuredpost">
                    <span class="fpswitch-slider"></span>
                    <span class="fpswitch-switch"></span>
            </label>
            </div>
            </li></ul>
        </div>

    <?php
    }
}
 
/**
 * Save post metadata when a post is saved.
 *
 * @param int $post_id The post ID.
 * @param post $post The post object.
 * @param bool $update Whether this is an existing post being updated or not.
 */
function save_meta_box( $post_id, $post, $update ) {
    // Save logic goes here. Don't forget to include nonce checks!
        // Check if our nonce is set.
    if ( ! isset( $_POST['ianua_meta_box_nonce'] ) ) {
        return;
    }
        // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return $post_id;
    }

    $ianuaOpts = (  get_post_meta($post->ID, 'ianua_meta', 'single' )   )? get_post_meta($post->ID, 'ianua_meta', 'single' ): [];

    
    // Make sure that it is set.
    if ( isset( $_POST['pageGist'] ) ) {
        
            // Check the user's permissions.
            if ( ! current_user_can( 'edit_page', $post_id ) ) {
                return;
            }
            
        
        // Sanitize user input.
        $ianuaOpts['pageGist'] = wp_kses_post ( $_POST['pageGist']  );
        
        /* OK, its safe for us to save the data now. 
         Update the meta field in the database. */
        update_post_meta( $post_id, 'ianua_meta', $ianuaOpts );
    
    }
    
    if ( isset($_POST['featuredpost']) ) {
    
            // Check the user's permissions.
            if ( ! current_user_can( 'edit_post', $post_id ) ) {
                return;
            }
        
            /* OK, its safe for us to save the data now. 
         Update the meta field in the database. */
            update_post_meta( $post_id, 'ianua_featured_post', 1 );
    } 
    else {      
            /* OK, its safe for us to save the data now. 
         Update the meta field in the database. */
            delete_post_meta( $post_id, 'ianua_featured_post' );
    }
}
add_action( 'save_post', __NAMESPACE__ . '\\save_meta_box', 10, 3 );



/**
 * Prints HTML with category for current post.
 *
 * Create your own entry_taxonomies() function to override in a child theme.
 *
 * @since Ianua 1.0
 */
function entry_taxonomies() {
    $categories_list = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'ianua' ) );
    if ( $categories_list ) {
        printf( '<span class="cat-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
            _x( '', 'Used before category names.', 'ianua' ),
            $categories_list
        );
    }
}

/**
* Prints HTML with tags for current post.
*
* Create your own entry_tags() function to override in a child theme.
*
* @since Ianua 1.0
*/

function entry_tags() {
    
    if( is_single() )   {
        $tags_list = get_the_tag_list( '', _x( ', ', 'Used between list items, there is a space after the comma.', 'twentysixteen' ) );
        if ( $tags_list ) {
            printf( '<span class="tags-links tags">%1$s <span class="screen-reader-text">%1$s </span>%2$s</span>',
                _x( 'Tagged in :', 'Used before tag names.', 'twentysixteen' ),
                $tags_list
            );
        }
    }
}
add_action('ianua_after_entry_content',__NAMESPACE__ . '\\entry_tags');


/**
 * Prints HTML with Social for current post.
 *
 * Create your own social_button() function to override in a child theme.
 *
 * @since Ianua 1.0
 */
function social_sharing_buttons(    $buttons = null )
{

    $post_title  =  urlencode(get_the_title());

    $buttons .= '<div class="share-buttons">';
    $buttons .= '<p>';
    $share_link = get_permalink();
    $share_link_url = urlencode(get_permalink());
    
    $twitter_mention = " - via:" . get_option('sharify_twitter_via');


    // Twitter
    
    if ( 1 == get_theme_mod('ianua_social_twitter') )
        $buttons .='<a href="https://twitter.com/intent/tweet?text='.$post_title.': '.$share_link. $twitter_mention . '" class="share-twitter share-button" title="Twitter" onclick="window.open(this.href, \'mywin\',\'left=50,top=50,width=600,height=350,toolbar=0\'); return false;"><i class="fa fa-twitter"></i></a>';
    
    
    // Facebook
    
    if ( 1 == get_theme_mod('ianua_social_facebook') )
        $buttons .='<a href="//www.facebook.com/sharer/sharer.php?u=' . $share_link_url . '&t=' . $post_title . '" onclick="window.open(this.href, \'mywin\',\'left=50,top=50,width=600,height=350,toolbar=0\'); return false;" class="share-facebook share-button" title="Facebook"><i class="fa fa-facebook"></i></a>';
    
    
    // Skype
    
    if ( 1 == get_theme_mod('ianua_social_skype') )
        $buttons .= '<a href="https://web.skype.com/share?url=' . $share_link. '" onclick="window.open(this.href, \'mywin\',\'left=50,top=50,width=417,height=655,toolbar=0\'); return false;" class="share-skype share-button" title="Skype"><i class="fa fa-skype"></i></a>';
    
    
    // Google
    
    if ( 1 == get_theme_mod('ianua_social_google') )
        $buttons .= '<a href="http://plus.google.com/share?url=' . $share_link . '" onclick="window.open(this.href, \'mywin\',\'left=50,top=50,width=600,height=350,toolbar=0\'); return false;" class="share-google share-button" title="Google"><i class="fa fa-google"></i></a>';
    
    // Linkedin
    
    
     if ( 1 == get_theme_mod('ianua_social_linkedin') )
        $buttons .= '<a href="https://www.linkedin.com/shareArticle?mini=true&url=' . $share_link . '&title='. get_the_title() .'" onclick="if(!document.getElementById(\'td_social_networks_buttons\')){window.open(this.href, \'mywin\',\'left=50,top=50,width=600,height=350,toolbar=0\'); return false;}" class="share-linkedin share-button" title="Linkedin"><i class="fa fa-linkedin"></i></a>'; 

    
    
    if ( 1 == get_theme_mod('ianua_social_email') )
        $buttons .= '<a href="mailto:?subject='.get_the_title().'&body='.get_option('sharify_custom_email_msg'). ' - ' . $share_link.'" class="share-mail share-button" title="Mail"><i class="fa fa-envelope-o"></i></a>';

        $buttons .= '</p>';
    $buttons .= '</div>';
        echo $buttons;
}

add_action('ianua_after_entry_content',__NAMESPACE__ . '\\social_sharing_buttons');


/**
 * Prints HTML for Author Profile for current post.
 *
 * Create your own author_profile() function to override in a child theme.
 *
 * @since Ianua 1.0
 */
function author_profile() {
    
    if ( is_single() ) {
        
        $author_avatar_size = apply_filters('ianua_author_avatar_size', 49 );

?>
<div class="author-profile">
    <?=get_avatar( get_the_author_meta( 'user_email' ), $author_avatar_size )?>
    <div class="about">
        <h5><a href="<?=esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) )?>"><?=get_the_author()?></a></h5>
        <p>
            <?=the_author_meta('description')?>
        </p>
        <ul class="author-social">
            <?php   
        
        $facebook = get_the_author_meta( 'facebook' );
    
    if ( $facebook && $facebook != '' ) {
        
        echo '<li class="facebook"><a href="' . esc_url($facebook) . '" target="_blank"><i class="fa fa-facebook"></i></a></li>';
    
    }
    
    $twitter = get_the_author_meta( 'twitter' );
    
    if ( $twitter && $twitter != '' ) {
        
        echo '<li class="twitter"><a href="' . esc_url($twitter) . '" target="_blank"><i class="fa fa-twitter"></i></a></li>';
        
    }   
    
    $google_plus = get_the_author_meta( 'google_plus' );
    
    if ( $google_plus && $google_plus != '' ) {
        echo '<li class="google"><a href="' . esc_url($google_plus) . '" rel="author" target="_blank"><i class="fa fa-google-plus"></i></a></li>';
    }
    
    
    $skype = get_the_author_meta( 'skype' );
    
    if ( $skype && $skype != '' ) {
        
        echo '<li class="linkedin"><a href="skype:' . esc_attr($skype) . '?call"><i class="fa fa-skype"></i></a></li>';
    }
            ?>
            
        </ul>
    </div>
</div>
<?php
    }
}
add_action('ianua_after_entry_content',__NAMESPACE__ . '\\author_profile');


/**
 * Prints HTML for Author Profile for current post.
 *
 * Create your own author_profile() function to override in a child theme.
 *
 * @since Ianua 1.0
 */

function author_social( $contactmethods ) {
    
    $contactmethods['facebook'] = 'Facebook Profile URL';
    $contactmethods['twitter'] = 'Twitter Profile URL';         $contactmethods['google_plus'] = 'Google Profile URL';
    $contactmethods['skype'] = 'Skype Profile ID';
    
    return $contactmethods;
            
}
add_filter( 'user_contactmethods', __NAMESPACE__ . '\\author_social', 10, 1);


/**
 * Echos HTML for Related posts for current post.
 *
 * Create your own related_posts() function to override in a child theme.
 *
 * @since Ianua 1.0
 */

function related_posts() {
    
    if( is_single() )   {
            
            $args = wp_parse_args( (array) $args =      null , array(
        'orderby' => 'rand',
        'return'  => 'query', // Valid values are: 'query' (WP_Query object), 'array' (the arguments array)
    ) );
    
        $post_id                =   get_the_ID();
        $related_count  =   3;
 
    $related_args = array(
        'post_type'      => get_post_type( $post_id ),
        'posts_per_page' => $related_count,
        'post_status'    => 'publish',
        'post__not_in'   => array( $post_id ),
        'orderby'        => $args['orderby'],
          'tax_query' => array(
                        'relation' => 'OR',
                        array(
                            'taxonomy' => 'post_tag',
                            'field' => 'slug',

                        ),
                        array(
                            'taxonomy' => 'category',
                            'field' => 'slug',

                        ),
                    ),
        );
 
    $post       = get_post( $post_id );
    $taxonomies = get_object_taxonomies( $post, 'names' );
 
    foreach( $taxonomies as $taxonomy ) {
        $terms = get_the_terms( $post_id, $taxonomy );
        if ( empty( $terms ) ) continue;
        $term_list = wp_list_pluck( $terms, 'slug' );
        $related_args['tax_query'][] = array(
            'taxonomy' => $taxonomy,
            'field'    => 'slug',
            'terms'    => $term_list
        );
    }
 
    if( count( $related_args['tax_query'] ) > 1 ) {
        $related_args['tax_query']['relation'] = 'OR';
    }
 
    if( $args['return'] == 'query' ) {
        $related = new \WP_Query( $related_args );
    } else {
        $related = $related_args;
    }
    
    if( $related->have_posts() ):
?>
<div class="related-articles ras group">
    <h3>Related Articles</h3>
    <div class="ras-wrap bgrid-third mob-bgrid-half stack group">
        <?php while( $related->have_posts() ): $related->the_post(); ?>
        <?php if(has_post_thumbnail()){ ?>
        <div class="relatedthumb ra bgrid">
            <a rel="external" href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(200,180)); ?><br />
                <p><?php the_title(); ?></p>
            </a>
        </div>
        <?php   }   ?>
        <?php endwhile; ?>
</div>
<?php
    endif;
    wp_reset_postdata();
        }
}
add_action('ianua_after_entry_content',__NAMESPACE__ . '\\related_posts');


/**
 * Prints HTML for Post Navigation for current post.
 *
 * Create your own post_nav() function to override in a child theme.
 *
 * @since Ianua 1.0
 */

function post_nav() {
    
        if( is_single() )   {
    // Don't print empty markup if there's nowhere to navigate.
    
    $previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
    $next     = get_adjacent_post( false, '', false );

    if ( ! $next && ! $previous ) {
        return;
    }
?>
<div class="pagenav group">
    <?php
    if ( is_attachment() ) :
    previous_post_link( '%link', __( '<span class="prev">Published In</span>%title', 'ianua' ) );
    else :
    previous_post_link( '<span class="prev">%link</span>', __( 'Previous', 'ianua' ) );
    next_post_link( '<span class="next">%link</span>', __( 'Next', 'ianua' ) );
    endif;
    ?>
</div>
<?php
        }
}
add_action('ianua_after_entry_content',__NAMESPACE__ . '\\post_nav');


/**
 * Prints HTML for Comments section.
 *
 * @since Ianua 1.0
 */

function ianua_comment_section($comment, $args, $depth) {
    
        $tag       = 'li';
        $add_below = 'comment';

    ?>
    <<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
    <?php if ( 'div' != $args['style'] ) : ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
    <?php endif; ?>
    <div class="comment-author avatar vcard">
        <?php if( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
    </div>
        <div class="comment-content">
            
            <div class="comment-info">
                
                <?php printf( __( '<cite class="fn">%s</cite>' ), get_comment_author_link() ); ?>   
                
                <?php if ( $comment->comment_approved == '0' ) : ?>
         <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></em>
          <br />
                <?php endif; ?>
                
                <div class="comment-meta commentmetadata">
                    
                        <?php
    /* translators: 1: date, 2: time */
    printf( __('<time datetime="%3$s" class="comment-time">%1$s @ %2$s</time>'), get_comment_date('M j, Y'),  get_comment_time(), get_comment_date('c') ); ?>
                    <span class="sep">/</span>
                        <?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                    
                    <?php edit_comment_link( __( '(Edit)' ), '<span class="sep">/</span>  ', '' );
        ?>
                </div>
            </div>
            
    <?php comment_text(); ?>

    <?php if ( 'div' != $args['style'] ) : ?>
    </div>
            </div>
        <?php endif; ?>
    <?php
}


/**
 * Prints HTML for Comment fields.
 *
 * @since Ianua 1.0
 */

function ianua_comment_fields($fields) {
    
    $commenter = wp_get_current_commenter();
    $req = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $fields =  array(

  'author' =>
    '<input id="author" name="author" placeholder="Name" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
    '" size="30"' . $aria_req . ' /></p>',

  'email' =>
    '<input id="email" name="email" placeholder="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
    '" size="30"' . $aria_req . ' /></p>',

  'url' =>
    '<input id="url" name="url" placeholder="website" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
    '" size="30" /></p>',
        
    'comment'   => '<textarea id="comment" name="comment" placeholder="comment" cols="45" rows="8" maxlength="65525" ' . $aria_req . '"></textarea>',
);
    
    return $fields;
}

add_filter('comment_form_fields', __NAMESPACE__ . '\\ianua_comment_fields');


function comment_reply_class($comment){
    
    $comment = str_replace("class='comment-reply-link", "class='reply", $comment);
    return $comment;
}
add_filter('comment_reply_link', __NAMESPACE__ . '\\comment_reply_class', 99);


/**
* Sidebar
**/

/**
* Widgets
**/


/**
*   Archive
**/


function page_nav(){
    
    if( is_archive() && ! is_singular() || is_page_template('blog.php') )   {

            ?>
            <div class="row">
                <div class="twelve columns pagenav group">
                    <?php                   // Previous/next page navigation.
                    
                           the_posts_pagination( array(
            'prev_text' => 'Prev',
            'next_text' => 'Next',
        ) );
                    
                
                    ?>

                </div>
            </div>
            <?php
    }
}
add_action('ianua_after_main_content',__NAMESPACE__ . '\\page_nav');

/** 
  *
  * WooCommerce Tweaks
  *
**/

/* Remove WooCommerce Title and single product description */


/** Add WooCommerce Support **/

add_theme_support('woocommerce');


add_filter('woocommerce_show_page_title', '__return_false');
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);

function ianua_product_archive_post_classes($classes){
 
    if ( is_post_type_archive('product') ) {
        $classes[] = 'bgrid';
        $classes[] = 'product-item';
        $classes[] = 'iw-wordpress';
        $classes[] = 'ianua-product-archive';
        return $classes;
    } else  {
        $classes[]= "";
        return $classes;
    } 
}

add_filter('post_class', __NAMESPACE__ . '\ianua_product_archive_post_classes' );


add_filter( 'ianua_product_archive_columns',  __NAMESPACE__ . '\ianua_columns_change',999);
 
/*
* Return a new number of maximum columns for shop archives
* @param int Original value
* @return int New number of columns
*/
function ianua_columns_change () {
return 2;
}


remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
add_action( 'woocommerce_single_product_summary', __NAMESPACE__ . '\woocommerce_template_ianua_single_price', 10 );

if ( ! function_exists( 'woocommerce_template_ianua_single_price' ) ) {
   function woocommerce_template_ianua_single_price() {
            global $product;
            echo '<div class="six columns tab-whole product-content right"><span class="price">' . $product->get_price_html() . '</span>';
    }
}

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
add_action( 'woocommerce_single_product_summary', __NAMESPACE__ . '\woocommerce_template_ianua_single_excerpt', 20 );

if ( ! function_exists( 'woocommerce_template_ianua_single_excerpt' ) ) {
   function woocommerce_template_ianua_single_excerpt() {

            wc_get_template( 'single-product/short-description.php' );
    }
}

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
add_action( 'woocommerce_single_product_summary', __NAMESPACE__ . '\woocommerce_template_ianua_single_add_to_cart', 30 );

if ( ! function_exists( 'woocommerce_template_ianua_single_add_to_cart' ) ) {
   function woocommerce_template_ianua_single_add_to_cart() {
            global $product;
            do_action( 'woocommerce_' . $product->get_type() . '_add_to_cart' );
    }
}

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
add_action( 'woocommerce_single_product_summary', __NAMESPACE__ . '\woocommerce_template_ianua_single_rating', 40 );

if ( ! function_exists( 'woocommerce_template_ianua_single_rating' ) ) {
   function woocommerce_template_ianua_single_rating() {
            wc_get_template( 'single-product/rating.php' );
            echo "</div>";
    }
}

/* An example of how to set the three products per page */
add_filter( 'woocommerce_output_related_products_args', function( $args ) 
{ 
    $args = wp_parse_args( array( 'posts_per_page' => 3 ), $args );
    return $args;
});

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);

add_action('woocommerce_before_main_content', __NAMESPACE__ . '\ianua_theme_wrapper_start', 10);

function ianua_theme_wrapper_start() {
  echo '<div id="container"><div id="content-block" role="main">';
}


/* Gravity Forms Tweaks */

add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );

// 1. customize ACF path
add_filter('acf/settings/path', __NAMESPACE__. '\my_acf_settings_path');
 
function my_acf_settings_path( $path ) {
 
    // update path
    $path = get_stylesheet_directory() . '/acf/';
    
    // return
    return $path;
    
}
 

// 2. customize ACF dir
add_filter('acf/settings/dir', __NAMESPACE__ . '\my_acf_settings_dir');
 
function my_acf_settings_dir( $dir ) {
 
    // update path
    $dir = get_stylesheet_directory_uri() . '/acf/';
    
    // return
    return $dir;
    
}

// 3. Hide ACF field group menu item
//add_filter('acf/settings/show_admin', '__return_false');

// 4. Include ACF
include_once( get_stylesheet_directory() . '/acf/acf.php' );

add_filter( 'author_link', __NAMESPACE__ . '\\wpse5742_author_link', 10, 3 );
function wpse5742_author_link( $link, $author_id, $author_nicename )
{
    $author_nickname = get_user_meta( $author_id, 'nickname', true );
    if ( $author_nickname ) {
        $link = str_replace( $author_nicename, $author_nickname, $link );
    }
    return $link;
}

add_filter( 'request', __NAMESPACE__ . '\\wpse5742_request' );
function wpse5742_request( $query_vars )
{
    if ( array_key_exists( 'author_name', $query_vars ) ) {
        global $wpdb;
        $author_id = $wpdb->get_var( $wpdb->prepare( "SELECT user_id FROM {$wpdb->usermeta} WHERE meta_key='nickname' AND meta_value = %s", $query_vars['author_name'] ) );
        if ( $author_id ) {
            $query_vars['author'] = $author_id;
            unset( $query_vars['author_name'] );    
        }
    }
    return $query_vars;
}

// Block Password Recovery
function disable_reset_lost_password() 
 {
   return false;
 }
add_filter( 'allow_password_reset', 'disable_reset_lost_password');

// redirect WP stuff to WP Villain and Woo  stuff to Wooaid

add_action('template_redirect', __NAMESPACE__ . '\\post_redirect_by_custom_filters');
function post_redirect_by_custom_filters() {
    global $post;
    // this array can contain category names, slugs or even IDs.
    $catArray = ['Sage Starter Theme', 'Sage', 'WordPress', 'Trellis', 'Bedrock', 'Plugins', 'Themes'];
    if (is_single($post->ID) && has_category($catArray, $post)) {
        $new_url = "https://wpvilla.in/{$post->post_name}/";  
        wp_redirect($new_url, 301);
        exit;
    }
}

add_action('template_redirect', __NAMESPACE__ . '\\woo_post_redirect_by_custom_filters');
function woo_post_redirect_by_custom_filters() {
    global $post;
    // this array can contain category names, slugs or even IDs.
    $catArray = ['WooCommerce'];
    if (is_single($post->ID) && has_category($catArray, $post)) {
        $new_url = "https://wooaid.com/{$post->post_name}/";  
        wp_redirect($new_url, 301);
        exit;
    }
}
