<?php
/**
 * @package WP_Recipe
 * @author Michael Novotny <manovotny@gmail.com>
 */

add_action( 'add_meta_boxes_recipe', 'wp_recipe_add_ingredients_meta_box' );
add_action( 'save_post_' . WP_Recipe::get_instance()->get_post_type(), 'wp_recipe_save_ingredients_meta_box' );

/**
 * Adds ingredients meta box.
 */
function wp_recipe_add_ingredients_meta_box() {

    $wp_recipe = WP_Recipe::get_instance();
    $wp_recipe_ingredients = WP_Recipe_Ingredients::get_instance();

    add_meta_box(
        $wp_recipe_ingredients->get_slug(),
        'Ingredients',
        'wp_recipe_display_ingredients_meta_box',
        $wp_recipe->get_post_type(),
        'normal',
        'high'
    );

}

/**
 * Displays ingredients meta box.
 */
function wp_recipe_display_ingredients_meta_box() {

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

}

/**
 * Saves ingredients.
 *
 * @param string $post_id Post id.
 */
function wp_recipe_save_ingredients_meta_box( $post_id ) {

    $wp_post_type_util = WP_Post_Type_Util::get_instance();
    $wp_recipe = WP_Recipe::get_instance();

    if ( ! $wp_post_type_util->is_post_type_saving_post_meta( $wp_recipe->get_post_type() ) ) {

        return;

    }

    $wp_recipe_ingredients = WP_Recipe_Ingredients::get_instance();

    if ( $wp_post_type_util->can_save_post_meta( $post_id, $wp_recipe_ingredients->get_slug(), $wp_recipe_ingredients->get_nonce() ) ) {

        update_post_meta( $post_id, $wp_recipe_ingredients->get_meta_slug(), $_POST[ $wp_recipe_ingredients->get_id() ] );

    }

}