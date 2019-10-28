<?php

namespace Ianua\Setup;

use Ianua\Assets;

/**
 * Theme setup
 */
function setup()
{

  // Make theme available for translation
  // Community translations can be found at https://github.com/roots/sage-translations
    load_theme_textdomain('ianua', get_template_directory() . '/lang');

  // Enable plugins to manage the document title
  // http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
    add_theme_support('title-tag');

  // Register wp_nav_menu() menus
  // http://codex.wordpress.org/Function_Reference/register_nav_menus
    register_nav_menus([
    'primary_navigation' => __('Primary Navigation', 'ianua'),   'footer_navigation' => __('Footer Navigation', 'ianua')
    ]);

  // Enable post thumbnails
  // http://codex.wordpress.org/Post_Thumbnails
  // http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
  // http://codex.wordpress.org/Function_Reference/add_image_size
    add_theme_support('post-thumbnails');
    add_image_size('related', 200, 180);
    add_image_size('featured', 1300, 610);
    add_image_size('projects', 287, 295);
    set_post_thumbnail_size(200, 180);
  // Enable post formats
  // http://codex.wordpress.org/Post_Formats
    add_theme_support('post-formats', ['aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio']);

  // Enable HTML5 markup support
  // http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
    add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

  // Use main stylesheet for visual editor
  // To add custom styles edit /assets/styles/layouts/_tinymce.scss
    //add_editor_style(Assets\asset_path('styles/main.css'));
}
add_action('after_setup_theme', __NAMESPACE__ . '\\setup');

/**
 * Register sidebars
 */
function widgets_init()
{
    
    // Main Sidebar
    register_sidebar([
    'name'          => __('Primary', 'ianua'),
    'id'            => 'sidebar-primary',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h5>',
    'after_title'   => '</h5>'
    ]);

    // Contact Page Sidebar
    register_sidebar([
    'name'          => __('Contact Page', 'ianua'),
    'id'            => 'contact-page-sidebar',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h5>',
    'after_title'   => '</h5>'
    ]);

    // Front Page Slider Sidebar
    register_sidebar([
    'name'          => __('Front Slider', 'ianua'),
    'id'            => 'front-slider-sidebar',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h4>',
    'after_title'   => '</h4>'
    ]);

    // From the Blog Twelve Columns
    register_sidebar([
    'name'          => __('From the Blog', 'ianua'),
    'id'            => 'sidebar-from-the-blog',
    'before_title'  => '<h4>',
    'after_title'   => '</h4>'
    ]);

    // Testimonials Slider Twelve Columns
    register_sidebar([
    'name'          => __('Testimonials Slider', 'ianua'),
    'id'            => 'sidebar-testimonials',
    'before_widget' => '<section class="widget %1$s %2$s twelve columns tab-fourth mob-whole">',
    'after_widget'  => '</section>',
    'before_title'  => '<h4>',
    'after_title'   => '</h4>'
    ]);


    // Newsletter Twelve Columns
    register_sidebar([
    'name'          => __('Newsletter', 'ianua'),
    'id'            => 'sidebar-newsletter',
    'before_widget' => '<section class="widget %1$s %2$s twelve columns tab-fourth mob-whole">',
    'after_widget'  => '</section>',
    'before_title'  => '<h4>',
    'after_title'   => '</h4>'
    ]);
    
    // Footer 1 five columns
    register_sidebar([
    'name'          => __('Footer 1', 'ianua'),
    'id'            => 'sidebar-footer-1',
    'before_widget' => '<section class="widget five columns tab-half mob-whole %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h4>',
    'after_title'   => '</h4>'
    ]);
    
    // Footer 2 three columns
    register_sidebar([
    'name'          => __('Footer 2', 'ianua'),
    'id'            => 'sidebar-footer-2',
    'before_widget' => '<section class="widget %1$s %2$s three columns latest-post">',
    'after_widget'  => '</section>',
    'before_title'  => '<h4>',
    'after_title'   => '</h4>'
    ]);
    
    // Footer 3 two columns
    register_sidebar([
    'name'          => __('Footer 3', 'ianua'),
    'id'            => 'sidebar-footer-3',
    'before_widget' => '<section class="widget %1$s %2$s two columns tab-fourth mob-whole">',
    'after_widget'  => '</section>',
    'before_title'  => '<h4>',
    'after_title'   => '</h4>'
    ]);
    
    // Footer 4 two columns
    register_sidebar([
    'name'          => __('Footer 4', 'ianua'),
    'id'            => 'sidebar-footer-4',
    'before_widget' => '<section class="widget %1$s %2$s two columns tab-fourth mob-whole">',
    'after_widget'  => '</section>',
    'before_title'  => '<h4>',
    'after_title'   => '</h4>'
    ]);


    // Store Sidebar
    register_sidebar([
      'name'          => __('Shop Main', 'ianua'),
      'id'            => 'shop-main',
      'before_widget' => '<section class="widget %1$s %2$s">',
      'after_widget'  => '</section>',
      'before_title'  => '<h4>',
      'after_title'   => '</h4>'
    ]);
}
add_action('widgets_init', __NAMESPACE__ . '\\widgets_init');

/**
 * Determine which pages should NOT display the sidebar
 */
function display_sidebar()
{
    static $display;

    isset($display) || $display = !in_array(true, [
    // The sidebar will NOT be displayed if ANY of the following return true.
    // @link https://codex.wordpress.org/Conditional_Tags
    is_404(),
    is_search(),
    is_front_page(),
    (is_page() && !is_page_template()),
    is_post_type_archive('product'),
    //!is_category(),
    is_singular('product'),
    is_page_template(['full-page.php','blog.php'])
    ]);

    return apply_filters('ianua/display_sidebar', $display);
}

/**
 * Theme assets
 */
function assets()
{
    wp_enqueue_style('ianua', Assets\asset_path('styles/main.css'), false, null);
    
    /**
    Font Awesome ascii characters where being converted gulp SASS when compiled rendering the icons useless see: https://github.com/sass/sass/issues/1395
    **/
    wp_enqueue_style('ianua-fa', '//use.fontawesome.com/releases/v5.11.2/css/all.css', false, null);
    
    if (is_single() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    wp_enqueue_script('jquery', Assets\asset_path('scripts/jquery.js'));
    
    wp_enqueue_script('jquery-ui-core');
    
    wp_enqueue_script('jquery-ui-slider');

    wp_enqueue_script('ianua-js', Assets\asset_path('scripts/main.js'), ['jquery','jquery-ui-core','jquery-ui-slider','google-maps'], null, true);
    
  // Localize the script with new data
    $theme_path = array(
        'asset' => Assets\asset_path(''),
        'image' => Assets\asset_path('images'),
        'script' => Assets\asset_path('scripts'),
        'style' => Assets\asset_path('styles')
    );
    
    wp_localize_script('ianua-js', 'path', $theme_path);
    
    wp_enqueue_script('google-maps', '//maps.googleapis.com/maps/api/js?key=AIzaSyAMbR3rEp916TVA_HBLAYye7DnHDdjZUkA', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\assets', 100);


/**
 * Enqueues front-end CSS for color scheme.
 *
 * @since ianua 1.0.0
 *
 * @see wp_add_inline_style()
 */
function customizer_css()
{
    
    $css    =   header_css();

    wp_add_inline_style('ianua', $css);
}
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\customizer_css', 101);

/**
 * Returns CSS for the Header CSS.
 *
 * @since ianua 1.0.0
 *
 * @param array $args arguments for CSS.
 * @return string Color scheme CSS.
 */
function header_css($args = null)
{
    
    $logo_image = wp_get_attachment_image_url(get_theme_mod('ianua_logo_image'));
    
        $footer_logo = wp_get_attachment_image_url(get_theme_mod('ianua_footer_logo_image'));
    $css = <<<CSS
	/* Logo */
    header .logo a {
        background: url("{$logo_image}") no-repeat center;
    }
		.footer-logo {
        background: url("{$footer_logo}") no-repeat center;
    }	

CSS;
    return $css;
}


/**
 * Returns Superfish Menu Navigation.
 *
 * @since ianua 1.0.0
 *
 */
function superfish_menu()
{

    wp_nav_menu(array(
        'container' => false,                           // remove nav container
        'container_class' => '',                        // class of container
        'menu' => 'Primary Menu',                                   // menu name
        'menu_id' => 'nav',                                   // menu Id
        'menu_class' => 'nav sf-menu',           // adding custom nav class
        'theme_location' => 'primary_navigation',                // where it's located in the theme
        'before' => '',                                 // before each link <a>
        'after' => '',                                  // after each link </a>
        'link_before' => '',                            // before each link text
        'link_after' => '',                             // after each link text
        'depth' => 0,                                   // limit the depth of the nav
        'fallback_cb' => false,                      // fallback function (see below)
        'echo' => true,
        
        'walker' => new Nav_Walker(), // Custom superfish menu walker

    ));
}


/*
 * Customize the output of menu for top bar.
 * The below walker builds custom HTML markup for menu in requirement to Super Fish Menu
 */

class Nav_Walker extends \Walker_Nav_Menu
{

    function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output)
    {
        $element->has_children = ! empty($children_elements[$element->ID]);
        $element->classes[] = ( isset($element->current) || isset($element->current_item_ancestor )) ? 'active' : '';
        $element->classes[] = ( $element->has_children ) ? 'has-children' : '';
        parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }
    /*
     * At the start of each element, output a <li> and <a> tag structure.
     *
     * Note: Menu objects include url and title properties, so we will use those.
     * @see Walker::start_el()
     */
    function start_el(&$output, $object, $depth = 0, $args = array(), $current_object_id = 0)
    {

        $item_html = '';
        $indent = ( $depth > 0  ? str_repeat('', $depth) : '' ); // code indent
        $line = ( $depth < 2  ? "\n" : '' ); // new line
        $this->curItem = $object;
        parent::start_el($item_html, $object, $depth, $args);
        $curItem = $object;
        $classes = empty($object->classes) ? array() : (array) $object->classes;
        
        if (in_array('current-menu-item', $classes)) {
            $classes[] = 'current ';
        }
        
        $class_names = esc_attr(implode(' ', apply_filters('nav_menu_css_class', array_filter($classes), $object)));

        // Build html markup
        $output .= $indent .'<li id="nav-menu-item-'. $object->ID . '" class="' . $class_names . '">'   .   $line;

        // link attributes
        $attributes  = ! empty($object->attr_title) ? ' title="'  . esc_attr($object->attr_title) .'"' : '';
        $attributes .= ! empty($object->target)     ? ' target="' . esc_attr($object->target) .'"' : '';
        $attributes .= ! empty($object->xfn)        ? ' rel="'    . esc_attr($object->xfn) .'"' : '';
        $attributes .= ! empty($object->url)        ? ' href="'   . esc_attr($object->url) .'" itemprop="url"' : '';
        $attributes .= ( $object->has_children )      ? ' aria-haspopup="true"' : '';

        $item_html = sprintf(
            '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
            $args->before,
            $attributes,
            $args->link_before,
            apply_filters('the_title', $object->title, $object->ID),
            $args->link_after,
            $args->after
        );

        // Complete the html markup by apply filter so other plugins can hook into it.
        $output .= apply_filters('walker_nav_menu_start_el', $item_html, $object, $depth, $args);
    }
}


/**
 * Returns Footer Menu Navigation.
 *
 * @since ianua 1.0.0
 *
 */
function footer_menu()
{

    wp_nav_menu(array(
        'container' => '',   // Container for menu
        'items_wrap'    =>  '%3$s', // wrap for menu items
        'menu' => 'Primary Menu',                                   // menu name
        'menu_id' => 'nav',                                   // menu Id
        'menu_class' => '',           // adding custom nav class
        'theme_location' => 'footer_navigation',                // where it's located in the theme
        'before' => '',                                 // before each link <a>
        'after' => '',                                  // after each link </a>
        'link_before' => '',                            // before each link text
        'link_after' => '',                             // after each link text
        'depth' => 1,                                   // limit the depth of the nav
        'fallback_cb' => false,                      // fallback function (see below)
        'echo' => true

    ));
}
