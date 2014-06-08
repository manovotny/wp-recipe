<?php
/**
 * @package WP_Recipe
 * @author Michael Novotny <manovotny@gmail.com>
 */

add_action( 'add_meta_boxes_recipe', 'wp_recipe_add_directions_meta_box' );
add_action( 'save_post', 'wp_recipe_save_directions_meta_box' );

/**
 * Adds directions meta box.
 */
function wp_recipe_add_directions_meta_box() {

    add_meta_box(
        'wp-recipe-directions',
        'Directions',
        'wp_recipe_display_directions_meta_box',
        'recipe',
        'normal',
        'high'
    );

}

/**
 * Displays directions meta box.
 */
function wp_recipe_display_directions_meta_box() {

    global $post;

    wp_nonce_field( 'wp-recipe-directions', 'wp-recipe-directions-nonce' );

    $directions = get_post_meta( $post->ID, 'wp-recipe-directions', true );

    $settings = array(
        'drag_drop_upload'  => true,
        'textarea_rows'     => 8
    );

    wp_editor( $directions, 'wp_recipe_directions', $settings );

}

/**
 * Saves directions.
 *
 * @param string $post_id Post id.
 */
function wp_recipe_save_directions_meta_box( $post_id ) {

    if ( empty( $_POST ) || 'recipe' !== $_POST[ 'post_type' ] ) {

        return;

    }

    $wp_recipe = WP_Recipe::get_instance();

    if ( $wp_recipe->can_user_save( $post_id, 'wp-recipe-directions', 'wp-recipe-directions-nonce' ) ) {

        update_post_meta( $post_id, 'wp-recipe-directions', $_POST[ 'wp_recipe_directions' ] );

    }

}