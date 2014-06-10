<?php
/**
 * A lovely collection of post type utilities for WordPress.
 *
 * @package WP_Post_Type_Util
 * @author Michael Novotny <manovotny@gmail.com>
 * @license GPL-3.0+
 * @link https://github.com/manovotny/wp-post-type-util
 * @copyright 2014 Michael Novotny
 *
 * @wordpress-plugin
 * Plugin Name: WP Post Type Util
 * Plugin URI: https://github.com/manovotny/wp-post-type-util
 * Description: A lovely collection of post type utilities for WordPress.
 * Version: 0.3.0
 * Author: Michael Novotny
 * Author URI: http://manovotny.com
 * License: GPL-3.0+
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 * GitHub Plugin URI: https://github.com/manovotny/wp-post-type-util
 */

/* Access
---------------------------------------------------------------------------------- */

if ( ! defined( 'WPINC' ) ) {

    die;

}

/* Classes
---------------------------------------------------------------------------------- */

if ( ! class_exists( 'WP_Post_Type_Util' ) ) {

    require_once __DIR__ . '/classes/class-wp-post-type-util.php';

}