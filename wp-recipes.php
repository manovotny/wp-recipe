<?php
/**
 * Add recipes to WordPress.
 *
 * @package WP_Recipes
 * @author Michael Novotny <manovotny@gmail.com>
 * @license GPL-3.0+
 * @link https://github.com/manovotny/wp-recipes
 * @copyright 2014 Michael Novotny
 *
 * @wordpress-plugin
 * Plugin Name: WP Recipes
 * Plugin URI: https://github.com/manovotny/wp-recipes
 * Description: Add recipes to WordPress.
 * Version: 0.3.0
 * Author: Michael Novotny
 * Author URI: http://manovotny.com
 * License: GPL-3.0+
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 * GitHub Plugin URI: https://github.com/manovotny/wp-recipes
 */


/*
/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ CONTENTS /\/\/\/\/\/\/\/\/\/\/\/\/\/\//\/\/\/\/\

    1. Access
    2. Includes
    3. Plugin
    4. Updates

/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\//\/\/\/\/\/\/\/\/\/\
*/

/* Access
---------------------------------------------------------------------------------- */

if ( ! defined( 'WPINC' ) ) {

    die;

}

/* Includes
---------------------------------------------------------------------------------- */

require_once __DIR__ . '/inc/wp-taxonomy-util/wp-taxonomy-util.php';

/* Plugin
---------------------------------------------------------------------------------- */

if ( ! class_exists( 'WP_Recipes_Post_Type' ) ) {

    require_once __DIR__ . '/classes/class-wp-recipes-post-type.php';

    add_action( 'plugins_loaded', array( 'WP_Recipes_Post_Type', 'get_instance' ) );
}

if ( ! class_exists( 'WP_Recipes_Shortcode' ) ) {

    require_once __DIR__ . '/classes/class-wp-recipes-shortcode.php';

    add_action( 'plugins_loaded', array( 'WP_Recipes_Shortcode', 'get_instance' ) );

}

if ( ! class_exists( 'WP_Recipes_Taxonomies' ) ) {

    require_once __DIR__ . '/classes/class-wp-recipes-taxonomies.php';

    add_action( 'plugins_loaded', array( 'WP_Recipes_Taxonomies', 'get_instance' ) );

}

/* Updates
---------------------------------------------------------------------------------- */

/**
 * Disables WordPress.org plugin update for WP Recipe.
 *
 * @param stdClass $plugins List of plugins checked for updates and ones that need updating.
 * @return mixed Filtered list of plugins checked for updates and ones that need updating.
 */
function wp_recipe_disable_wordpress_org_plugin_update( $plugins ) {

    $plugin_directory = trailingslashit( basename( dirname( __FILE__ ) ) );
    $plugin_filename = basename( __FILE__ );

    unset( $plugins->response[ $plugin_directory . $plugin_filename ] );

    return $plugins;

}

add_filter( 'site_transient_update_plugins', 'wp_recipe_disable_wordpress_org_plugin_update' );