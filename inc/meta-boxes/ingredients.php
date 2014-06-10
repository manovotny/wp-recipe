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

    $wp_recipe = WP_Recipe::get_instance();
    $wp_recipe_ingredients = WP_Recipe_Ingredients::get_instance();

    add_meta_box(
        $wp_recipe_ingredients->get_slug(),
        'Ingredients',
        'wp_recipe_display_ingredients_meta_box',
        $wp_recipe->get_post_type(),
        'normal',
        'high'
    );

}

/**
 * Displays ingredients meta box.
 */
function wp_recipe_display_ingredients_meta_box() {

    global $post;

    $wp_recipe_ingredients = WP_Recipe_Ingredients::get_instance();

    wp_nonce_field( $wp_recipe_ingredients->get_slug(), $wp_recipe_ingredients->get_nonce() );

    $ingredients = maybe_unserialize( get_post_meta( $post->ID, $wp_recipe_ingredients->get_slug(), true ) );
    $ingredients_classes = $wp_recipe_ingredients->get_classes();

    $html = '';

    $html .= '<fieldset class="' . $wp_recipe_ingredients->get_slug() . '">';
        $html .= '<button class="' . $ingredients_classes[ 'add' ] . ' button">Add</button>';
        $html .= '<ul class="list ' . $ingredients_classes[ 'list' ] . '">';

            if ( ! empty( $ingredients ) ) {

                foreach ( $ingredients as $ingredient ) {

                    $html .= $wp_recipe_ingredients->generate_markup( $ingredient );

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

    $wp_post_type_util = WP_Post_Type_Util::get_instance();
    $wp_recipe = WP_Recipe::get_instance();

    if ( ! $wp_post_type_util->is_post_type_saving_post_meta( $wp_recipe->get_post_type() ) ) {

        return;

    }

    $wp_recipe_ingredients = WP_Recipe_Ingredients::get_instance();

    if ( $wp_post_type_util->can_save_post_meta( $post_id, $wp_recipe_ingredients->get_slug(), $wp_recipe_ingredients->get_nonce() ) ) {

        update_post_meta( $post_id, $wp_recipe_ingredients->get_slug(), $_POST[ $wp_recipe_ingredients->get_id() ] );

    }

}