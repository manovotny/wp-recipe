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

    $wp_recipe = WP_Recipe::get_instance();
    $wp_recipe_yield = WP_Recipe_Yield::get_instance();

    add_meta_box(
        $wp_recipe_yield->get_slug(),
        'Yield',
        'wp_recipe_display_yield_meta_box',
        $wp_recipe->get_post_type(),
        'normal',
        'high'
    );

}

/**
 * Displays yield meta box.
 */
function wp_recipe_display_yield_meta_box() {

    global $post;

    $wp_recipe_yield = WP_Recipe_Yield::get_instance();

    wp_nonce_field( $wp_recipe_yield->get_slug(), $wp_recipe_yield->get_nonce() );

    $yield = get_post_meta( $post->ID, $wp_recipe_yield->get_slug(), true );

    $html = '';

    $html .= '<fieldset class="' . $wp_recipe_yield->get_slug() . '">';
        $html .= '<ul class="list">';
            $html .= '<li class="list-item">';
                $html .= '<label class="item-label" for="' . $wp_recipe_yield->get_id() . '">Yield</label>';
                $html .= '<input class="item-control" id="' . $wp_recipe_yield->get_id() . '" name="' . $wp_recipe_yield->get_id() . '" type="text" value="' . $yield . '" />';
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

    $wp_recipe = WP_Recipe::get_instance();

    if ( empty( $_POST ) || $wp_recipe->get_post_type() !== $_POST[ 'post_type' ] ) {

        return;

    }

    $wp_recipe_yield = WP_Recipe_Yield::get_instance();

    if ( $wp_recipe->can_user_save( $post_id, $wp_recipe_yield->get_slug(), $wp_recipe_yield->get_nonce() ) ) {

        update_post_meta( $post_id, $wp_recipe_yield->get_slug(), $_POST[ $wp_recipe_yield->get_id() ] );

    }

}