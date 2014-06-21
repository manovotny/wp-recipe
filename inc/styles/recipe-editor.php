<?php
/**
 * @package WP_Recipe
 * @author Michael Novotny <manovotny@gmail.com>
 */

// Register admin styles.
add_action( 'admin_enqueue_scripts', 'wp_recipe_editor_styles' );

/**
 * Loads editor styles.
 */
function wp_recipe_editor_styles() {

    $wp_post_type_util = WP_Post_Type_Util::get_instance();
    $wp_recipe = WP_Recipe::get_instance();

    if ( $wp_post_type_util->is_post_type_add_or_edit_screen( $wp_recipe->get_post_type() ) ) {

        $path = WP_File_Util::get_instance()->get_absolute_path( __DIR__, '../../admin/css/recipe-editor.css' );
        $url = WP_URL_Util::get_instance()->convert_path_to_url( $path );

        wp_enqueue_style( 'wp-recipe-editor-styles', $url, null, $wp_recipe->get_version() );

    }

}