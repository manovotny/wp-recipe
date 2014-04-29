<?php
/**
 * @package WP_Recipe
 * @author Michael Novotny <manovotny@gmail.com>
 */

add_shortcode( 'recipe', 'wp_recipe_shortcode' );

/**
 * Renders recipe shortcode.
 *
 * @param array $attributes Shortcode attributes.
 * @return string Rendered shortcode.
 */
function recipe_shortcode( $attributes ) {

    // Extract shortcode attributes.
    extract( shortcode_atts( array( 'id' => '' ), $attributes ) );

    // Check for id.
    if ( empty( $id ) ) {

        // No id.
        return '';

    }

    // Get recipe.
    $recipe = get_post( $id );

    // Check for recipe.
    if ( empty( $recipe ) ) {

        // No recipe.
        return '';

    }

    // Return recipe content.
    return $recipe->post_content;

}