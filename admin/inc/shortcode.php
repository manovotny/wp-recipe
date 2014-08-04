<?php
/**
 * @package WP_Recipe
 */

add_shortcode( WP_Recipe::get_instance()->get_shortcode(), 'wp_recipe_shortcode' );

/**
 * Renders recipe shortcode.
 *
 * @param array $attributes Shortcode attributes.
 * @return string Rendered shortcode.
 */
function wp_recipe_shortcode( $attributes ) {

    extract(
        shortcode_atts(
            array(
                'id' => ''
            ),
            $attributes
        )
    );

    if ( empty( $id ) ) {

        return '';

    }

    $recipe_post_meta = get_post_meta( $id );

    if ( empty( $recipe_post_meta ) ) {

        return '';

    }

    $wp_recipe_description = WP_Recipe_Description::get_instance();
    $wp_recipe_directions = WP_Recipe_Directions::get_instance();
    $wp_recipe_ingredients = WP_Recipe_Ingredients::get_instance();
    $wp_recipe_ingredients_group = WP_Recipe_Ingredients_Group::get_instance();
    $wp_recipe_tips = WP_Recipe_Tips::get_instance();
    $wp_recipe_yield = WP_Recipe_Yield::get_instance();

    $title = get_the_title( $id );
    $description = $recipe_post_meta[ $wp_recipe_description->get_meta_slug() ][ 0 ];
    $directions = $recipe_post_meta[ $wp_recipe_directions->get_meta_slug() ][ 0 ];
    $ingredients = maybe_unserialize( $recipe_post_meta[ $wp_recipe_ingredients->get_meta_slug() ][ 0 ] );
    $tips = $recipe_post_meta[ $wp_recipe_tips->get_meta_slug() ][ 0 ];
    $yield = $recipe_post_meta[ $wp_recipe_yield->get_meta_slug() ][ 0 ];


    $html = '';
    $html .= '<section class="recipe">';
        $html .= '<h1 class="title">' . $title . '</h1>';
        $html .= '<h2 class="description">' . $description . '</h2>';
        $html .= '<section class="meta">';
            $html .= $yield;
        $html .= '</section>';
        $html .= '<section class="ingredients">';
            $html .= '<h3>Ingredients</h3>';

            if ( ! empty( $ingredients ) ) {

                $html .= '<ul>';

                    foreach ( $ingredients as $item ) {

                        if ( is_array( $item ) ) {

                            $html .= $wp_recipe_ingredients_group->generate_markup( $item );

                        } else {

                            $html .= $wp_recipe_ingredients->generate_markup( $item );

                        }

                    }

                $html .= '</ul>';

            }

        $html .= '</section>';
        $html .= '<section class="directions">';
            $html .= '<h3>Directions</h3>';
            $html .= '<p>' . $directions . '</p>';
        $html .= '</section>';
        $html .= '<section class="tips">';
            $html .= '<h3>Tips</h3>';
            $html .= '<p>' . $tips . '</p>';
        $html .= '</section>';
    $html .= '</section>';

    return $html;

}