<?php

add_action( 'admin_menu', 'wp_recipe_remove_default_discussion_meta_box' );

/**
 * Removes discussion meta box from recipe post type.
 */
function wp_recipe_remove_default_discussion_meta_box() {

    remove_meta_box( 'commentstatusdiv', WP_Recipe::get_instance()->get_post_type(), 'advanced' );

}