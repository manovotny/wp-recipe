<?php
/**
 * A clever array utility for WordPress development.
 *
 * @package WP_Array_Util
 * @author Michael Novotny <manovotny@gmail.com>
 * @license GPL-3.0+
 * @link https://github.com/manovotny/wp-array-util
 * @copyright 2014 Michael Novotny
 *
 * @wordpress-plugin
 * Plugin Name: WP Array Util
 * Plugin URI: https://github.com/manovotny/wp-array-util
 * Description: A clever array utility for WordPress development.
 * Version: 0.1.0
 * Author: Michael Novotny
 * Author URI: http://manovotny.com
 * License: GPL-3.0+
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 * GitHub Plugin URI: https://github.com/manovotny/wp-array-util
 */

/* Access
---------------------------------------------------------------------------------- */

if ( ! defined( 'WPINC' ) ) {

    die;

}

/* Classes
---------------------------------------------------------------------------------- */

if ( ! class_exists( 'WP_Array_Util' ) ) {

    require_once __DIR__ . '/classes/class-wp-array-util.php';

}