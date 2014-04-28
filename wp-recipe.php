<?php
/**
 * Add recipes to WordPress.
 *
 * @package WP_Recipe
 * @author Michael Novotny <manovotny@gmail.com>
 * @license GPL-3.0+
 * @link https://github.com/manovotny/wp-recipe
 * @copyright 2014 Michael Novotny
 *
 * @wordpress-plugin
 * Plugin Name: WP Recipe
 * Plugin URI: https://github.com/manovotny/wp-recipe
 * Description: Add recipes to WordPress.
 * Version: 0.4.0
 * Author: Michael Novotny
 * Author URI: http://manovotny.com
 * License: GPL-3.0+
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 * GitHub Plugin URI: https://github.com/manovotny/wp-recipe
 */


/*
/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ CONTENTS /\/\/\/\/\/\/\/\/\/\/\/\/\/\//\/\/\/\/\

    1. Access
    2. Includes
    3. Plugin

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

if ( ! class_exists( 'WP_Recipe_Post_Type' ) ) {

    require_once __DIR__ . '/classes/class-wp-recipe-post-type.php';

    add_action( 'plugins_loaded', array( 'WP_Recipe_Post_Type', 'get_instance' ) );
}

if ( ! class_exists( 'WP_Recipe_Shortcode' ) ) {

    require_once __DIR__ . '/classes/class-wp-recipe-shortcode.php';

    add_action( 'plugins_loaded', array( 'WP_Recipe_Shortcode', 'get_instance' ) );

}

if ( ! class_exists( 'WP_Recipe_Taxonomies' ) ) {

    require_once __DIR__ . '/classes/class-wp-recipe-taxonomies.php';

    add_action( 'plugins_loaded', array( 'WP_Recipe_Taxonomies', 'get_instance' ) );

}