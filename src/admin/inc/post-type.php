<?php

add_action( 'init', 'wp_recipe_post_type' );

/**
 * Creates recipe post type.
 */
function wp_recipe_post_type() {

    $wp_image_util = WP_Image_Util::get_instance();

    $wp_recipe = WP_Recipe::get_instance();
    
    $labels = array(
        'add_new_item' => _x( 'Add New Recipe', 'recipe custom post type add new item', $wp_recipe->get_slug() ),
        'all_items' => _x( 'All Recipes', 'recipe custom post type all items', $wp_recipe->get_slug() ),
        'edit_item' => _x( 'Edit Recipe', 'recipe custom post type edit item', $wp_recipe->get_slug() ),
        'menu_name' => _x( 'Recipes', 'recipe custom post type menu name', $wp_recipe->get_slug() ),
        'name' => _x( 'Recipes', 'recipe custom post type name', $wp_recipe->get_slug() ),
        'new_item' => _x( 'New Recipe', 'recipe custom post type new item', $wp_recipe->get_slug() ),
        'not_found' => _x( 'No recipes found', 'recipe custom post type not found', $wp_recipe->get_slug() ),
        'not_found_in_trash' => _x( 'No recipes found in the trash', 'recipe custom post type not found in trash', $wp_recipe->get_slug() ),
        'search_items' => _x( 'Search Recipes', 'recipe custom post type search items', $wp_recipe->get_slug() ),
        'singular_name' => _x( 'Recipe', 'recipe custom post type singular name', $wp_recipe->get_slug() ),
        'view_item' => _x( 'View Recipe', 'recipe custom post type view item', $wp_recipe->get_slug() )
    );

    $args = array(
        'description' => _x( 'A place to collect all your delicious recipes', 'recipe custom post type description', $wp_recipe->get_slug() ),
        'hierarchical' =>  false,
        'labels' =>  $labels,
        'menu_icon' => $wp_image_util->generate_datauri( realpath( __DIR__ . '/../images/data/recipes.svg' ) ),
        'menu_position' =>  5,
        'public' =>  true,
        'supports' =>  array(
            'comments',
            'editor',
            'revisions',
            'thumbnail',
            'title'
        )
    );

    register_post_type( $wp_recipe->get_post_type(), $args );

}