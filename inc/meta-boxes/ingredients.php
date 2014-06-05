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

    $html .= '<fieldset class="wp-recipe-ingredients">';
        $html .= '<ul>';
            $html .= '<li>';
                $html .= '<label for="ingredient" class="item-label">Ingredient</label>';
                $html .= '<input id="ingredient" class="item-input" name="ingredient" type="text" value="" />';
                $html .= '<span class="asdf">';
                    $html .= '<button class="remove-ingredient button">Remove</button>';
                $html .= '</span>';
            $html .= '</li>';
        $html .= '</ul>';
        $html .= '<button class="add-ingredient button">Add</button>';
    $html .= '</fieldset>';

    echo $html;

}