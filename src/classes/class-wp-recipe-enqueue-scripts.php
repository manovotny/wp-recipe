<?php

class WP_Recipe_Enqueue_Scripts {

    /* Properties
    ---------------------------------------------------------------------------------- */

    /* Instance
    ---------------------------------------------- */

    /**
     * Instance of the class.
     *
     * @var WP_Recipe_Enqueue_Scripts
     */
    protected static $instance = null;

    /**
     * Get accessor method for instance property.
     *
     * @return WP_Recipe_Enqueue_Scripts Instance of the class.
     */
    public static function get_instance() {

        if ( null == self::$instance ) {

            self::$instance = new self;

        }

        return self::$instance;

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
