<?php

class WP_Recipe_Search_Results {

    /* Properties
    ---------------------------------------------------------------------------------- */

    /**
     * Instance of the class.
     *
     * @var WP_Recipe_Search_Results
     */
    protected static $instance = null;

    /* Constructor
    ---------------------------------------------------------------------------------- */

    /**
     * Initialize class.
     */
    public function __construct() {

        add_action( 'pre_get_posts', array( $this, '__filter' ) );

    }

    /* Public
    ---------------------------------------------------------------------------------- */

    /**
     * Gets instance of class.
     *
     * @return WP_Recipe_Search_Results Instance of the class.
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
     * Filters recipe query.
     *
     * @param $query WP_Query The pre recipe query.
     */
    function __filter( $query ) {

        if ( $query->is_search()  && $query->is_main_query() ) {

            $query->set( 'post_type', 'post' );

        }

    }

}
