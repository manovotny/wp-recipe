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

        $style = 'recipe-post-type.min.css';

        if ( defined( 'SCRIPT_DEBUG' ) && true === SCRIPT_DEBUG ) {

            $style = 'recipe-post-type.css';

        }

        $path = WP_File_Util::get_instance()->get_absolute_path( __DIR__, '../../admin/css/' . $style );
        $url = WP_URL_Util::get_instance()->convert_path_to_url( $path );

        wp_enqueue_style( 'wp-recipe-editor-styles', $url, null, $wp_recipe->get_version() );

    }

}