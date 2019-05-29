<?php

namespace Ianua\Media;

function featured_slider()
{
    
    $args = array(
     'post_type' => 'post',
     'meta_key'   => 'ianua_featured_post',
    'meta_value'    =>  '1',
     'post_status' => 'publish'
    );
    
    $featured   = get_posts($args);
    
    foreach ($featured as $post) {
        $thumb_id = get_post_thumbnail_id($post, 'featured');
        $imageUrl = wp_get_attachment_url($thumb_id);
        $permaLink=     get_permalink($post);
        $authorID   =   $post->post_author;
        $authorName     =   get_the_author_meta('nickname', $authorID);
        $authorLink     =   get_the_author_meta('user_url', $authorID);
        $title  =   $post->post_title;
        $date = get_the_date('M j, Y', $post->ID);
        ?>
            <li>
                <div class="featured-post-slide">
                    <div class="post-background" style="background-image:url('<?=$imageUrl;?>');"></div>
                    <div class="shadow"></div>
                    <div class="post-content">
                        <h1 class="slide-title">
                            <a href="<?=$permaLink?>"><?=$title?></a></h1>
                        <ul class="entry-meta">
                            <li class="date"><?=$date?></li>
                            <li class="auth"><a href="<?= $authorLink ?>" class="author"><?php echo $authorName ?></a></li>
                        </ul>
                        <a href="<?=$permaLink?>" title="<?=$title?>" class="button stroke more-link">Read the Article</a>
                    </div>
                </div>
            </li>
            <?php
    }
}

function featured_products_slider()
{
    
    $args = array(
        'post_type' => 'product',
        'meta_key'   => '_featured',
        'meta_value'    =>  'yes',
        'post_status' => 'publish'
    );
    
    $featured   = get_posts($args);
    
    foreach ($featured as $post) {
        $thumb_id = get_post_thumbnail_id($post, 'featured');
        $imageUrl = wp_get_attachment_url($thumb_id);
        $permaLink=     get_permalink($post);
        $authorID   =   $post->post_author;
        $post_excerpt     =   get_the_excerpt( $post );
        $productIntro = substr($post_excerpt, 1, 140);
        $title  =   $post->post_title;
        $date = get_the_date('M j, Y', $post->ID);
        ?>
            <li>
                <div class="featured-post-slide">
                    <div class="post-background" style="background-image:url('<?=$imageUrl;?>');"></div>
                    <div class="shadow"></div>
                    <div class="post-content">
                        <h1 class="slide-title">
                            <a href="<?=$permaLink?>"><?=$title?></a></h1>
                        <p>
                            <?= $productIntro ?>
                        </p>
                        <a href="<?=$permaLink?>" title="<?=$title?>" class="button stroke more-link">Shop now</a>
                    </div>
                </div>
            </li>
            <?php
    }
}

function archive_slider()
{

    if (is_archive() && is_post_type_archive() && !is_post_type_archive('product') || is_page_template('blog.php')) {
?>
            <div class="media-wrap">
                <div class="row">
                    <div class="featured-post-slider flexslider">
                        <ul class="slides">
                            
                            <?=featured_slider()?>

                </ul> <!-- /slides -->              

            </div> <!-- /featured-post-slider -->           
                                                
            </div> <!-- /row -->                                    

    </div> <!-- /media-wrap -->
            <?php
    }
}

add_filter('ianua_before_content_wrap', __NAMESPACE__ . '\\archive_slider');

function product_archive_slider()
{

    if (is_post_type_archive('product')) {
?>
            <div class="media-wrap">
                <div class="row">
                    <div class="featured-post-slider flexslider">
                        <ul class="slides">
                            
                            <?=featured_products_slider()?>

                </ul> <!-- /slides -->              

            </div> <!-- /featured-post-slider -->           
                                                
            </div> <!-- /row -->                                    

    </div> <!-- /media-wrap -->
            <?php
    }
}

add_filter('ianua_before_content_wrap', __NAMESPACE__ . '\\product_archive_slider');


function archive_info_title()
{

    if (is_archive() && !is_post_type_archive() && !is_tax( 'product_cat')) {
?>
<div class="media-wrap iw-tag iw-archive-page">
<div class="row">
<div class="page-info-title">
<h2><?= get_archive_info_title() ?></h2>
<?= get_archive_info_lead() ?>
</div>
</div>
</div>
            <?php
    }
}

add_filter('ianua_before_content_wrap', __NAMESPACE__ . '\\archive_info_title');

function product_cat_info_title()
{

    if (is_tax( 'product_cat')) {
?>
<div class="row store-content-header">
        <div class="twelve columns">
            <h2><?= get_archive_info_title() ?></h2>
            <?= get_archive_info_lead() ?>
        </div>
</div>
<?php wc_get_template( 'loop/orderby.php');

    }
}

add_filter('ianua_before_content_wrap', __NAMESPACE__ . '\\product_cat_info_title');


function get_archive_info_lead()
{
    if (is_category()) {
        $title = sprintf(__('<p class="lead">Articles categorized in: <strong>%s</strong></p>'), single_cat_title('', false));
    } elseif (is_tag()) {
        $title = sprintf(__('<p class="lead">Articles tagged in: <strong>%s</strong></p>'), single_tag_title('', false));
    } elseif (is_author()) {
        $title = sprintf(__('<p class="lead">Author: <strong>%s</strong></p>'), '<span class="vcard">' . get_the_author() . '</span>');
    } elseif (is_year()) {
        $title = sprintf(__('<p class="lead">Year: <strong>%s</strong></p>'), get_the_date(_x('Y', 'yearly archives date format')));
    } elseif (is_month()) {
        $title = sprintf(__('<p class="lead">Month: <strong>%s</strong></p>'), get_the_date(_x('F Y', 'monthly archives date format')));
    } elseif (is_day()) {
        $title = sprintf(__('<p class="lead">Day: <strong>%s</strong></p>'), get_the_date(_x('F j, Y', 'daily archives date format')));
    } elseif (is_tax('post_format')) {
        if (is_tax('post_format', 'post-format-aside')) {
            $title = _x('Asides', 'post format archive title');
        } elseif (is_tax('post_format', 'post-format-gallery')) {
            $title = _x('Galleries', 'post format archive title');
        } elseif (is_tax('post_format', 'post-format-image')) {
            $title = _x('Images', 'post format archive title');
        } elseif (is_tax('post_format', 'post-format-video')) {
            $title = _x('Videos', 'post format archive title');
        } elseif (is_tax('post_format', 'post-format-quote')) {
            $title = _x('Quotes', 'post format archive title');
        } elseif (is_tax('post_format', 'post-format-link')) {
            $title = _x('Links', 'post format archive title');
        } elseif (is_tax('post_format', 'post-format-status')) {
            $title = _x('Statuses', 'post format archive title');
        } elseif (is_tax('post_format', 'post-format-audio')) {
            $title = _x('Audio', 'post format archive title');
        } elseif (is_tax('post_format', 'post-format-chat')) {
            $title = _x('Chats', 'post format archive title');
        }
    } elseif (is_post_type_archive()) {
        $title = sprintf(__('<p class="lead">Archives: <strong>%s</strong></p>'), post_type_archive_title('', false));
    } elseif (is_tax()) {
        $tax = get_taxonomy(get_queried_object()->taxonomy);
        /* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
        $title = sprintf(__('%1$s: %2$s'), $tax->labels->singular_name, single_term_title('', false));
    } elseif (is_search()) {
        $title = '';
    } else {
        $title = __('<p class="lead">Archives</p>');
    }
 
    /**
     * Filter the archive title.
     *
     * @since 4.1.0
     *
     * @param string $title Archive title to be displayed.
     */
    return apply_filters('get_the_archive_title', $title);
}


function get_archive_info_title()
{
    
    
    if (is_category()) {
        $title = single_cat_title('', false);
    } elseif (is_tag()) {
        $title = single_tag_title('', false);
    } elseif (is_author()) {
        $title = get_the_author();
    } elseif (is_year()) {
        $title = get_the_date(_x('Y', 'yearly archives date format'));
    } elseif (is_month()) {
        $title = get_the_date(_x('F Y', 'monthly archives date format'));
    } elseif (is_day()) {
        $title = get_the_date(_x('F j, Y', 'daily archives date format'));
    } elseif (is_tax('post_format')) {
        if (is_tax('post_format', 'post-format-aside')) {
            $title = _x('Asides', 'post format archive title');
        } elseif (is_tax('post_format', 'post-format-gallery')) {
            $title = _x('Galleries', 'post format archive title');
        } elseif (is_tax('post_format', 'post-format-image')) {
            $title = _x('Images', 'post format archive title');
        } elseif (is_tax('post_format', 'post-format-video')) {
            $title = _x('Videos', 'post format archive title');
        } elseif (is_tax('post_format', 'post-format-quote')) {
            $title = _x('Quotes', 'post format archive title');
        } elseif (is_tax('post_format', 'post-format-link')) {
            $title = _x('Links', 'post format archive title');
        } elseif (is_tax('post_format', 'post-format-status')) {
            $title = _x('Statuses', 'post format archive title');
        } elseif (is_tax('post_format', 'post-format-audio')) {
            $title = _x('Audio', 'post format archive title');
        } elseif (is_tax('post_format', 'post-format-chat')) {
            $title = _x('Chats', 'post format archive title');
        }
    } elseif (is_post_type_archive()) {
        $title = post_type_archive_title('', false);
    } elseif (is_tax()) {
        $tax = get_taxonomy(get_queried_object()->taxonomy);
        /* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
        $title = sprintf(__('%2$s'), $tax->labels->singular_name, single_term_title('', false));
    } elseif (is_search()) {
        $title = __('Search Results');
    } else {
        $title = __('Archives');
    }
 
    /**
     * Filter the archive title.
     *
     * @since 4.1.0
     *
     * @param string $title Archive title to be displayed.
     */
    return apply_filters('get_archive_info_title', $title);
}