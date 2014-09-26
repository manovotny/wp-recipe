<?php
/**
 * @package WP_Recipe
 */

add_action( 'admin_menu', 'wp_recipe_remove_default_discussion_meta_box' );

/**
 * Removes discussion meta box from recipe post type.
 */
function wp_recipe_remove_default_discussion_meta_box() {

    // Remove comments / discussion meta box.
    remove_meta_box( 'commentstatusdiv', 'recipe', 'advanced' );

}