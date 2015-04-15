<?php

class WP_Recipe_Enqueue_Styles {

    /* Properties
    ---------------------------------------------------------------------------------- */

    /**
     * Instance of the class.
     *
     * @var WP_Recipe_Enqueue_Styles
     */
    protected static $instance = null;

    /* Constructor
    ---------------------------------------------------------------------------------- */

    /**
     * Initialize class.
     */
    public function __construct() {

        add_action( 'wp_enqueue_scripts', array( $this, '__enqueue_styles' ) );

    }

    /* Public
    ---------------------------------------------------------------------------------- */

    /**
     * Gets instance of class.
     *
     * @return WP_Recipe_Enqueue_Styles Instance of the class.
     */
    public static function get_instance() {

        if ( null == self::$instance ) {

            self::$instance = new self;

        }

        return self::$instance;

    }

    /* Private
    ---------------------------------------------------------------------------------- */

    /**
     * Enqueues styles.
     */
    public function __enqueue_styles() {

        $wp_enqueue_util = WP_Enqueue_Util::get_instance();
        $wp_recipe = WP_Recipe::get_instance();

        $handle = $wp_recipe->get_slug() . '-styles';
        $relative_path = __DIR__ . '/../site/css/';
        $filename = 'wp-recipe.min.css';
        $filename_debug = 'wp-recipe.css';
        $dependencies = array();
        $version = $wp_recipe->get_version();

        $options = new WP_Enqueue_Options(
            $handle,
            $relative_path,
            $filename,
            $filename_debug,
            $dependencies,
            $version
        );

        $wp_enqueue_util->enqueue_style( $options );

    }

}
