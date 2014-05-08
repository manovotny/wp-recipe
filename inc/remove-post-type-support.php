<?php
/**
 * @package WP_Recipe
 * @author Michael Novotny <manovotny@gmail.com>
 */

add_action( 'init', 'wp_recipe_remove_post_type_support' );

/**
 * Removes default post editor for recipe post type.
 */
function wp_recipe_remove_post_type_support() {

    // Remove editor.
    remove_post_type_support( 'recipe', 'editor' );

}