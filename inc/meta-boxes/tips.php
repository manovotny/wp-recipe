<?php
/**
 * @package WP_Recipe
 * @author Michael Novotny <manovotny@gmail.com>
 */

// Register meta box.
add_action( 'add_meta_boxes_recipe', 'wp_recipe_add_tips_meta_box' );
//add_action( 'save_post', array( $this, 'save_pinterest_meta_box' ) );

function wp_recipe_add_tips_meta_box() {

    add_meta_box(
        'wp-recipe-tips',
        'Tips',
        'wp_recipe_tips_meta_box',
        'recipe',
        'normal',
        'high'
    );

}

function wp_recipe_tips_meta_box() {

    $settings = array(
        'drag_drop_upload'  => true,
        'textarea_rows'     => 3
    );

    wp_editor( '', 'wp_recipe_tips', $settings );

}