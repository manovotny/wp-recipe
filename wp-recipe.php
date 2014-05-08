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
 * Version: 0.5.0
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

require_once __DIR__ . '/lib/wp-file-util/wp-file-util.php';
require_once __DIR__ . '/lib/wp-taxonomy-util/wp-taxonomy-util.php';
require_once __DIR__ . '/lib/wp-url-util/wp-url-util.php';

/* Classes
---------------------------------------------------------------------------------- */

require_once __DIR__ . '/classes/class-wp-recipe.php';

/* Includes
---------------------------------------------------------------------------------- */

require_once __DIR__ . '/inc/meta-boxes/recipe-description.php';
require_once __DIR__ . '/inc/meta-boxes/recipe-yield.php';
require_once __DIR__ . '/inc/meta-boxes/recipe-ingredients.php';
require_once __DIR__ . '/inc/meta-boxes/recipe-directions.php';
require_once __DIR__ . '/inc/meta-boxes/recipe-tips.php';
require_once __DIR__ . '/inc/recipe-post-type.php';
require_once __DIR__ . '/inc/recipe-shortcode.php';
require_once __DIR__ . '/inc/remove-default-editor.php';
require_once __DIR__ . '/inc/remove-default-discussion-meta-box.php';
require_once __DIR__ . '/inc/recipe-taxonomies.php';
require_once __DIR__ . '/inc/styles-editor.php';