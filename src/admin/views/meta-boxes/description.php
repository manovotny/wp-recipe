<?php

global $post;

$wp_recipe_description = WP_Recipe_Description::get_instance();

wp_nonce_field( $wp_recipe_description->get_slug(), $wp_recipe_description->get_nonce() );

$description = get_post_meta( $post->ID, $wp_recipe_description->get_meta_slug(), true );

$settings = array(
    'drag_drop_upload'  => true,
    'textarea_rows'     => 3
);

wp_editor( $description, $wp_recipe_description->get_id(), $settings );