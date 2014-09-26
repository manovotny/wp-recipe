<?php
/**
 * @package WP_Recipe
 */

// Register admin styles.
add_action( 'admin_enqueue_scripts', 'wp_recipe_post_type_styles' );

/**
 * Loads editor styles.
 */
function wp_recipe_post_type_styles() {

    $wp_post_type_util = WP_Post_Type_Util::get_instance();
    $wp_recipe = WP_Recipe::get_instance();

    if ( $wp_post_type_util->is_post_type_add_or_edit_screen( $wp_recipe->get_post_type() ) ) {

        $wp_enqueue_util = WP_Enqueue_Util::get_instance();

        $handle = $wp_recipe->get_slug() . '-admin-styles';
        $relative_path = __DIR__ . '/../css/';
        $filename = 'recipe-post-type.min.css';
        $filename_debug = 'recipe-post-type.css';
        $dependencies = array();

        $options = new WP_Enqueue_Options(
            $handle,
            $relative_path,
            $filename,
            $filename_debug,
            $dependencies,
            $wp_recipe->get_version()
        );

        $wp_enqueue_util->enqueue_style( $options );

    }

}