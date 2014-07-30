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

    $pattern = get_shortcode_regex();

    /*
     * Need to grab the content from POST and not the global post because
     * the global post contains the existing post information and the POST
     * contains the new information being saved.
     */
    preg_match_all( '/'. $pattern .'/s', $_POST[ 'content' ], $matches );

    if ( empty( $matches ) ) {

        return;

    }

    $recipe_ids_in_post = array();

    foreach ( $matches[ 3 ] as $attributes_string ) {

        $attributes = explode( ' ', $attributes_string );

        foreach ( $attributes as $attribute ) {

            if ( empty( $attribute ) ) {

                continue;

            }

            $attribute_key_value = explode( '=', $attribute );

            if ( 'id' === $attribute_key_value[ 0 ] ) {

                array_push( $recipe_ids_in_post, $attribute_key_value[ 1 ] );

            }

        }

    }

    $recipe_references = WP_Recipe_Cross_Reference_Recipes::get_instance();
    $post_references = WP_Recipe_Cross_Reference_Posts::get_instance();

    $previous_recipe_ids_in_post = get_post_meta( $post->ID, $recipe_references->get_slug() );

    $recipe_ids_removed_from_post = array_diff( $previous_recipe_ids_in_post, $recipe_ids_in_post );

    foreach ( $recipe_ids_removed_from_post as $recipe_id ) {

        delete_post_meta( $recipe_id, $post_references->get_slug(), $post->ID );

    }

    delete_post_meta( $post->ID, $recipe_references->get_slug() );

    $recipe_ids_in_post = array_unique( $recipe_ids_in_post );

    foreach ( $recipe_ids_in_post as $recipe_id ) {

        if ( wp_recipe_post_exists( $recipe_id ) ) {

            add_post_meta( $post->ID, $recipe_references->get_slug(), $recipe_id );

            $posts_using_recipe = get_post_meta( $recipe_id, $post_references->get_slug() );

            if ( ! in_array( $post->ID, $posts_using_recipe ) ) {

                add_post_meta( $recipe_id, $post_references->get_slug(), $post->ID );

            }

        }

    }

}

/**
 * Determines if a post exists or not.
 *
 * @param string $post_id The post id to check for existence.
 * @return boolean Whether or not the post exists.
 */
function wp_recipe_post_exists( $post_id ) {

    return is_string( get_post_status( $post_id ) );

}

