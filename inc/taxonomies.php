<?php
/**
 * @package WP_Recipe
 * @author Michael Novotny <manovotny@gmail.com>
 */

add_action( 'init', 'wp_recipe_taxonomies' );

/**
 * Creates recipe taxonomies.
 */
function wp_recipe_taxonomies() {

    $post_type = 'recipe';

    $taxonomies = array(
        new WP_Taxonomy_Options( 'Cooking Method', 'Cooking Methods', 'cooking-methods', $post_type ),
        new WP_Taxonomy_Options( 'Course', 'Courses', 'courses', $post_type ),
        new WP_Taxonomy_Options( 'Cuisine', 'Cuisines', 'cuisines', $post_type ),
        new WP_Taxonomy_Options( 'Ingredient', 'Ingredients', 'ingredients', $post_type, false ),
        new WP_Taxonomy_Options( 'Occasion', 'Occasions', 'occasions', $post_type )
    );

    WP_Taxonomy_Util::get_instance()->create_taxonomies( $taxonomies );

}