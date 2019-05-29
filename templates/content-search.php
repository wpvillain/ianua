<div class="media-wrap iw-search iw-archive-page"> 	   		

   	<div class="row">
	  <div class="page-info-title">
	   			<h2 class="iw-keyword"><?= get_search_query(false); ?></h2>
	   		   <p class="lead">Showing search result for 
		   		   <strong>
		   		   <?= get_search_query(); ?>
					</strong>
				</p>	   			
	   	</div> 
	</div> <!-- / End Row -->
	   
</div> <!-- /media-wrap -->

 <div class="row iw-post-list archive-list-view">
		
      	<div class="twelve columns">
		<?php
		$s=get_search_query();
		$args = array(
		                's' =>$s
		            );
		// 
	    $search_result_by_post   = get_posts($args);
	    
	    foreach ($search_result_by_post as $post) { 
				$permaLink=     get_permalink($post);
        $authorID   =   $post->post_author;
        $authorName     =   get_the_author_meta('nickname', $authorID);
        $authorLink     =   get_the_author_meta('user_url', $authorID);
        $title  =   $post->post_title;
        $date = get_the_date('M j, Y', $post->ID);
        ?>
      		<article>
      			<div class="header-part">
      				<span class="home-blog-thumb"><?= get_avatar( get_the_author_meta( 'ID' ) , 64 );?></span>
      				<div class="header-content">
      					<h3><a href="<?= $permaLink ?>" title="<?= the_title();?>"><?= the_title();?></a></h3>
      					<ul class="entry-meta">
								<li class="iw-date"><?= $date ?></li>
								<li class="iw-auth">by <a href="<?= $authorLink ?>" class="author"><?= $authorName ?></a></li>
								<li class="iw-tag">Tagged in <?php
								$count=0;
								$tags = wp_get_post_tags($post->ID);
								$html = '';
								foreach ( $tags as $tag ) {
									$count++;
									$tag_link = get_tag_link( $tag->term_id );
									if( $count > 5 ) break;
											
									$html .= "<a href='{$tag_link}' title='{$tag->name} Tag' class='{$tag->slug}'>";
									$html .= "{$tag->name}</a>, ";
								}
								//$html .= ', ';
								echo $html;
								?>
								</li>	
							</ul>
							<?php // var_dump($authorLink);?>
      				</div>
      			
      			</div>
      			<div class="content-part" >
      				<p class="intro-text">
					    <?php the_excerpt(); ?>
			         </p>
			         <p class="plink"><a href="<?=$permaLink;?>" title="<?= the_title();?>">Read More</a></p>      				
      			</div>      			
      		</article>
		<?php } // end while ?>
	  </div> <!-- / 12 columns -->

	</div> <!-- / row -->

	
