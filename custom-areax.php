<?php

/**
* Plugin Name: Custom Area X
* Description: Plugin para criar um subsistema de templates.
* Version: 0.1
**/


/***************
 * IMPORTANTE: 
 * single overide: https://wordpress.stackexchange.com/questions/17385/custom-post-type-templates-from-plugin-folder
 * archive overide: https://wordpress.stackexchange.com/questions/348382/creating-custom-archive-template-within-plugin-for-custom-post-type-using-archiv
 */




/**
 * Register a custom post type called "post_areax".
 */
function register_post_areax_post_type() {
  $labels = array(
     'name' => _x( 'Posts AREA X', 'post type general name' ),
     'singular_name' => _x( 'Post AREA X', 'post type singular name' ),
  );

  $args = array(
    'labels' => $labels,
    'description' => 'Post areax',
    'capability_type' => 'post',
    'public' => true,
    'publicly_queryable' => true,
    'hierarchical' => false,
    'has_archive' => 'post_areax', 
    'exclude_from_search' => true,
  );

  register_post_type( 'post_areax', $args );
}
add_action( 'init', 'register_post_areax_post_type' );


/**
 * Register a custom file path for single-areax.php
 */
function custom_single_areax($single) {
    global $post;
    
    if ( $post->post_type == 'post_areax' ) {
        $plugin_root_dir = plugin_dir_path( __FILE__ );
        $file = $plugin_root_dir . 'single-areax.php';

        if ( file_exists( $file ) ) {
            $single = $file;
        }
    }

    return $single;
}
add_filter('single_template', 'custom_single_areax');


/**
 * Register a custom file path for archive-areax.php
 */
function custom_archive_areax($archive_template){
    global $post;
    
    if (is_post_type_archive('post_areax')){
        $plugin_root_dir = plugin_dir_path( __FILE__ );
        $file = $plugin_root_dir . 'archive-areax.php';

        if ( file_exists( $file ) ) {
            $archive_template = $file;
        }
    }

    return $archive_template;
}
add_filter('archive_template', 'custom_archive_areax');




