<?php
/**
 * @package WP_Recipe
 */

add_action( 'add_meta_boxes_recipe', 'wp_recipe_add_posts_cross_reference_meta_box' );

/**
 * Adds post cross reference meta box to recipes.
 */
function wp_recipe_add_posts_cross_reference_meta_box() {

    $wp_recipe = WP_Recipe::get_instance();
    $post_references = WP_Recipe_Cross_Reference_Posts::get_instance();

    add_meta_box(
        $post_references->get_slug(),
        'Post Cross References',
        'wp_recipe_display_posts_cross_reference_meta_box',
        $wp_recipe->get_post_type(),
        'normal',
        'high'
    );

}

/**
 * Displays post cross reference meta box.
 */
function wp_recipe_display_posts_cross_reference_meta_box() {

    include realpath( __DIR__ . '/../../views/meta-boxes/cross-reference-posts.php' );

}