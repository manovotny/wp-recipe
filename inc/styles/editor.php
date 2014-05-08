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

    if ( is_wp_recipe_add_or_edit_screen() ) {

        $path = WP_File_Util::get_instance()->get_absolute_path( __DIR__, '../../admin/css/recipe-editor.css' );
        $url = WP_URL_Util::get_instance()->convert_path_to_url( $path );
        $version = WP_Recipe::get_instance()->get_version();

        wp_enqueue_style( 'wp-recipe-editor-styles', $url, null, $version );

    }

}

/**
 * Determines if the current screen is the recipe add or edit screen.
 *
 * @return boolean Whether or not the current screen is the recipe add or edit screen.
 */
function is_wp_recipe_add_or_edit_screen() {

    $screen = get_current_screen();

    return 'recipe' === $screen->post_type && ( 'add' === $screen->action || 'edit' === $_REQUEST[ 'action' ] );

}