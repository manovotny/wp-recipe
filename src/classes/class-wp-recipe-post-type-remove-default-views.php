<?php

class WP_Recipe_Post_Type_Remove_Default_Views {

    /* Properties
    ---------------------------------------------------------------------------------- */

    /**
     * Instance of the class.
     *
     * @var WP_Recipe_Post_Type_Remove_Default_Views
     */
    protected static $instance = null;

    /* Constructor
    ---------------------------------------------------------------------------------- */

    /**
     * Initialize class.
     */
    public function __construct() {

        add_action( 'admin_menu', array( $this, '__remove' ) );

    }

    /* Public
    ---------------------------------------------------------------------------------- */

    /**
     * Gets instance of class.
     *
     * @return WP_Recipe_Post_Type_Remove_Default_Views Instance of the class.
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
     * Removes view.
     */
    public function __remove() {

        remove_meta_box( 'commentsdiv', WP_Recipe_Post_Type::get_instance()->get_post_type(), 'advanced' );
        remove_meta_box( 'commentstatusdiv', WP_Recipe_Post_Type::get_instance()->get_post_type(), 'advanced' );

        remove_post_type_support( WP_Recipe_Post_Type::get_instance()->get_post_type(), 'editor' );

    }

}
