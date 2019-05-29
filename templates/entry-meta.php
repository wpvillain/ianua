<?php
 use Ianua\Extras;
?>
<ul class="entry-meta">
    <li class="date">
<time class="updated" datetime="<?= get_post_time('c', true);
?>"><?= get_the_date(); ?></time>
    </li>
    <li class="auth"><span class="byline author vcard"><?= __('By', 'ianua');
?> <a href="<?= get_author_posts_url(get_the_author_meta('ID'));
?>" rel="author" class="fn"><?= get_the_author(); ?></a></span></li>
    <li class="cat"><?=Extras\entry_taxonomies()?></li>
</ul>
        
        
