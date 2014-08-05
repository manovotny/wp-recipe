<?php
/**
 * @package WP_Recipe
 */

global $post;

$wp_recipe_ingredients = WP_Recipe_Ingredients::get_instance();
$wp_recipe_ingredients_group = WP_Recipe_Ingredients_Group::get_instance();

wp_nonce_field( $wp_recipe_ingredients->get_slug(), $wp_recipe_ingredients->get_nonce() );

$ingredients = maybe_unserialize( get_post_meta( $post->ID, $wp_recipe_ingredients->get_meta_slug(), true ) );
$ingredients_classes = $wp_recipe_ingredients->get_classes();
$ingredients_group_classes = $wp_recipe_ingredients_group->get_classes();

$html = '';

$html .= '<fieldset class="' . $wp_recipe_ingredients->get_slug() . '">';
    $html .= '<section class="toolbar">';
        $html .= '<ul class="actions">';
            $html .= '<li class="action-item">';
                $html .= '<button class="' . $ingredients_classes[ 'add' ] . ' button">Add Ingredient</button>';
            $html .= '</li>';
            $html .= '<li class="action-item">';
                $html .= '<button class="' . $ingredients_group_classes[ 'add' ] . ' button">Add Group</button>';
            $html .= '</li>';
        $html .= '</ul>';
    $html .= '</section>';
    $html .= '<div class="editor">';
        $html .= '<ul class="list ' . $ingredients_classes[ 'list' ] . '">';

            if ( ! empty( $ingredients ) ) {

                foreach ( $ingredients as $item ) {

                    if ( is_array( $item ) ) {

                        $html .= $wp_recipe_ingredients_group->generate_admin_markup( $item );

                    } else {

                        $html .= $wp_recipe_ingredients->generate_admin_markup( $item );

                    }

                }

            }

        $html .= '</ul>';
    $html .= '</div>';
$html .= '</fieldset>';

echo $html;