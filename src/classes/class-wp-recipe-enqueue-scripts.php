<?php

class WP_Recipe_Enqueue_Scripts {

    /* Properties
    ---------------------------------------------------------------------------------- */

    /**
     * Instance of the class.
     *
     * @var WP_Recipe_Enqueue_Scripts
     */
    protected static $instance = null;

    /* Constructor
    ---------------------------------------------------------------------------------- */

    /**
     * Initialize class.
     */
    public function __construct() {

        add_action( 'wp_enqueue_scripts', array( $this, '__enqueue_scripts' ) );

    }

    /* Public
    ---------------------------------------------------------------------------------- */

    /**
     * Gets instance of class.
     *
     * @return WP_Recipe_Enqueue_Scripts Instance of the class.
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
     * Enqueues scripts.
     */
    public function __enqueue_scripts() {

        $this->enqueue_default_scripts();
        $this->enqueue_bundled_scripts();

    }

    /**
     * Enqueues bundled scripts.
     */
    private function enqueue_bundled_scripts() {

        $wp_enqueue_util = WP_Enqueue_Util::get_instance();
        $wp_recipe = WP_Recipe::get_instance();

        $handle = $wp_recipe->get_slug() . '-scripts';
        $relative_path = __DIR__ . '/../site/js/';
        $filename = 'bundle.min.js';
        $filename_debug = 'bundle.concat.js';
        $dependencies = array();
        $version = $wp_recipe->get_version();

        $styles = array(
            $wp_enqueue_util->get_source_to_enqueue( __DIR__ . '/../site/css/', 'wp-recipe-print.min.css', 'wp-recipe-print.css' )
        );
        $styles = apply_filters( 'wp_recipe_enqueue_print_styles', $styles );

        $data = array(
            'print' => array(
                'styles' => $styles
            )
        );

        $options = new WP_Enqueue_Options(
            $handle,
            $relative_path,
            $filename,
            $filename_debug,
            $dependencies,
            $version,
            true
        );

        $localization_name = WP_Recipe_Util::get_instance()->get_id( $wp_recipe->get_slug() );

        $options->set_localization( $localization_name, $data );

        $wp_enqueue_util->enqueue_script( $options );

    }

    /**
     * Enqueues default scripts.
     */
    private function enqueue_default_scripts() {

        wp_enqueue_script( 'underscore' );

    }

}
