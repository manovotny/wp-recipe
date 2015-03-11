<?php

class WP_Recipe_Query {

    /* Properties
    ---------------------------------------------------------------------------------- */

    /* Instance
    ---------------------------------------------- */

    /**
     * Instance of the class.
     *
     * @var WP_Recipe_Query
     */
    protected static $instance = null;

    /**
     * Get accessor method for instance property.
     *
     * @return WP_Recipe_Query Instance of the class.
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

        add_action( 'pre_get_posts', array( $this, 'add_recipe_query_hook' ) );

    }

    /* Methods
    ---------------------------------------------------------------------------------- */

    /**
     * Adds hook to modify the recipe query.
     *
     * @param $query WP_Query The pre recipe query.
     */
    function add_recipe_query_hook( $query ) {

        $wp_recipe_taxonomies = WP_Recipe_Taxonomies::get_instance();

        if ( ( $query->is_main_query() ) && $wp_recipe_taxonomies->is_recipe_taxonomy() ) {

            apply_filters( 'wp_recipe_query', $query );

        }

    }

}
