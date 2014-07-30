<?php
/**
 * @package WP_Recipe
 */

add_action( 'add_meta_boxes_recipe', 'wp_recipe_add_posts_using_recipe_meta_box' );

/**
 * Adds XXXXXX meta box.
 */
function wp_recipe_add_posts_using_recipe_meta_box() {

    $wp_recipe = WP_Recipe::get_instance();

    add_meta_box(
        'wp-recipe-posts-using-recipe',
        'Posts Using Recipe',
        'wp_recipe_display_posts_using_recipe_meta_box',
        $wp_recipe->get_post_type(),
        'normal',
        'high'
    );

}

/**
 * Displays XXXXXX meta box.
 */
function wp_recipe_display_posts_using_recipe_meta_box() {

    global $post;

    $posts_using_recipe = get_post_meta( $post->ID, 'wp-recipe-posts-using-recipe' );

    $html = '';
    $html .= '<section class="' . 'wp-recipe-posts-using-recipe' . '">';

        if ( empty( $posts_using_recipe ) ) {

            $html .= '<p>No posts are using this recipe.</p>';

        } else {

            $html .= '<ul>';

            foreach ( $posts_using_recipe as $post_id ) {

                $html .= '<li>';
                    $html .= '<a href="' . get_edit_post_link( $post_id ) . '">' . get_the_title( $post_id ) . '</a>' ;
                $html .= '</li>';

            }

            $html .= '</ul>';

        }

    $html .= '</section>';

    echo $html;

}