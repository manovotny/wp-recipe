<?php
/**
 * @package WP_Recipe
 */

add_action( 'init', 'wp_recipe_remove_default_editor' );

/**
 * Removes default post editor for recipe post type.
 */
function wp_recipe_remove_default_editor() {

    // Remove editor.
    remove_post_type_support( 'recipe', 'editor' );

}