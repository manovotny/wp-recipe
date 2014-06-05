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

    $wp_recipe = WP_Recipe::get_instance();

    if ( $wp_recipe->is_wp_recipe_add_or_edit_screen() ) {

        $path = WP_File_Util::get_instance()->get_absolute_path( __DIR__, '../../admin/js/recipe-editor.js' );
        $url = WP_URL_Util::get_instance()->convert_path_to_url( $path );

        wp_enqueue_script( 'wp-recipe-editor-script', $url, null, $wp_recipe->get_version(), true );

    }

}