<?php
/**
 * @package WP_Recipe
 * @author Michael Novotny <manovotny@gmail.com>
 */

// Register meta box.
add_action( 'add_meta_boxes_recipe', 'wp_recipe_add_yield_meta_box' );
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

    $html .= '<fieldset class="wp-recipe-yield">';
        $html .= '<ul>';
            $html .= '<li>';
                $html .= '<label for="yield" class="item-label">Yield</label>';
                $html .= '<input id="yield" class="item-input" name="yield" type="text" value="" />';
            $html .= '</li>';
        $html .= '</ul>';
    $html .= '</fieldset>';

    echo $html;

}