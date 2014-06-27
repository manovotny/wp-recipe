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

/* Support
---------------------------------------------------------------------------------- */

wp_enqueue_script( 'underscore' );

/* Library
---------------------------------------------------------------------------------- */

require_once __DIR__ . '/lib/wp-array-util/wp-array-util.php';
require_once __DIR__ . '/lib/wp-file-util/wp-file-util.php';
require_once __DIR__ . '/lib/wp-post-type-util/wp-post-type-util.php';
require_once __DIR__ . '/lib/wp-taxonomy-util/wp-taxonomy-util.php';
require_once __DIR__ . '/lib/wp-url-util/wp-url-util.php';

/* Classes
---------------------------------------------------------------------------------- */

require_once __DIR__ . '/classes/class-wp-recipe.php';
require_once __DIR__ . '/classes/class-wp-recipe-description.php';
require_once __DIR__ . '/classes/class-wp-recipe-directions.php';
require_once __DIR__ . '/classes/class-wp-recipe-ingredients.php';
require_once __DIR__ . '/classes/class-wp-recipe-tips.php';
require_once __DIR__ . '/classes/class-wp-recipe-yield.php';

/* Admin
---------------------------------------------------------------------------------- */

require_once __DIR__ . '/admin/inc/post-type-columns.php';

/* Includes
---------------------------------------------------------------------------------- */

require_once __DIR__ . '/inc/post-type.php';
require_once __DIR__ . '/inc/shortcode.php';
require_once __DIR__ . '/inc/taxonomies.php';
require_once __DIR__ . '/inc/meta-boxes/description.php';
require_once __DIR__ . '/inc/meta-boxes/yield.php';
require_once __DIR__ . '/inc/meta-boxes/ingredients.php';
require_once __DIR__ . '/inc/meta-boxes/directions.php';
require_once __DIR__ . '/inc/meta-boxes/tips.php';
require_once __DIR__ . '/inc/remove/default-editor.php';
require_once __DIR__ . '/inc/remove/default-discussion-meta-box.php';
require_once __DIR__ . '/inc/scripts/recipe-editor.php';
require_once __DIR__ . '/inc/styles/recipe-editor.php';