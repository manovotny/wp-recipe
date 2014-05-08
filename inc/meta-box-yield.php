<?php
/**
 * @package WP_Recipe
 * @author Michael Novotny <manovotny@gmail.com>
 */

// Register meta box.
add_action( 'add_meta_boxes', 'wp_recipe_add_yield_meta_box' );
//add_action( 'save_post', array( $this, 'save_pinterest_meta_box' ) );

function wp_recipe_add_yield_meta_box() {

    add_meta_box(
        'wp-recipe-yield',
        'Yield',
        'wp_recipe_yield_meta_box',
        'recipe',
        'normal',
        'high'
    );

}

function wp_recipe_yield_meta_box() {

    $html = '';

    $html .= '<fieldset>';
        $html .= '<label for="wp-recipe-yield">Yield</label>';
        $html .= '<input id="wp-recipe-yield" name="wp-recipe-yield" type="text" value="' . 'VALUE' . '" />';
    $html .= '</fieldset>';

    echo $html;

}