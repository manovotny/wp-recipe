<?php

global $post;

$wp_recipe_tips = WP_Recipe_Tips::get_instance();

wp_nonce_field( $wp_recipe_tips->get_slug(), $wp_recipe_tips->get_nonce() );

$tips = get_post_meta( $post->ID, $wp_recipe_tips->get_meta_slug(), true );

$settings = array(
    'drag_drop_upload'  => true,
    'textarea_rows'     => 3
);

wp_editor( $tips, $wp_recipe_tips->get_id(), $settings );