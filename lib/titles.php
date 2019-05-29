<?php

namespace Ianua\Titles;

/**
 * Page titles
 */
function title()
{
    if (is_home()) {
        if (get_option('page_for_posts', true)) {
            return get_the_title(get_option('page_for_posts', true));
        } else {
            return __('Latest Posts', 'ianua');
        }
    } elseif (is_archive()) {
        return ianua_archive_title();
    } elseif (is_search()) {
        return sprintf(__('Search Results for %s', 'sage'), get_search_query());
    } elseif (is_404()) {
        return __('Not Found', 'ianua');
    } else {
        return get_the_title();
    }
}

/**
* Page Gists
*/
function pageGist()
{
    
    global $post;
    $pageGist   =   '';
    
    if (is_singular('page')) {
        $ianuaMeta = get_post_meta($post->ID, 'ianua_meta', 'single');
        $pageGist  = (  isset($ianuaMeta['pageGist'])   )? $ianuaMeta['pageGist']: '';
    }
    
    return $pageGist;
}

/**
 * Archive titles
 */
function ianua_archive_title()
{
    if (is_category()) {
        $title = 'Category';
    } elseif (is_tag()) {
        $title = 'Tag';
    } elseif (is_author()) {
        $title = 'Author';
    } elseif (is_year()) {
        $title = 'Year';
    } elseif (is_month()) {
        $title = 'Month';
    } elseif (is_day()) {
        $title = 'Day';
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
        $title = 'Archives';
    } elseif (is_tax()) {
        $tax = get_taxonomy(get_queried_object()->taxonomy);
        /* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
        $title = sprintf(__('%1$s'), $tax->labels->singular_name);
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
    return apply_filters('get_the_archive_title', $title);
}
