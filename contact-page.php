<?php
/**
 *
 * Template Name: Contact
 *
 * The template for displaying contact page with full header, followed by grid with right sidebar
 *
 * @since Ianua 1.0.0
 *
 * @package Ianua
 */

while (have_posts()) :
    the_post();
    get_template_part('templates/content', 'page');
endwhile;
