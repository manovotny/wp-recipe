<?php
/**
 * @package WP_Recipe
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

    /* Post Type
    ---------------------------------------------- */

    /**
     * Recipe post type.
     *
     * @var string
     */
    protected $post_type = 'recipe';

    /**
     * Getter method for post type.
     *
     * @return string Recipe post type.
     */
    public function get_post_type() {

        return $this->post_type;

    }

    /* Shortcode
    ---------------------------------------------- */

    /**
     * Recipe shortcode.
     *
     * @var string
     */
    protected $shortcode = 'wprecipe';

    /**
     * Getter method for shortcode.
     *
     * @return string Recipe shortcode.
     */
    public function get_shortcode() {

        return $this->shortcode;

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

}
