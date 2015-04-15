<?php

class WP_Recipe_Enqueue_Admin_Styles {

    /* Properties
    ---------------------------------------------------------------------------------- */

    /**
     * Instance of the class.
     *
     * @var WP_Recipe_Enqueue_Admin_Styles
     */
    protected static $instance = null;

    /* Constructor
    ---------------------------------------------------------------------------------- */

    /**
     * Initialize class.
     */
    public function __construct() {

        add_action( 'admin_enqueue_scripts', array( $this, '__enqueue_styles' ) );

    }

    /* Public
    ---------------------------------------------------------------------------------- */

    /**
     * Gets instance of class.
     *
     * @return WP_Recipe_Enqueue_Admin_Styles Instance of the class.
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

        $wp_post_type_util = WP_Post_Type_Util::get_instance();
        $wp_recipe = WP_Recipe::get_instance();

        $post_type = WP_Recipe_Post_Type::get_instance()->get_post_type();

        if ( $wp_post_type_util->is_post_type_add_or_edit_screen( $post_type ) ) {

            $wp_enqueue_util = WP_Enqueue_Util::get_instance();

            $handle = $wp_recipe->get_slug() . '-admin-styles';
            $relative_path = __DIR__ . '/../admin/css/';
            $filename = 'recipe-post-type.min.css';
            $filename_debug = 'recipe-post-type.css';
            $dependencies = array();

            $options = new WP_Enqueue_Options(
                $handle,
                $relative_path,
                $filename,
                $filename_debug,
                $dependencies,
                $wp_recipe->get_version()
            );

            $wp_enqueue_util->enqueue_style( $options );

        }

    }

}
