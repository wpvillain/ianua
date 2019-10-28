<?php use Ianua\Setup; ?>

        
<?php if( function_exists('get_field')) {
        if (get_field('recent_blog_posts_box_display') == 'Yes') : ?>
            <section id="from-the-blog">
                <?php dynamic_sidebar('sidebar-from-the-blog'); ?>
            </section>
    <?php endif; ?>
<?php } ?>

<?php if( function_exists('get_field')) {
        if (get_field('testimonial_box_display') == 'Yes') : ?>
        <section id="testimonials">
            <div class="row">
                <?php dynamic_sidebar('sidebar-testimonials'); ?>
            </div>
        </section>
    <?php endif; ?>
<?php } ?>
       

<section id="subscribe">
    <div class="row">
        
        <?php dynamic_sidebar('sidebar-newsletter'); ?>
    
    </div> <!-- /end row --> 
    
</section>  

<footer class="content-info">
    
  <div class="container footer-main">
        
        <div class="row">
            <?php dynamic_sidebar('sidebar-footer-1'); ?>
            
            <?php dynamic_sidebar('sidebar-footer-2'); ?>
            
            <?php dynamic_sidebar('sidebar-footer-3'); ?>
            
            <?php dynamic_sidebar('sidebar-footer-4'); ?>
        
        </div> <!-- /widget_social --> 
    
    </div> <!-- /container footer-main -->
    
    <div class="footer-bottom">
        <div class="row">
            <div class="twelve columns">
                <ul class="copyright">
                <li><?= esc_html(get_theme_mod('ianua_footer_copyright_text')); ?>  </li> 
                <?=     Setup\footer_menu()     ?>
                </ul>
                <div id="go-top">
                    <a class="smoothscroll" title="Back to Top" href="#top"><i class="fas fa-long-arrow-up"></i><span>top</span></a>
                </div>        
            </div>
        </div> <!-- /row -->
    </div> <!-- /footer-bottom -->
</footer>

<div id="preloader"> 
    <div id="loader"></div>
</div> 