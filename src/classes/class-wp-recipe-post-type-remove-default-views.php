<?php

class WP_Recipe_Post_Type_Remove_Default_Views {

    /* Properties
    ---------------------------------------------------------------------------------- */

    /* Instance
    ---------------------------------------------- */

    /**
     * Instance of the class.
     *
     * @var WP_Recipe_Post_Type_Remove_Default_Views
     */
    protected static $instance = null;

    /**
     * Get accessor method for instance property.
     *
     * @return WP_Recipe_Post_Type_Remove_Default_Views Instance of the class.
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

        add_action( 'admin_menu', array( $this, 'remove' ) );

    }

    /* Methods
    ---------------------------------------------------------------------------------- */

    /**
     * Removes discussion meta box from recipe post type.
     */
    public function remove() {

        remove_meta_box( 'commentstatusdiv', WP_Recipe::get_instance()->get_post_type(), 'advanced' );

        remove_post_type_support( WP_Recipe::get_instance()->get_post_type(), 'editor' );

    }

}
