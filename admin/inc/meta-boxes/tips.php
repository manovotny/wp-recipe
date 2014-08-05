<?php
/**
 * @package WP_Recipe
 */

add_action( 'add_meta_boxes_recipe', 'wp_recipe_add_tips_meta_box' );
add_action( 'save_post_' . WP_Recipe::get_instance()->get_post_type(), 'wp_recipe_save_tips_meta_box' );

/**
 * Adds tips meta box.
 */
function wp_recipe_add_tips_meta_box() {

    $wp_recipe = WP_Recipe::get_instance();
    $wp_recipe_tips = WP_Recipe_Tips::get_instance();

    add_meta_box(
        $wp_recipe_tips->get_slug(),
        'Tips',
        'wp_recipe_display_tips_meta_box',
        $wp_recipe->get_post_type(),
        'normal',
        'high'
    );

}

/**
 * Displays tips meta box.
 */
function wp_recipe_display_tips_meta_box() {

    include WP_File_Util::get_instance()->get_absolute_path( __DIR__, '../../views/meta-boxes/tips.php' );

}

/**
 * Saves tips.
 *
 * @param string $post_id Post id.
 */
function wp_recipe_save_tips_meta_box( $post_id ) {

    $wp_post_type_util = WP_Post_Type_Util::get_instance();
    $wp_recipe = WP_Recipe::get_instance();

    if ( ! $wp_post_type_util->is_post_type_saving_post_meta( $wp_recipe->get_post_type() ) ) {

        return;

    }

    $wp_recipe_tips = WP_Recipe_Tips::get_instance();

    if ( $wp_post_type_util->can_save_post_meta( $post_id, $wp_recipe_tips->get_slug(), $wp_recipe_tips->get_nonce() ) ) {

        update_post_meta( $post_id, $wp_recipe_tips->get_meta_slug(), $_POST[ $wp_recipe_tips->get_id() ] );

    }

}