<?php
/**
 * @package WP_Recipe
 * @author Michael Novotny <manovotny@gmail.com>
 */

// Register admin styles.
add_action( 'admin_enqueue_scripts', 'wp_recipe_admin_styles' );

function wp_recipe_admin_styles() {

    $wp_file_util = WP_File_Util::get_instance();
    $wp_url_util = WP_URL_Util::get_instance();

    if ( is_wp_recipe_add_or_edit_screen() ) {

        $path = $wp_file_util->get_absolute_path( __DIR__, '../admin/css/wp-recipe-editor.css' );
        $url = $wp_url_util->convert_path_to_url( $path );
        $version = WP_Recipe::get_instance()->get_version();

        wp_enqueue_style( 'wp-recipe-editor-styles', $url, null, $version );

    }

}

function is_wp_recipe_add_or_edit_screen() {

    $screen = get_current_screen();

    return 'recipe' === $screen->post_type && ( 'add' === $screen->action || 'edit' === $_REQUEST[ 'action' ] );

}