<?php
/**
 * @package WP_Recipe
 * @author Michael Novotny <manovotny@gmail.com>
 */

// Register admin styles.
add_action( 'admin_enqueue_scripts', 'wp_recipe_editor_scripts' );

/**
 * Loads editor scripts.
 */
function wp_recipe_editor_scripts() {

    $wp_post_type_util = WP_Post_Type_Util::get_instance();
    $wp_recipe = WP_Recipe::get_instance();

    if ( $wp_post_type_util->is_post_type_add_or_edit_screen( $wp_recipe->get_post_type() ) ) {

        $path = WP_File_Util::get_instance()->get_absolute_path( __DIR__, '../../admin/js/recipe-editor.js' );
        $url = WP_URL_Util::get_instance()->convert_path_to_url( $path );

        $script_handle = 'wp-recipe-editor-script';

        wp_enqueue_script( $script_handle, $url, null, $wp_recipe->get_version(), true );

        $wp_recipe_ingredients = WP_Recipe_Ingredients::get_instance();

        $data = array(
            'ingredient' => array(
                'classes' => $wp_recipe_ingredients->get_classes(),
                'markup' => $wp_recipe_ingredients->generate_markup()
            )
        );

        wp_localize_script( $script_handle, 'phpData', $data );

    }

}