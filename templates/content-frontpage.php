<?php //the_content(); ?>
<?php

// check if the flexible content field has rows of data
if( have_rows('homepage_builder') ):

     
	 	// loop through the rows of data
	    while ( have_rows('homepage_builder') ) : the_row();

		        if( get_row_layout() == 'about_block') : ?>
                    <section id="about">
	                    <div class="row section-head">
	                        <div class="twelve columns">
					        	<h2 class="section-header"><?php the_sub_field('about_title'); ?> </h2>
						     </div> <!-- end twelve columns /-->
						</div>  <!-- end section-head /-->
						<div class="row">
							<div class="three columns tab-whole about-pic">
                                <div class="profile-pic">
                                    <?php 
									$image = get_sub_field('about_profile_picture');
									if( !empty($image) ): ?>
										<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
									<?php endif; ?>
                                </div>
							</div> <!-- end three columns /-->
							<div class="nine columns tab-whole about-content">
							    <p class="lead"><?php the_sub_field('about_lead'); ?></p>
							    <?php the_sub_field('about_text'); ?>
							</div> <!-- end nine columns /-->
						</div> <!-- end row /-->
		            </section>

		        <?php elseif( get_row_layout() == 'services_intro' ): ?>

		        	<section id="services">
						<div class="row section-head">
							<div class="twelve columns">
								<h2 class="section-header"><?php the_sub_field('services_title');?></h2>
					            <p class="lead"><?php the_sub_field('services_introduction_text_block'); ?></p>
							</div>
						</div>

		        <?php elseif (get_row_layout() == 'services_blocks') : ?>
		        	<?php // check if the repeater field has rows of data ?>
					
						<div class="row">
							<div class="service-list bgrid-half tab-bgrid-whole group">
								<?php if( have_rows('services_boxes') ):

									 	// loop through the rows of data
									    while ( have_rows('services_boxes') ) : the_row();

									        // display a sub field value ?>
				        		        	<div class="bgrid">
												<span class="icon"><i class="<?php the_sub_field('text_box_icon'); ?>"></i></span>
												<div class="service-content">
													<h3><?php the_sub_field('text_box_title'); ?></h3> 
						        		        	<?php the_sub_field('text_box'); ?>
					        		        	</div>
					        		        </div>

									    <?php endwhile;

									else :

								    // no rows found

									endif;?>
							</div>
						</div>
					</section>

		        <?php elseif (get_row_layout() == 'cta_banner') : ?>
		        	<section id="CTA">  
						<div class="row cta-action">
							<div class="twelve columns">
								<h2 class="section-header"><?php the_sub_field('cta_title');?></h2>
								<p class="lead"><?php the_sub_field('cta_text');?></p>
					            <a href="<?php the_sub_field('cta_button_url');?>" class="button"><?php the_sub_field('cta_button_text');?></a>
					        </div>
					    </div>
					</section>

		        <?php endif;

	    endwhile;

	    

else :

    // no layouts found

endif;

?>
<?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'ianua'), 'after' => '</p></nav>']);
