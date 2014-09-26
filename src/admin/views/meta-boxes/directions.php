<?php
/**
 * @package WP_Recipe
 */

global $post;

$wp_recipe_directions = WP_Recipe_Directions::get_instance();

wp_nonce_field( $wp_recipe_directions->get_slug(), $wp_recipe_directions->get_nonce() );

$directions = get_post_meta( $post->ID, $wp_recipe_directions->get_meta_slug(), true );

$settings = array(
    'drag_drop_upload'  => true,
    'textarea_rows'     => 8
);

wp_editor( $directions, $wp_recipe_directions->get_id(), $settings );