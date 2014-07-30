<?php
/**
 * @package WP_Recipe
 */

add_action( 'add_meta_boxes_post', 'wp_recipe_add_recipes_in_post_meta_box' );

/**
 * Adds XXXXXX meta box.
 */
function wp_recipe_add_recipes_in_post_meta_box() {

    add_meta_box(
        'wp-recipe-recipes-in-post',
        'Recipes In Post',
        'wp_recipe_display_recipes_in_post_meta_box',
        'post',
        'normal',
        'high'
    );

}

/**
 * Displays XXXXXX meta box.
 */
function wp_recipe_display_recipes_in_post_meta_box() {

    global $post;

    $recipes_in_post = get_post_meta( $post->ID, 'wp-recipe-recipes-in-post' );

    $html = '';
    $html .= '<section class="' . 'wp-recipe-recipes-in-post' . '">';

        if ( empty( $recipes_in_post ) ) {

            $html .= '<p>No recipes in post.</p>';

        } else {

            $html .= '<ul>';

            foreach ( $recipes_in_post as $recipe_id ) {

                $html .= '<li>';
                    $html .= '<a href="' . get_edit_post_link( $recipe_id ) . '">' . get_the_title( $recipe_id ) . '</a>' ;
                $html .= '</li>';

            }

            $html .= '</ul>';

        }

    $html .= '</section>';

    echo $html;

}