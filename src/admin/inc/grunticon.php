<?php

add_filter( 'wp_grunticon_enqueue_scripts', 'wp_recipe_enqueue_grunticon_scripts' );

/**
 * Queues Grunticon assets.
 *
 * @param $queue array List of enqueued Grunticon assets.
 * @return array Filtered list of enqueued Grunticon assets.
 */
function wp_recipe_enqueue_grunticon_scripts( $queue ) {

    $wp_recipe = WP_Recipe::get_instance();
    $wp_grunticon = WP_Grunticon::get_instance();

    $wp_grunticon_options = new WP_Grunticon_Options(
        $wp_grunticon->generate_grunticon_asset_path( __DIR__, '../css/images' ),
        'svg.css',
        'png.css',
        'fallback.css',
        $wp_recipe->get_version()
    );

    array_push( $queue, $wp_grunticon_options );

    return $queue;

}