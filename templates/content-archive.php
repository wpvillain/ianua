<article>
	<div class="header-part">
		<div class="home-blog-thumb">
					<?=get_avatar(get_the_author_meta('user_email'), apply_filters('ianua_author_archive_avatar_size', 75))?>
		</div>
		<div class="header-content">
			<h3><a href="<?= the_permalink();	?>"><?php the_title(); ?></a></h3>
            <ul class="entry-meta">
                <li class="date"><time class="updated" datetime="<?= get_post_time('M j, Y', true);
?>"><?= get_the_date(); ?></time></li>
                <li class="auth">by <a href="<?= get_author_posts_url(get_the_author_meta('ID'));
?>" rel="author" class="fn"><?= get_the_author(); ?></a></li>
            </ul>
        </div>
    </div>
    <div class="content-part">
        <div class="intro-text">
            <?php 
            if( get_field('intro_paragraph') ) {
                the_field('intro_paragraph');
            } else {
            the_excerpt(); 
            }?>
        </div>
        <div class="plink"><a href="<?= get_permalink(get_the_ID()); ?>">Read More</a></div>
    </div>
</article>
<?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'ianua'), 'after' => '</p></nav>']); ?>