<?php
/**
 * @package WP_Recipe
 * @author Michael Novotny <manovotny@gmail.com>
 */

add_action( 'add_meta_boxes_recipe', 'wp_recipe_add_yield_meta_box' );
add_action( 'save_post', 'wp_recipe_save_yield_meta_box' );

/**
 * Adds yield meta box.
 */
function wp_recipe_add_yield_meta_box() {

    add_meta_box(
        'wp-recipe-yield',
        'Yield',
        'wp_recipe_display_yield_meta_box',
        'recipe',
        'normal',
        'high'
    );

}

/**
 * Displays ingredients meta box.
 */
function wp_recipe_display_yield_meta_box() {

    global $post;

    wp_nonce_field( 'wp-recipe-yield', 'wp-recipe-yield-nonce' );

    $yield = get_post_meta( $post->ID, 'wp-recipe-yield', true );

    $html = '';

    $html .= '<fieldset class="wp-recipe-yield">';
        $html .= '<ul class="list">';
            $html .= '<li class="list-item">';
                $html .= '<label class="item-label" for="wp-recipe-yield">Yield</label>';
                $html .= '<input class="item-control" id="wp-recipe-yield" name="wp-recipe-yield" type="text" value="' . $yield . '" />';
            $html .= '</li>';
        $html .= '</ul>';
    $html .= '</fieldset>';

    echo $html;

}

/**
 * Saves yield.
 *
 * @param string $post_id Post id.
 */
function wp_recipe_save_yield_meta_box( $post_id ) {

    if ( empty( $_POST ) || 'recipe' !== $_POST[ 'post_type' ] ) {

        return;

    }

    $wp_recipe = WP_Recipe::get_instance();

    if ( $wp_recipe->can_user_save( $post_id, 'wp-recipe-yield', 'wp-recipe-yield-nonce' ) ) {

        update_post_meta( $post_id, 'wp-recipe-yield', $_POST[ 'wp-recipe-yield' ] );

    }

}