<?php
/**
 * @package WP_Recipe
 */

add_filter( 'manage_recipe_posts_columns', 'wp_recipe_post_type_columns' );

add_action( 'manage_recipe_posts_custom_column', 'wp_recipe_post_type_columns_content', 10, 2 );

/**
 * Adds additional post type columns.
 *
 * @param $columns
 * @return mixed
 */
function wp_recipe_post_type_columns( $columns ) {

    $wp_array_util = WP_Array_Util::get_instance();

    $custom_columns = array(
        'recipe_id' => 'Id'
    );

    return $wp_array_util->add_items_at_index( $columns, $custom_columns, 2 );

}

/**
 * Displays additional post type columns.
 *
 * @param $column
 * @param $post_id
 */
function wp_recipe_post_type_columns_content( $column, $post_id ) {

    include realpath( __DIR__. '/../views/post-type-columns.php' );

}