<?php
/**
 * @package WP_Recipe
 * @author Michael Novotny <manovotny@gmail.com>
 */

add_action( 'add_meta_boxes_recipe', 'wp_recipe_add_ingredients_meta_box' );
add_action( 'save_post', 'wp_recipe_save_ingredients_meta_box' );

/**
 * Adds ingredients meta box.
 */
function wp_recipe_add_ingredients_meta_box() {

    add_meta_box(
        'wp-recipe-ingredients',
        'Ingredients',
        'wp_recipe_display_ingredients_meta_box',
        'recipe',
        'normal',
        'high'
    );

}

/**
 * Displays ingredients meta box.
 */
function wp_recipe_display_ingredients_meta_box() {

    global $post;

    wp_nonce_field( 'wp-recipe-ingredients', 'wp-recipe-ingredients-nonce' );

    $ingredients = maybe_unserialize( get_post_meta( $post->ID, 'wp-recipe-ingredients', true ) );

    $html = '';

    $html .= '<fieldset class="wp-recipe-ingredients">';
        $html .= '<button class="add-ingredient button">Add</button>';
        $html .= '<ul class="list ingredients">';

            if ( ! empty( $ingredients ) ) {

                foreach ( $ingredients as $ingredient ) {

                    $html .= '<li class="ingredient">';
                        $html .= '<label class="item-label">Ingredient</label>';
                        $html .= '<input class="item-control" name="wp-recipe-ingredient[]" type="text" value="' . $ingredient . '" />';
                        $html .= '<span class="item-action">';
                            $html .= '<button class="remove-ingredient button">Remove</button>';
                        $html .= '</span>';
                    $html .= '</li>';

                }

            }

        $html .= '</ul>';
    $html .= '</fieldset>';

    echo $html;

}

/**
 * Saves ingredients.
 *
 * @param string $post_id Post id.
 */
function wp_recipe_save_ingredients_meta_box( $post_id ) {

    if ( empty( $_POST ) || 'recipe' !== $_POST[ 'post_type' ] ) {

        return;

    }

    $wp_recipe = WP_Recipe::get_instance();

    if ( $wp_recipe->can_user_save( $post_id, 'wp-recipe-ingredients', 'wp-recipe-ingredients-nonce' ) ) {

        update_post_meta( $post_id, 'wp-recipe-ingredients', $_POST[ 'wp-recipe-ingredient' ] );

    }

}