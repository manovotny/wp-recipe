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
 * Version: 0.4.1
 * Author: Michael Novotny
 * Author URI: http://manovotny.com
 * License: GPL-3.0+
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 * GitHub Plugin URI: https://github.com/manovotny/wp-recipe
 */

/* Access
---------------------------------------------------------------------------------- */

if ( ! defined( 'WPINC' ) ) {

    die;

}

/* Libraries
---------------------------------------------------------------------------------- */

require_once __DIR__ . '/lib/wp-taxonomy-util/wp-taxonomy-util.php';

/* Includes
---------------------------------------------------------------------------------- */

require_once __DIR__ . '/inc/post-type.php';
require_once __DIR__ . '/inc/shortcode.php';
require_once __DIR__ . '/inc/taxonomies.php';