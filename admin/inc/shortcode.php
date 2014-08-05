<?php
/**
 * @package WP_Recipe
 */

add_shortcode( WP_Recipe::get_instance()->get_shortcode(), 'wp_recipe_shortcode' );

/**
 * Renders recipe shortcode.
 *
 * @param array $attributes Shortcode attributes.
 * @return string Rendered shortcode.
 */
function wp_recipe_shortcode( $attributes ) {

    ob_start();

    include WP_File_Util::get_instance()->get_absolute_path( __DIR__, '../../views/shortcode.php' );

    $html = ob_get_contents();

    ob_end_clean();

    return $html;

}