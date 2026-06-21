<?php
/*
Plugin Name: Productos
Plugin URI: localhost
Description: Creación de productos
Version: 1.0.0
Author: Susana Hernández
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

register_activation_hook(__FILE__,'cpt_productos_flush_rewrite_rules');
add_action('after_setup_theme','inicializando_productos');


function inicializando_productos(){
    add_action('init','cpt_productos_general');
}

function cpt_productos_general() {
    register_post_type('productos',array(
        'labels' => array(
            'name' => _x('Productos', 'post type general name'),
            'singular_name' => _x('Producto', 'post type singular name'),
            'add_new_item' => __('Añadir nuevo producto'),
            'edit_item' => __('Edit producto'),
            'view_item' => __('Vista producto'),
            'search_items' => __('Buscar producto'),
            'not_found' =>  __('No productos encontrados'),
            'not_found_in_trash' => __('No productos encontrados'),
            'parent_item_colon' => '',
            'menu_name' => 'Productos'
        ),
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position'=>25,
        'query_var' => true,
        'rewrite' => array('slug'=>'producto'),
        'capability_type' => 'post',
        'has_archive' => false,
        'hierarchical' => false,
        'menu_icon' => 'dashicons-networking',
        'supports' => array('title','excerpt','thumbnail')
    ));
}

function cpt_productos_flush_rewrite_rules(){
    flush_rewrite_rules(false);
}


add_filter( 'manage_edit-productos_columns', 'add_productos_excerpt_column' );
function add_productos_excerpt_column( $columns ) {
    // Add the excerpt column before or after other columns
    $columns['excerpt'] = __( 'Descripción', 'text-domain' );
    return $columns;
}

add_action( 'manage_productos_posts_custom_column', 'populate_productos_excerpt_column', 10, 2 );
function populate_productos_excerpt_column( $column, $post_id ) {
    if ( 'excerpt' === $column ) {
        // Get the post excerpt
        $excerpt = get_the_excerpt( $post_id );
        
        if ( ! empty( $excerpt ) ) {
            // Trim the length so it fits neatly in the admin panel
            echo wp_trim_words( $excerpt, 15, '...' );
        } else {
            echo '<span style="color:#a0a5aa;">—</span>';
        }
    }
}

function change_cpt_admin_labels( $translated_text, $text, $domain ) {
    global $post;
    
    // Make sure we are in the admin dashboard and dealing with your specific CPT
    if ( is_admin() && isset( $post->post_type ) && 'productos' === $post->post_type ) {
        if ( 'Title' === $text ) {
            return 'Título'; 
        } elseif ( 'Excerpt' === $text ) {
            return 'Descripción';
        }
    }
    
    return $translated_text;
}
add_filter( 'gettext', 'change_cpt_admin_labels', 20, 3 );



