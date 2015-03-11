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

    /* Taxonomies
    ---------------------------------------------- */

    /**
     * Getter method for recipe taxonomies.
     *
     * @return array Recipe taxonomies.
     */
    public function get_taxonomies() {

        return array(
            WP_Recipe_Cooking_Methods_Taxonomy::get_instance()->get_slug(),
            WP_Recipe_Courses_Taxonomy::get_instance()->get_slug(),
            WP_Recipe_Cuisines_Taxonomy::get_instance()->get_slug(),
            WP_Recipe_Diets_Taxonomy::get_instance()->get_slug(),
            WP_Recipe_Ingredients_Taxonomy::get_instance()->get_slug(),
            WP_Recipe_Occasions_Taxonomy::get_instance()->get_slug()
        );

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
     * Determines if a recipe taxonomy is being used.
     *
     * @return boolean Whether a recipe taxonomy is being used or not.
     */
    public function is_recipe_taxonomy() {

        return (
            is_tax( WP_Recipe_Cooking_Methods_Taxonomy::get_instance()->get_slug() )
            || is_tax( WP_Recipe_Courses_Taxonomy::get_instance()->get_slug() )
            || is_tax( WP_Recipe_Cuisines_Taxonomy::get_instance()->get_slug() )
            || is_tax( WP_Recipe_Diets_Taxonomy::get_instance()->get_slug() )
            || is_tax( WP_Recipe_Ingredients_Taxonomy::get_instance()->get_slug() )
            || is_tax( WP_Recipe_Occasions_Taxonomy::get_instance()->get_slug() )
        );

    }

    /**
     * Registers taxonomies.
     */
    public function register_taxonomies() {

        $taxonomies_options = array(
            WP_Recipe_Cooking_Methods_Taxonomy::get_instance()->get_taxonomy_options(),
            WP_Recipe_Courses_Taxonomy::get_instance()->get_taxonomy_options(),
            WP_Recipe_Cuisines_Taxonomy::get_instance()->get_taxonomy_options(),
            WP_Recipe_Diets_Taxonomy::get_instance()->get_taxonomy_options(),
            WP_Recipe_Ingredients_Taxonomy::get_instance()->get_taxonomy_options(),
            WP_Recipe_Occasions_Taxonomy::get_instance()->get_taxonomy_options()
        );

        WP_Taxonomy_Util::get_instance()->create_taxonomies( $taxonomies_options );

    }

}
