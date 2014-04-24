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
 * Version: 0.2.0
 * Author: Michael Novotny
 * Author URI: http://manovotny.com
 * License: GPL-3.0+
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 * GitHub Plugin URI: https://github.com/manovotny/wp-recipes
 */


/*
/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ CONTENTS /\/\/\/\/\/\/\/\/\/\/\/\/\/\//\/\/\/\/\

    1. Access
    2. Plugin
    3. Updates

/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\//\/\/\/\/\/\/\/\/\/\
*/

/* Access
---------------------------------------------------------------------------------- */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {

    die;

} // end if

/* Plugin
---------------------------------------------------------------------------------- */

// Include plugin classes.
require_once __DIR__ . '/classes/class-wp-recipes.php';

// Load plugin.
add_action( 'plugins_loaded', array( 'WP_Recipes', 'get_instance' ) );

/* Updates
---------------------------------------------------------------------------------- */

add_filter( 'site_transient_update_plugins', 'wp_recipe_disable_wordpress_org_plugin_update' );

function wp_recipe_disable_wordpress_org_plugin_update( $value ) {

    $plugin_directory = trailingslashit( basename( dirname( __FILE__ ) ) );
    $plugin_filename = basename( __FILE__ );

    unset( $value->response[ $plugin_directory . $plugin_filename ] );

    return $value;

}