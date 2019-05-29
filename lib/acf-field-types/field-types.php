<?php

/*
Plugin Name: Advanced Custom Fields: Field Types
Plugin URI: PLUGIN_URL
Description: SHORT_DESCRIPTION
Version: 1.0.0
Author: Jasper Frumau
Author URI: https://imagewize.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

namespace Ianua\Fields;

// exit if accessed directly
if (! defined('ABSPATH')) {
    exit;
}


// check if class already exists
if (!class_exists('ACFPluginCartButton')) :

    class ACFPluginCartButton
    {
    
        /*
        *  __construct
        *
        *  This function will setup the class functionality
        *
        *  @type    function
        *  @date    17/02/2016
        *  @since   1.0.0
        *
        *  @param   n/a
        *  @return  n/a
        */
    
        public function __construct()
        {
        
            // vars
            $this->settings = array(
            'version'   => '1.0.0',
            'url'       => plugin_dir_url(__FILE__),
            'path'      => plugin_dir_path(__FILE__)
            );
        
        
            // set text domain
            // https://codex.wordpress.org/Function_Reference/load_plugin_textdomain
            load_plugin_textdomain('acf-Cartbutton', false, plugin_basename(dirname(__FILE__)) . '/lang');
        
        
            // include field
            add_action('../acf/include_field_types', __NAMESPACE__ . array($this, 'includeFieldTypes')); // v5
            add_action('../acf/register_fields', __NAMESPACE__ . array($this, 'includeFieldTypes')); // v4
        }
    
    
        /*
        *  include_field_types
        *
        *  This function will include the field type class
        *
        *  @type    function
        *  @date    17/02/2016
        *  @since   1.0.0
        *
        *  @param   $version (int) major ACF version. Defaults to false
        *  @return  n/a
        */
    
        public function includeFieldTypes($version = false)
        {
        
            // support empty $version
            if (!$version) {
                $version = 4;
            }
        
        
            // include
            include_once('fields/cart-button' . $version . '.php');
        }
    }


// initialize
    new ACFPluginCartButton();


// class_exists check
endif;
