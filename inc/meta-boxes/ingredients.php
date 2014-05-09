<?php
/**
 * @package WP_Recipe
 * @author Michael Novotny <manovotny@gmail.com>
 */

// Register meta box.
add_action( 'add_meta_boxes_recipe', 'wp_recipe_add_ingredients_meta_box' );
//add_action( 'save_post', array( $this, 'save_pinterest_meta_box' ) );

function wp_recipe_add_ingredients_meta_box() {

    add_meta_box(
        'wp-recipe-ingredients',
        'Ingredients',
        'wp_recipe_ingredients_meta_box',
        'recipe',
        'normal',
        'high'
    );

}

function wp_recipe_ingredients_meta_box() {

    $html = '';

    echo 'INGREDIENTS';

}