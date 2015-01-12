<?php

add_filter( 'wp_grunticon_admin_enqueue_scripts', 'wp_recipe_admin_enqueue_grunticon_scripts' );

/**
 * Queues Grunticon assets.
 *
 * @param $queue array List of enqueued Grunticon assets.
 * @return array Filtered list of enqueued Grunticon assets.
 */
function wp_recipe_admin_enqueue_grunticon_scripts( $queue ) {

    $wp_recipe = WP_Recipe::get_instance();
    $wp_url_util = WP_Url_Util::get_instance();

    $wp_grunticon_options = new WP_Grunticon_Options(
        $wp_url_util->convert_absolute_path_to_root_path( realpath( __DIR__ . '/../css/images' ) ),
        'svg.css',
        'png.css',
        'fallback.css',
        $wp_recipe->get_version()
    );

    array_push( $queue, $wp_grunticon_options );

    return $queue;

}