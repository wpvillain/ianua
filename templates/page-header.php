<?php use Ianua\Titles; ?>

<div class="page-header">
    <?php if (is_single()     ||  is_post_type_archive() || is_page_template('blog.php')) { ?>
        <h1><?=get_theme_mod('ianua_blog_title') ?></h1>
        <p><?=get_theme_mod('ianua_blog_description'); ?></p>
    <?php } elseif (is_search()) { ?>
    	<h1>Search</h1>   
    <?php } else { ?>   
    <h1><?= Titles\title(); ?></h1>
    <p><?= Titles\pageGist(); ?></p>    
    <?php } ?>
</div>