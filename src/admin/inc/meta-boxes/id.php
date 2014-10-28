<?php

add_action( 'add_meta_boxes_recipe', 'wp_recipe_add_id_meta_box' );

/**
 * Adds id meta box.
 */
function wp_recipe_add_id_meta_box() {

    $wp_recipe = WP_Recipe::get_instance();
    $wp_recipe_id = WP_Recipe_Id::get_instance();

    add_meta_box(
        $wp_recipe_id->get_slug(),
        'Recipe Id',
        'wp_recipe_display_id_meta_box',
        $wp_recipe->get_post_type(),
        'normal',
        'high'
    );

}

/**
 * Displays id meta box.
 */
function wp_recipe_display_id_meta_box() {

    include realpath( __DIR__ . '/../../views/meta-boxes/id.php' );

}