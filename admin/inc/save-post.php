<?php
/**
 * @package WP_Recipe
 */

add_action( 'save_post', 'wp_recipe_save_cross_references' );

/**
 * Saves post and recipe cross references.
 */
function wp_recipe_save_cross_references() {

    global $post;

    if ( empty( $post ) ) {

        return;

    }

    $post_id = $post->ID;

    $wp_recipe = WP_Recipe::get_instance();
    $post_references = WP_Recipe_Cross_Reference_Posts::get_instance();
    $recipe_references = WP_Recipe_Cross_Reference_Recipes::get_instance();

    /*
     * Need to grab the content from POST and not the global post because
     * the global post contains the existing post information and the POST
     * contains the new information being saved.
     */
    $recipe_ids = wp_recipe_get_shortcode_attribute_values_used_in_content( $_POST[ 'content' ], $wp_recipe->get_shortcode(), 'id' );

    $post_references->update( $post_id, $recipe_ids );
    $recipe_references->update( $post_id, $recipe_ids );

}

/**
 * @param $content
 * @param $find_shortcode
 * @param $find_attribute
 * @internal param $shortcodes
 * @return array
 */
function wp_recipe_get_shortcode_attribute_values_used_in_content( $content, $find_shortcode, $find_attribute )
{
    $shortcodes = wp_recipe_get_shortcodes_used_in_content( $content );

    if ( empty( $shortcodes ) ) {

        return null;

    }

    $values = array();

    $name = 2;
    $attribute_string = 3;

    foreach ( $shortcodes[ $name ] as $index => $shortcode ) {

        if ( $find_shortcode === $shortcode ) {

            $attributes = explode( ' ', trim( $shortcodes[ $attribute_string ][ $index ] ) );

            foreach ( $attributes as $attribute ) {

                $attribute_key_value = explode( '=', $attribute );

                if ( $find_attribute === $attribute_key_value[ 0 ] ) {

                    array_push( $values, $attribute_key_value[ 1 ] );

                }

            }

        }

    }

    return $values;
}

/**
 * @param $content
 * @return mixed
 */
function wp_recipe_get_shortcodes_used_in_content( $content )
{
    $pattern = get_shortcode_regex();

    preg_match_all( '/' . $pattern . '/s', $content, $matches );

    return $matches;
}