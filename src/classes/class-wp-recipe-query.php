<?php

class WP_Recipe_Query {

    /* Properties
    ---------------------------------------------------------------------------------- */

    /**
     * Instance of the class.
     *
     * @var WP_Recipe_Query
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
     * @return WP_Recipe_Query Instance of the class.
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

        $wp_recipe_taxonomies = WP_Recipe_Taxonomies::get_instance();

        if ( ( $query->is_main_query() ) && $wp_recipe_taxonomies->is_recipe_taxonomy() ) {

            apply_filters( 'wp_recipe_query', $query );

        }

    }

}
