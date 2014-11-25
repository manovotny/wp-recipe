<?php

add_action( 'wp_enqueue_scripts', 'wp_recipe_site_scripts' );

/**
 * Loads site scripts.
 */
function wp_recipe_site_scripts() {

    $wp_enqueue_util = WP_Enqueue_Util::get_instance();
    $wp_recipe = WP_Recipe::get_instance();

    $handle = $wp_recipe->get_slug() . '-scripts';
    $relative_path = __DIR__ . '/../js/';
    $filename = 'bundle.min.js';
    $filename_debug = 'bundle.concat.js';
    $dependencies = array();
    $version = $wp_recipe->get_version();

    $options = new WP_Enqueue_Options(
        $handle,
        $relative_path,
        $filename,
        $filename_debug,
        $dependencies,
        $version,
        true
    );

    $wp_enqueue_util->enqueue_script( $options );

}