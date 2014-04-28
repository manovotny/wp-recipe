<?php
/**
 * @package WP_Recipe
 * @author Michael Novotny <manovotny@gmail.com>
 */

/*
/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ CONTENTS /\/\/\/\/\/\/\/\/\/\/\/\/\/\//\/\/\/\/\

    1. Properties
    2. Constructor
    3. Taxonomies

/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\//\/\/\/\/\/\/\/\/\/\
*/

class WP_Recipe_Taxonomies {

    /* Properties
    ---------------------------------------------------------------------------------- */

    /* Instance
    ---------------------------------------------- */

    /**
     * Instance of the class.
     *
     * @var mixed
     */
    protected static $instance = null;

    /**
     * Get accessor method for instance property.
     *
     * @return mixed Instance of the class.
     */
    public static function get_instance() {

        // Check if an instance has not been created yet.
        if ( null == self::$instance ) {

            // Set instance of class.
            self::$instance = new self;

        }

        // Return instance.
        return self::$instance;

    }

    /* Constructor
    ---------------------------------------------------------------------------------- */

    /**
     * Initializes plugin.
     */
    private function __construct() {

        // Create taxonomies.
        add_action( 'init', array( $this, 'recipe_taxonomies' ) );

    }

    /* Taxonomies
    ---------------------------------------------------------------------------------- */

    /**
     * Creates recipe taxonomies.
     */
    function recipe_taxonomies() {

        $post_type = 'recipe';

        $taxonomies = array(
            new WP_Taxonomy_Options( 'Cooking Method', 'Cooking Methods', 'cooking-methods', $post_type ),
            new WP_Taxonomy_Options( 'Course', 'Courses', 'courses', $post_type ),
            new WP_Taxonomy_Options( 'Cuisine', 'Cuisines', 'cuisines', $post_type ),
            new WP_Taxonomy_Options( 'Occasion', 'Occasions', 'occasions', $post_type )
        );

        WP_Taxonomy_Util::get_instance()->create_taxonomies( $taxonomies );

    }

}
