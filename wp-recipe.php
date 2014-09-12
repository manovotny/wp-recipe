<?php
/**
 * @package WP_Recipe
 *
 * @wordpress-plugin
 * Plugin Name: WP Recipe
 * Plugin URI: https://github.com/manovotny/wp-recipe
 * Description: Add recipes to WordPress.
 * Version: 0.6.2
 * Author: Michael Novotny
 * Author URI: http://manovotny.com
 * License: GPL-3.0+
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 * Domain Path: /lang
 * Text Domain: wp-recipe
 * GitHub Plugin URI: https://github.com/manovotny/wp-recipe
 */

/* Access
---------------------------------------------------------------------------------- */

if ( ! defined( 'WPINC' ) ) {

    die;

}

/* Libraries
---------------------------------------------------------------------------------- */

require_once __DIR__ . '/lib/wp-array-util/wp-array-util.php';
require_once __DIR__ . '/lib/wp-enqueue-util/wp-enqueue-util.php';
require_once __DIR__ . '/lib/wp-file-util/wp-file-util.php';
require_once __DIR__ . '/lib/wp-post-type-util/wp-post-type-util.php';
require_once __DIR__ . '/lib/wp-taxonomy-util/wp-taxonomy-util.php';
require_once __DIR__ . '/lib/wp-url-util/wp-url-util.php';

/* Classes
---------------------------------------------------------------------------------- */

if ( ! class_exists( 'WP_Recipe' ) ) {

    require_once __DIR__ . '/classes/class-wp-recipe.php';

    WP_Recipe::get_instance();

}

require_once __DIR__ . '/classes/class-wp-recipe-cross-reference-posts.php';
require_once __DIR__ . '/classes/class-wp-recipe-cross-reference-recipes.php';
require_once __DIR__ . '/classes/class-wp-recipe-description.php';
require_once __DIR__ . '/classes/class-wp-recipe-directions.php';
require_once __DIR__ . '/classes/class-wp-recipe-id.php';
require_once __DIR__ . '/classes/class-wp-recipe-ingredients.php';
require_once __DIR__ . '/classes/class-wp-recipe-ingredients-group.php';
require_once __DIR__ . '/classes/class-wp-recipe-tips.php';
require_once __DIR__ . '/classes/class-wp-recipe-yield.php';

/* Admin
---------------------------------------------------------------------------------- */

require_once __DIR__ . '/admin/inc/enqueue-scripts.php';
require_once __DIR__ . '/admin/inc/enqueue-styles.php';
require_once __DIR__ . '/admin/inc/meta-boxes/cross-reference-posts.php';
require_once __DIR__ . '/admin/inc/meta-boxes/cross-reference-recipes.php';
require_once __DIR__ . '/admin/inc/meta-boxes/description.php';
require_once __DIR__ . '/admin/inc/meta-boxes/directions.php';
require_once __DIR__ . '/admin/inc/meta-boxes/id.php';
require_once __DIR__ . '/admin/inc/meta-boxes/ingredients.php';
require_once __DIR__ . '/admin/inc/meta-boxes/tips.php';
require_once __DIR__ . '/admin/inc/meta-boxes/yield.php';
require_once __DIR__ . '/admin/inc/post-type.php';
require_once __DIR__ . '/admin/inc/post-type-columns.php';
require_once __DIR__ . '/admin/inc/remove-default-discussion-meta-box.php';
require_once __DIR__ . '/admin/inc/remove-default-editor.php';
require_once __DIR__ . '/admin/inc/save-post.php';
require_once __DIR__ . '/admin/inc/shortcode.php';
require_once __DIR__ . '/admin/inc/taxonomies.php';