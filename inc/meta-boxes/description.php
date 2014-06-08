<?php
/**
 * @package WP_Recipe
 * @author Michael Novotny <manovotny@gmail.com>
 */

add_action( 'add_meta_boxes_recipe', 'wp_recipe_add_description_meta_box' );
add_action( 'save_post', 'wp_recipe_save_description_meta_box' );

/**
 * Adds description meta box.
 */
function wp_recipe_add_description_meta_box() {

    add_meta_box(
        'wp-recipe-description',
        'Description',
        'wp_recipe_display_description_meta_box',
        'recipe',
        'normal',
        'high'
    );

}

/**
 * Displays description meta box.
 */
function wp_recipe_display_description_meta_box() {

    global $post;

    wp_nonce_field( 'wp-recipe-description', 'wp-recipe-description-nonce' );

    $description = get_post_meta( $post->ID, 'wp-recipe-description', true );

    $settings = array(
        'drag_drop_upload'  => true,
        'textarea_rows'     => 3
    );

    wp_editor( $description, 'wp_recipe_description', $settings );

}

/**
 * Saves description.
 *
 * @param string $post_id Post id.
 */
function wp_recipe_save_description_meta_box( $post_id ) {

    if ( empty( $_POST ) || 'recipe' !== $_POST[ 'post_type' ] ) {

        return;

    }

    $wp_recipe = WP_Recipe::get_instance();

    if ( $wp_recipe->can_user_save( $post_id, 'wp-recipe-description', 'wp-recipe-description-nonce' ) ) {

        update_post_meta( $post_id, 'wp-recipe-description', $_POST[ 'wp_recipe_description' ] );

    }

}