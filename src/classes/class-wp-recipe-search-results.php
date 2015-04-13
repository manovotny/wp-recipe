<?php

class WP_Recipe_Search_Results {

    /* Properties
    ---------------------------------------------------------------------------------- */

    /* Instance
    ---------------------------------------------- */

    /**
     * Instance of the class.
     *
     * @var WP_Recipe_Search_Results
     */
    protected static $instance = null;

    /**
     * Get accessor method for instance property.
     *
     * @return WP_Recipe_Search_Results Instance of the class.
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

        add_action( 'pre_get_posts', array( $this, 'exclude_recipes_from_search_results' ) );

    }

    /* Methods
    ---------------------------------------------------------------------------------- */

    /**
     * Adds hook to modify the recipe query.
     *
     * @param $query WP_Query The pre recipe query.
     */
    function exclude_recipes_from_search_results( $query ) {

        if ( $query->is_search()  && $query->is_main_query() ) {

            $query->set( 'post_type', 'post' );

        }

    }

}
