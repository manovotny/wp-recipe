<?php

class WP_Recipe_Taxonomies {

    /* Properties
    ---------------------------------------------------------------------------------- */

    /* Instance
    ---------------------------------------------- */

    /**
     * Instance of the class.
     *
     * @var WP_Recipe_Taxonomies
     */
    protected static $instance = null;

    /**
     * Get accessor method for instance property.
     *
     * @return WP_Recipe_Taxonomies Instance of the class.
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

        add_action( 'init', array( $this, 'register_taxonomies' ) );

    }

    /* Methods
    ---------------------------------------------------------------------------------- */

    /**
     * Registers taxonomies.
     */
    public function register_taxonomies() {

        $taxonomies = array(
            WP_Recipe_Cooking_Methods_Taxonomy::get_instance()->get_taxonomy_options(),
            WP_Recipe_Courses_Taxonomy::get_instance()->get_taxonomy_options(),
            WP_Recipe_Cuisines_Taxonomy::get_instance()->get_taxonomy_options(),
            WP_Recipe_Diets_Taxonomy::get_instance()->get_taxonomy_options(),
            WP_Recipe_Ingredients_Taxonomy::get_instance()->get_taxonomy_options(),
            WP_Recipe_Occasions_Taxonomy::get_instance()->get_taxonomy_options()
        );

        WP_Taxonomy_Util::get_instance()->create_taxonomies( $taxonomies );

    }

}
