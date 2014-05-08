<?php
/**
 * @package WP_Recipe
 * @author Michael Novotny <manovotny@gmail.com>
 */

add_action( 'admin_menu', 'wp_recipe_remove_meta_box' );

/**
 * Removes comments / discussion meta box from recipe post type.
 */
function wp_recipe_remove_meta_box() {

    // Remove comments / discussion meta box.
    remove_meta_box( 'commentstatusdiv', 'recipe', 'advanced' );

}