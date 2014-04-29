<?php
/**
 * A taxonomy utility for WordPress.
 *
 * @package WP_Taxonomy_Util
 * @author Michael Novotny <manovotny@gmail.com>
 * @license GPL-3.0+
 * @link https://github.com/manovotny/wp-taxonomy-util
 * @copyright 2014 Michael Novotny
 *
 * @wordpress-plugin
 * Plugin Name: WP Taxonomy Util
 * Plugin URI: https://github.com/manovotny/wp-taxonomy-util
 * Description: A taxonomy utility for WordPress.
 * Version: 0.2.1
 * Author: Michael Novotny
 * Author URI: http://manovotny.com
 * License: GPL-3.0+
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 * GitHub Plugin URI: https://github.com/manovotny/wp-taxonomy-util
 */


/*
/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ CONTENTS /\/\/\/\/\/\/\/\/\/\/\/\/\/\//\/\/\/\/\

    1. Access
    2. Plugin

/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\//\/\/\/\/\/\/\/\/\/\
*/

/* Access
---------------------------------------------------------------------------------- */

if ( ! defined( 'WPINC' ) ) {

    die;

}

/* Plugin
---------------------------------------------------------------------------------- */

if ( ! class_exists( 'WP_Taxonomy_Options' ) ) {

    require_once __DIR__ . '/classes/class-wp-taxonomy-options.php';

}

if ( ! class_exists( 'WP_Taxonomy_Util' ) ) {

    require_once __DIR__ . '/classes/class-wp-taxonomy-util.php';

}
