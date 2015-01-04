<?php

class WP_Recipe {

    /* Properties
    ---------------------------------------------------------------------------------- */

    /* Actions
    ---------------------------------------------- */

    /**
     * Gets recipe actions.
     *
     * @return array List of recipe actions.
     */
    public function get_actions() {

        $action_prefix = $this->get_localization_handle() . '_';

        $after_recipe = 'after_recipe';

        return array(
            $after_recipe => $action_prefix . $after_recipe
        );

    }

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

    /* Localization Handle
    ---------------------------------------------- */

    /**
     * Getter method for localization handle.
     *
     * @return string Localization handle.
     */
    public function get_localization_handle() {

        return str_replace( '-', '_', $this->slug );

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
     * Getter method for shortcode.
     *
     * @return string Recipe shortcode.
     */
    public function get_shortcode() {

        return str_replace( '-', '', $this->slug );

    }

    /* Slug
    ---------------------------------------------- */

    /**
     * Recipe slug.
     *
     * @var string
     */
    protected $slug = 'wp-recipe';

    /**
     * Getter method for slug.
     *
     * @return string Recipe slug.
     */
    public function get_slug() {

        return $this->slug;

    }

    /* Version
    ---------------------------------------------- */

    /**
     * Plugin version, used for cache-busting of style and script file references.
     *
     * @var string
     */
    protected $version = '1.6.2';

    /**
     * Getter method for version.
     *
     * @return string Plugin version.
     */
    public function get_version() {

        return $this->version;

    }

    /* Constructor
    ---------------------------------------------------------------------------------- */

    /**
     * Initialize class.
     */
    public function __construct() {

        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

    }

    /* Methods
    ---------------------------------------------------------------------------------- */

    /**
     * Enqueues scripts.
     */
    public function enqueue_scripts() {

        wp_enqueue_script( 'underscore' );

    }

}
