<?php
/**
 * @package WP_Recipe
 */

add_action( 'add_meta_boxes_recipe', 'wp_recipe_add_posts_cross_reference_meta_box' );

/**
 * Adds post cross reference meta box to recipes.
 */
function wp_recipe_add_posts_cross_reference_meta_box() {

    $wp_recipe = WP_Recipe::get_instance();
    $post_references = WP_Recipe_Cross_Reference_Posts::get_instance();

    add_meta_box(
        $post_references->get_slug(),
        'Post Cross References',
        'wp_recipe_display_posts_cross_reference_meta_box',
        $wp_recipe->get_post_type(),
        'normal',
        'high'
    );

}

/**
 * Displays post cross reference meta box.
 */
function wp_recipe_display_posts_cross_reference_meta_box() {

    global $post;

    $post_references = WP_Recipe_Cross_Reference_Posts::get_instance();

    $post_references_meta = get_post_meta( $post->ID, $post_references->get_meta_slug() );

    $html = '';
    $html .= '<section class="' . $post_references->get_slug() . '">';
        $html .= '<p>Below are a list of posts who are referencing this recipe.</p>';

        if ( empty( $post_references_meta ) ) {

            $html .= '<p class="empty">No posts reference this recipe.</p>';

        } else {

            $html .= '<ul>';

            foreach ( $post_references_meta as $post_id ) {

                $html .= '<li>';
                    $html .= '<a href="' . get_edit_post_link( $post_id ) . '">' . get_the_title( $post_id ) . '</a>' ;
                $html .= '</li>';

            }

            $html .= '</ul>';

        }

    $html .= '</section>';

    echo $html;

}