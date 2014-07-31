<?php
/**
 * @package WP_Recipe
 */

add_action( 'add_meta_boxes_post', 'wp_recipe_add_recipe_cross_reference_meta_box' );

/**
 * Adds recipe cross reference meta box to posts.
 */
function wp_recipe_add_recipe_cross_reference_meta_box() {

    $recipe_references = WP_Recipe_Cross_Reference_Recipes::get_instance();

    add_meta_box(
        $recipe_references->get_slug(),
        'Recipe Cross References',
        'wp_recipe_display_recipe_cross_reference_meta_box',
        'post',
        'normal',
        'high'
    );

}

/**
 * Displays recipe cross reference meta box.
 */
function wp_recipe_display_recipe_cross_reference_meta_box() {

    global $post;

    $recipe_references = WP_Recipe_Cross_Reference_Recipes::get_instance();

    $recipe_references_meta = get_post_meta( $post->ID, $recipe_references->get_meta_slug() );

    $html = '';
    $html .= '<section class="' . $recipe_references->get_slug() . '">';
        $html .= '<p>Below are a list of recipes who are referenced in this post.</p>';

        if ( empty( $recipe_references_meta ) ) {

            $html .= '<p class="empty">No recipes referenced in post.</p>';

        } else {

            $html .= '<ul>';

            foreach ( $recipe_references_meta as $recipe_id ) {

                $html .= '<li>';
                    $html .= '<a href="' . get_edit_post_link( $recipe_id ) . '">' . get_the_title( $recipe_id ) . '</a>' ;
                $html .= '</li>';

            }

            $html .= '</ul>';

        }

    $html .= '</section>';

    echo $html;

}