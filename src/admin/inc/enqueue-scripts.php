<?php

add_action( 'admin_enqueue_scripts', 'wp_recipe_post_type_scripts' );

/**
 * Loads editor scripts.
 */
function wp_recipe_post_type_scripts() {

    wp_enqueue_script( 'jquery-ui-sortable' );

    $wp_enqueue_util = WP_Enqueue_Util::get_instance();
    $wp_recipe = WP_Recipe::get_instance();
    $wp_recipe_ingredients = WP_Recipe_Ingredients::get_instance();
    $wp_recipe_ingredients_group = WP_Recipe_Ingredients_Group::get_instance();

    $handle = $wp_recipe->get_slug() . '-admin-script';
    $relative_path = __DIR__ . '/../js/';
    $filename = 'bundle.min.js';
    $filename_debug = 'bundle.concat.js';
    $dependencies = array( 'underscore' );

    $group_keys = $wp_recipe_ingredients_group->get_keys();

    $new_group = array(
        $group_keys[ 'group' ] => ''
    );

    $data = array(
        'ingredient' => array(
            'classes' => $wp_recipe_ingredients->get_classes(),
            'group' => array(
                'classes' => $wp_recipe_ingredients_group->get_classes(),
                'keys' => $group_keys,
                'markup' => $wp_recipe_ingredients_group->generate_admin_markup( $new_group )
            ),
            'id' => $wp_recipe_ingredients->get_id(),
            'markup' => $wp_recipe_ingredients->generate_admin_markup()
        )
    );

    $options = new WP_Enqueue_Options(
        $handle,
        $relative_path,
        $filename,
        $filename_debug,
        $dependencies,
        $wp_recipe->get_version(),
        true
    );

    $options->set_localization( $wp_recipe->get_localization_handle(), $data );

    $wp_enqueue_util->enqueue_script( $options );

}