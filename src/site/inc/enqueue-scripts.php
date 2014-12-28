<?php

add_action( 'wp_enqueue_scripts', 'wp_recipe_site_scripts' );

/**
 * Loads site scripts.
 */
function wp_recipe_site_scripts() {

    $wp_enqueue_util = WP_Enqueue_Util::get_instance();
    $wp_url_util = WP_Url_Util::get_instance();

    $wp_recipe = WP_Recipe::get_instance();

    $handle = $wp_recipe->get_slug() . '-scripts';
    $relative_path = __DIR__ . '/../js/';
    $filename = 'bundle.min.js';
    $filename_debug = 'bundle.concat.js';
    $dependencies = array();
    $version = $wp_recipe->get_version();

    $styles = array(
        $wp_enqueue_util->get_source_to_enqueue( __DIR__ . '/../css/', 'wp-recipe-print.min.css', 'wp-recipe-print.css' )
    );
    $styles = apply_filters( 'wp_recipe_enqueue_print_styles', $styles );

    $data = array(
        'print' => array(
            'styles' => $styles
        )
    );

    $options = new WP_Enqueue_Options(
        $handle,
        $relative_path,
        $filename,
        $filename_debug,
        $dependencies,
        $version,
        true
    );

    $options->set_localization( $wp_recipe->get_localization_handle(), $data );

    $wp_enqueue_util->enqueue_script( $options );

}