<?php
/**
 * @package WP_Recipe
 * @author Michael Novotny <manovotny@gmail.com>
 */

add_action( 'add_meta_boxes_recipe', 'wp_recipe_add_directions_meta_box' );
add_action( 'save_post_' . WP_Recipe::get_instance()->get_post_type(), 'wp_recipe_save_directions_meta_box' );

/**
 * Adds directions meta box.
 */
function wp_recipe_add_directions_meta_box() {

    $wp_recipe = WP_Recipe::get_instance();
    $wp_recipe_directions = WP_Recipe_Directions::get_instance();

    add_meta_box(
        $wp_recipe_directions->get_slug(),
        'Directions',
        'wp_recipe_display_directions_meta_box',
        $wp_recipe->get_post_type(),
        'normal',
        'high'
    );

}

/**
 * Displays directions meta box.
 */
function wp_recipe_display_directions_meta_box() {

    global $post;

    $wp_recipe_directions = WP_Recipe_Directions::get_instance();

    wp_nonce_field( $wp_recipe_directions->get_slug(), $wp_recipe_directions->get_nonce() );

    $directions = get_post_meta( $post->ID, $wp_recipe_directions->get_meta_slug(), true );

    $settings = array(
        'drag_drop_upload'  => true,
        'textarea_rows'     => 8
    );

    wp_editor( $directions, $wp_recipe_directions->get_id(), $settings );

}

/**
 * Saves directions.
 *
 * @param string $post_id Post id.
 */
function wp_recipe_save_directions_meta_box( $post_id ) {

    $wp_post_type_util = WP_Post_Type_Util::get_instance();
    $wp_recipe = WP_Recipe::get_instance();

    if ( ! $wp_post_type_util->is_post_type_saving_post_meta( $wp_recipe->get_post_type() ) ) {

        return;

    }

    $wp_recipe_directions = WP_Recipe_Directions::get_instance();

    if ( $wp_post_type_util->can_save_post_meta( $post_id, $wp_recipe_directions->get_slug(), $wp_recipe_directions->get_nonce() ) ) {

        update_post_meta( $post_id, $wp_recipe_directions->get_meta_slug(), $_POST[ $wp_recipe_directions->get_id() ] );

    }

}