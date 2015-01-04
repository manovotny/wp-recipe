<?php
/**
 * @package WP_Recipe
 *
 * @wordpress-plugin
 * Plugin Name: WP Recipe
 * Plugin URI: https://github.com/manovotny/wp-recipe
 * Description: Add recipes to WordPress.
 * Version: 1.6.1
 * Author: Michael Novotny
 * Author URI: http://manovotny.com
 * License: GPL-3.0+
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 * Domain Path: /lang
 * Text Domain: wp-recipe
 * GitHub Plugin URI: https://github.com/manovotny/wp-recipe
 */

/* Composer
---------------------------------------------------------------------------------- */

if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {

    require_once __DIR__ . '/vendor/autoload.php';

}

/* Initialization
---------------------------------------------------------------------------------- */

require_once __DIR__ . '/src/initialize.php';