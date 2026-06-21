<?php
/*
Plugin Name: Slider
Plugin URI: localhost
Description: Creación de sliders
Version: 1.0.0
Author: Susana Hernández
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! defined( 'CPT_SLIDER_VERSION' ) ) {
    define( 'CPT_SLIDER_VERSION', '0.1.0' );
}

register_activation_hook(__FILE__,'cpt_sliders_flush_rewrite_rules');
add_action('after_setup_theme','inicializando_sliders');


function inicializando_sliders(){
    add_action('init','cpt_sliders_general');
}

function cpt_sliders_general() {
    register_post_type('sliders',array(
        'labels' => array(
            'name' => _x('Sliders', 'post type general name'),
            'singular_name' => _x('Slider', 'post type singular name'),
        ),
        'public' => true,
        'supports' => array('title','thumbnail')
    ));
}

function cpt_sliders_flush_rewrite_rules(){
    flush_rewrite_rules(false);
}
// Load frontend rendering
if ( file_exists( __DIR__ . '/inc/frontend.php' ) ) {
    require_once __DIR__ . '/inc/frontend.php';
}

add_action('wp_enqueue_scripts', function(){
    wp_enqueue_style( 'cpt-slider-style', plugins_url( 'public/css/slider.css', __FILE__ ), array(), CPT_SLIDER_VERSION );
    wp_enqueue_script( 'cpt-slider-init', plugins_url( 'public/js/slider-init.js', __FILE__ ), array(), CPT_SLIDER_VERSION, true );
});





