<?php use Ianua\Setup;
use Ianua\Extras; ?>

<header id="main-header" class="banner">
    <div class="row container">
        <div class="logo">
            <a class="brand" href="<?= esc_url(home_url()); ?>/">
    <span title="<?php bloginfo('description'); ?>" itemprop="headline"><?php bloginfo('name'); ?></span>
            </a>
        </div>
        <div id="nav-wrap">
            <a class="mobile-btn" href="#nav-wrap" title="Show navigation"> <span class="menu-icon">Menu</span> </a>
            <a class="mobile-btn" href="#" title="Hide navigation"> <span class="menu-icon">Menu</span> </a> <span class="mobile-search-trigger">
                    <a href="#"><i class="fa fa-search"></i></a>
                </span>
            <nav id="nav-contents" class="nav-primary">
                <?php
                if (has_nav_menu('primary_navigation')) :
                            Setup\superfish_menu();
                endif;
        ?>
                <div class="nav-right-menu">
                    <div class="header-search">
                        <a href="#" id="search-trigger"><i class="fa fa-search"></i></a>
                    </div>
                    <div class="header-social">                     
                        <?= Extras\header_social(); ?>
                    </div>
                    <div class="header-btn">
                        <?= Extras\header_button(); ?>
                    </div> 
                </div> <!-- /nav-right-menu --> 
            </nav> <!-- /nav-contents --> 
            <div id="header-search">
                <form action="/" method="get">
                    <input type="text" id="s" name="s" class="search-field" placeholder="Type to search …"> </form> <a href="#" class="close-btn">Close</a> </div>
            <!-- /header-search -->
        </div>
        <!-- /#nav-wrap -->
    </div>
    <!-- /row -->
</header>
<!-- /header -->