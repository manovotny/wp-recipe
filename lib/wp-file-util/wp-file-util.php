<?php
/**
 * A file utility for WordPress.
 *
 * @package WP_File_Util
 * @author Michael Novotny <manovotny@gmail.com>
 * @license GPL-3.0+
 * @link https://github.com/manovotny/wp-file-util
 * @copyright 2014 Michael Novotny
 *
 * @wordpress-plugin
 * Plugin Name: WP File Util
 * Plugin URI: https://github.com/manovotny/wp-file-util
 * Description: A file utility for WordPress.
 * Version: 0.1.1
 * Author: Michael Novotny
 * Author URI: http://manovotny.com
 * License: GPL-3.0+
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 * GitHub Plugin URI: https://github.com/manovotny/wp-file-util
 */


/* Access
---------------------------------------------------------------------------------- */

if ( ! defined( 'WPINC' ) ) {

    die;

}

/* Plugin
---------------------------------------------------------------------------------- */

if ( ! class_exists( 'WP_File_Util' ) ) {

    require_once __DIR__ . '/classes/class-wp-file-util.php';

}
