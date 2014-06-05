<?php
/**
 * @package WP_Recipe
 * @author Michael Novotny <manovotny@gmail.com>
 */

class WP_Recipe {

    /* Properties
    ---------------------------------------------------------------------------------- */

    /* Instance
    ---------------------------------------------- */

    /**
     * Instance of the class.
     *
     * @var WP_Recipe
     */
    protected static $instance = null;

    /**
     * Get accessor method for instance property.
     *
     * @return WP_Recipe Instance of the class.
     */
    public static function get_instance() {

        if ( null == self::$instance ) {

            self::$instance = new self;

        }

        return self::$instance;

    }

    /* Version
    ---------------------------------------------- */

    /**
     * Plugin version, used for cache-busting of style and script file references.
     *
     * @var string
     */
    protected $version = '0.5.0';

    /**
     * Getter method for version.
     *
     * @return string Plugin version.
     */
    public function get_version() {

        return $this->version;

    }

    /* Methods
    ---------------------------------------------------------------------------------- */

    /**
     * Determines if the current screen is the recipe add or edit screen.
     *
     * @return boolean Whether or not the current screen is the recipe add or edit screen.
     */
    public function is_wp_recipe_add_or_edit_screen() {

        $screen = get_current_screen();

        return 'recipe' === $screen->post_type && ( 'add' === $screen->action || ( array_key_exists( 'action', $_REQUEST ) && 'edit' === $_REQUEST[ 'action' ] ) );

    }

}
