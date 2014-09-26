<?php
/**
 * @package WP_Recipe
 */

add_action( 'add_meta_boxes_post', 'wp_recipe_add_recipe_cross_reference_meta_box' );

/**
 * Adds recipe cross reference meta box to posts.
 */
function wp_recipe_add_recipe_cross_reference_meta_box() {

    $recipe_references = WP_Recipe_Cross_Reference_Recipes::get_instance();

    add_meta_box(
        $recipe_references->get_slug(),
        'Recipe Cross References',
        'wp_recipe_display_recipe_cross_reference_meta_box',
        'post',
        'normal',
        'high'
    );

}

/**
 * Displays recipe cross reference meta box.
 */
function wp_recipe_display_recipe_cross_reference_meta_box() {

    include realpath( __DIR__ . '/../../views/meta-boxes/cross-reference-recipes.php' );

}