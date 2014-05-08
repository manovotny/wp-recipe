<?php
/**
 * @package WP_Recipe
 * @author Michael Novotny <manovotny@gmail.com>
 */

// Register admin styles.
add_action( 'admin_enqueue_scripts', 'wp_recipe_admin_styles' );

function wp_recipe_admin_styles() {

    if ( is_wp_recipe_add_or_edit_screen() ) {

        $file = get_file_url( '../admin/css/wp-recipe-editor.css' );

        $version = WP_Recipe::get_instance()->get_version();

        wp_enqueue_style( 'wp-recipe-admin-styles', $file, null, $version );

    }

}

function is_wp_recipe_add_or_edit_screen() {

    $screen = get_current_screen();

    return 'recipe' === $screen->post_type && ( 'add' === $screen->action || 'edit' === $_REQUEST[ 'action' ] );

}

function get_file_url( $relative_path ) {

    $file = realpath( trailingslashit( __DIR__ ) . $relative_path );

    $file = str_replace( WP_CONTENT_DIR, '', $file );

    $file = content_url() . $file;

    return $file;
}