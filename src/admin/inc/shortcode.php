<?php

add_shortcode( WP_Recipe::get_instance()->get_shortcode(), 'wp_recipe_shortcode' );

/**
 * Renders recipe shortcode.
 *
 * @param array $attributes Shortcode attributes.
 * @return string Rendered shortcode.
 */
function wp_recipe_shortcode( $attributes ) {

    ob_start();

    include realpath( __DIR__ . '/../../site/views/shortcode.php' );

    $html = ob_get_contents();

    ob_end_clean();

    return $html;

}