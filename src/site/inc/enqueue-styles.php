<?php

add_action( 'wp_enqueue_scripts', 'wp_recipe_site_styles' );

/**
 * Loads site styles.
 */
function wp_recipe_site_styles() {

    $wp_enqueue_util = WP_Enqueue_Util::get_instance();
    $wp_recipe = WP_Recipe::get_instance();

    $handle = $wp_recipe->get_slug() . '-styles';
    $relative_path = __DIR__ . '/../css/';
    $filename = 'wp-recipe.min.css';
    $filename_debug = 'wp-recipe.css';
    $dependencies = array();
    $version = $wp_recipe->get_version();

    $options = new WP_Enqueue_Options(
        $handle,
        $relative_path,
        $filename,
        $filename_debug,
        $dependencies,
        $version
    );

    $wp_enqueue_util->enqueue_style( $options );

    $handle = $wp_recipe->get_slug() . '-print-styles';
    $relative_path = __DIR__ . '/../css/';
    $filename = 'wp-recipe-print.min.css';
    $filename_debug = 'wp-recipe-print.css';
    $dependencies = array( $wp_recipe->get_slug() . '-styles' );
    $version = $wp_recipe->get_version();

    $options = new WP_Enqueue_Options(
        $handle,
        $relative_path,
        $filename,
        $filename_debug,
        $dependencies,
        $version
    );

    $options->set_media( 'print' );

    $wp_enqueue_util->enqueue_style( $options );

}