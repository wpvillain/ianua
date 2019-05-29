<?php

namespace Ianua\Customizer;

use Ianua\Assets;
use Ianua\Extras;

/**
 * Add postMessage support
 */
function customize_register($wp_customize)
{
    $wp_customize->get_setting('blogname')->transport = 'postMessage';

    
    
    /*  Panels to group sections together   */

    $wp_customize->add_panel('ianua_panel_style', array(
        'title'                         => __('Style', 'ianua'),
        'priority'          => 1,
        'description'       => __('Make changes to ianua style', 'ianua'),
    ));
  
    $wp_customize->add_panel('ianua_panel_store', array(
    'title'                         => __('Store', 'ianua'),
    'priority'          => 1,
    'description'       => __('Make changes to ianua store', 'ianua'),
    ));

    /*** Sections are arranged under panels. */
    
    $wp_customize->add_section('ianua_store_header', array(
        'title'             => __('Store Header', 'ianua'),
        'priority'          => 2,
        'panel'             => 'ianua_panel_store',
      ));

    $wp_customize->add_section('ianua_section_header', array(
        'title'             => __('Header', 'ianua'),
        'priority'          => 2,
        'panel'             => 'ianua_panel_style',
      ));
    
        $wp_customize->add_section('ianua_section_footer', array(
        'title'             => __('Footer', 'ianua'),
        'priority'          => 2,
        'panel'             => 'ianua_panel_style',
        ));

        $wp_customize->add_setting('ianua_blog_title', array(
        'type'              => 'theme_mod',
        'capability'        => 'manage_options',
        'default'           => null,
        'transport'         => 'refresh',
        ));
    

        $wp_customize->add_section('ianua_section_sharing', array(
        'title'             => __('Social Sharing', 'ianua'),
        'priority'          => 2,
        'panel'             => 'ianua_panel_style',
            'Description'       => 'Enable / Disable social sharing buttons',
        ));
  
    /*** Settings and Controls are arranged under sections. */

        $wp_customize->add_setting('ianua_blog_title', array(
        'type'              => 'theme_mod',
        'capability'        => 'manage_options',
        'default'           => null,
        'transport'         => 'refresh',
        ));
    
        $wp_customize->add_control(
            'ianua_blog_title',
            array(
                'type'             => 'text',
                'label'            => __('Blog Title', 'ianua'),
                'section'          => 'title_tagline',
                'description'      => __('Title of the blog that will be displayed above each posts', 'ianua')
            )
        );
    
        $wp_customize->add_setting('ianua_blog_description', array(
        'type'              => 'theme_mod',
        'capability'        => 'manage_options',
        'default'           => null,
        'transport'         => 'refresh',
        ));
    
        $wp_customize->add_control(
            'ianua_blog_description',
            array(
                'type'             => 'textarea',
                'label'            => __('Blog description', 'ianua'),
                'section'          => 'title_tagline',
                'description'      => __('This will be displayed above each posts', 'ianua')
            )
        );
    
        $wp_customize->add_setting('ianua_logo_image', array(
        'type'              => 'theme_mod',
        'capability'        => 'manage_options',
        'default'           => null,
        'transport'         => 'refresh',
        ));
    
        $wp_customize->add_control(
            new \WP_Customize_Cropped_Image_Control($wp_customize, 'ianua_logo_image', array(
            'type'             => 'cropped_image',
            'label'            => __('Logo Image', 'ianua'),
            'section'          => 'ianua_section_header',
            'description'      => __('Choose a logo image for site', 'ianua'),
            'flex_width'       => true,
            'width'            => 130,
            'height'           => 22,
            ))
        );
    
    
        $wp_customize->add_setting('ianua_footer_logo_image', array(
        'type'              => 'theme_mod',
        'capability'        => 'manage_options',
        'default'           => null,
        'transport'         => 'refresh',
        ));
    
        $wp_customize->add_control(
            new \WP_Customize_Cropped_Image_Control($wp_customize, 'ianua_footer_logo_image', array(
            'type'             => 'cropped_image',
            'label'            => __('Footer Logo Image', 'ianua'),
            'section'          => 'ianua_section_footer',
            'description'      => __('Choose a logo image for footer ', 'ianua'),
            'flex_width'       => true,
            'width'            => 160,
            'height'           => 27,
            ))
        );
    
        $wp_customize->add_setting('ianua_header_social_twitter', array(
        'type'              => 'theme_mod',
        'capability'        => 'manage_options',
        'default'           => 'https://twitter.com/',
        'transport'         => 'refresh',
        ));
    
        $wp_customize->add_control('ianua_header_social_twitter', array(
        'type'             => 'url',
        'label'            => __('Twitter', 'ianua'),
        'section'          => 'ianua_section_header',
        'description'      => __('Enter twitter profile URL', 'ianua'),
        ));
    
        $wp_customize->add_setting('ianua_header_social_facebook', array(
        'type'              => 'theme_mod',
        'capability'        => 'manage_options',
        'default'           => 'https://facebook.com/',
        'transport'         => 'refresh',
        ));
    
        $wp_customize->add_control('ianua_header_social_facebook', array(
        'type'             => 'url',
        'label'            => __('Facebook', 'ianua'),
        'section'          => 'ianua_section_header',
        'description'      => __('Enter facebook profile URL', 'ianua'),
        ));
    
        $wp_customize->add_setting('ianua_header_social_google', array(
        'type'              => 'theme_mod',
        'capability'        => 'manage_options',
        'default'           => 'https://google.com/',
        'transport'         => 'refresh',
        ));
    
        $wp_customize->add_control('ianua_header_social_google', array(
        'type'             => 'url',
        'label'            => __('Google Plus', 'ianua'),
        'section'          => 'ianua_section_header',
        'description'      => __('Enter google plus profile URL', 'ianua'),
        ));
    
    
        $wp_customize->add_setting('ianua_header_button_link', array(
        'type'              => 'theme_mod',
        'capability'        => 'manage_options',
        'default'           => 'https://ianua.com/',
        'transport'         => 'refresh',
              'sanitize_callback'                   =>  'esc_html'
        ));
    
        $wp_customize->add_control('ianua_header_button_link', array(
        'type'             => 'url',
        'label'            => __('Header Button Link', 'ianua'),
        'section'          => 'ianua_section_header',
        'description'      => __('Enter URL/Link for header button', 'ianua'),
        ));
    
        $wp_customize->add_setting('ianua_header_button_text', array(
        'type'              => 'theme_mod',
        'capability'        => 'manage_options',
        'default'           => '',
        'transport'         => 'refresh',
        ));
    
        $wp_customize->add_control('ianua_header_button_text', array(
        'type'             => 'text',
        'label'            => __('Header Button Text', 'ianua'),
        'section'          => 'ianua_section_header',
        'description'      => __('Enter call to action text for header button', 'ianua'),
        ));
    
    
        $wp_customize->add_setting('ianua_social_facebook', array(
        'type'              => 'theme_mod',
        'capability'        => 'manage_options',
        'default'           => '',
        'transport'         => 'refresh',
        ));
    
        $wp_customize->add_control('ianua_social_facebook', array(
        'type'             => 'checkbox',
        'label'            => __('Facebook', 'ianua'),
        'section'          => 'ianua_section_sharing',
        'description'      => __('Enable facebook sharing button', 'ianua'),
        ));
    
    
        $wp_customize->add_setting('ianua_social_twitter', array(
        'type'              => 'theme_mod',
        'capability'        => 'manage_options',
        'default'           => '',
        'transport'         => 'refresh',
        ));
    
        $wp_customize->add_control('ianua_social_twitter', array(
        'type'             => 'checkbox',
        'label'            => __('Twitter', 'ianua'),
        'section'          => 'ianua_section_sharing',
        'description'      => __('Enable twitter sharing button', 'ianua'),
        ));
    
    
        $wp_customize->add_setting('ianua_social_linkedin', array(
        'type'              => 'theme_mod',
        'capability'        => 'manage_options',
        'default'           => '',
        'transport'         => 'refresh',
        ));
    
        $wp_customize->add_control('ianua_social_linkedin', array(
        'type'             => 'checkbox',
        'label'            => __('Linkedin', 'ianua'),
        'section'          => 'ianua_section_sharing',
        'description'      => __('Enable linkedin sharing button', 'ianua'),
        ));
    
    
        $wp_customize->add_setting('ianua_social_skype', array(
        'type'              => 'theme_mod',
        'capability'        => 'manage_options',
        'default'           => '',
        'transport'         => 'refresh',
        ));
    
        $wp_customize->add_control('ianua_social_skype', array(
        'type'             => 'checkbox',
        'label'            => __('Skype', 'ianua'),
        'section'          => 'ianua_section_sharing',
        'description'      => __('Enable skype sharing button', 'ianua'),
        ));
    
        $wp_customize->add_setting('ianua_social_google', array(
        'type'              => 'theme_mod',
        'capability'        => 'manage_options',
        'default'           => '',
        'transport'         => 'refresh',
        ));
    
        $wp_customize->add_control('ianua_social_google', array(
        'type'             => 'checkbox',
        'label'            => __('Google', 'ianua'),
        'section'          => 'ianua_section_sharing',
        'description'      => __('Enable google sharing button', 'ianua'),
        ));
    
        $wp_customize->add_setting('ianua_social_email', array(
        'type'              => 'theme_mod',
        'capability'        => 'manage_options',
        'default'           => '',
        'transport'         => 'refresh',
        ));
    
        $wp_customize->add_control('ianua_social_email', array(
        'type'             => 'checkbox',
        'label'            => __('Email', 'ianua'),
        'section'          => 'ianua_section_sharing',
        'description'      => __('Enable email sharing button', 'ianua'),
        ));
    
    
        $wp_customize->add_setting('ianua_footer_copyright_text', array(
        'type'              => 'theme_mod',
        'capability'        => 'manage_options',
        'default'           => '&copy; Copyright Imagewize 2015.',
        'transport'         => 'refresh',
                'sanitize_callback'                     =>  'esc_html'
        ));
    
        $wp_customize->add_control('ianua_footer_copyright_text', array(
        'type'             => 'text',
        'label'            => __('Footer Copyright Text', 'ianua'),
        'section'          => 'ianua_section_footer',
        'description'      => __('Enter your text to be displayed on copyright area of footer', 'ianua'),
        ));
        
        $wp_customize->add_setting('ianua_store_intro_text', array(
        'type'              => 'theme_mod',
        'capability'        => 'manage_options',
        'default'           => 'Introduction text to awesome store!',
        'transport'         => 'refresh',
                'sanitize_callback'                     =>  'esc_html'
        ));
    
        $wp_customize->add_control('ianua_store_intro_text', array(
        'type'             => 'text',
        'label'            => __('Store Intro Text', 'ianua'),
        'section'          => 'ianua_store_header',
        'description'      => __('Enter your introduction text to be displayed on the store head', 'ianua'),
        ));
}
add_action('customize_register', __NAMESPACE__ . '\\customize_register');

/**
 * Customizer JS
 */

function customize_preview_js()
{
    wp_enqueue_script('ianua/customizer', Assets\asset_path('scripts/customizer.js'), ['customize-preview'], null, true);
}
add_action('customize_preview_init', __NAMESPACE__ . '\\customize_preview_js');
