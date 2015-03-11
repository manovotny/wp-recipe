<?php

class WP_Recipe_Diets_Taxonomy {

    /* Properties
    ---------------------------------------------------------------------------------- */

    /* Instance
    ---------------------------------------------- */

    /**
     * Instance of the class.
     *
     * @var WP_Recipe_Diets_Taxonomy
     */
    protected static $instance = null;

    /**
     * Get accessor method for instance property.
     *
     * @return WP_Recipe_Diets_Taxonomy Instance of the class.
     */
    public static function get_instance() {

        if ( null == self::$instance ) {

            self::$instance = new self;

        }

        return self::$instance;

    }

    /* Slug
    ---------------------------------------------- */

    /**
     * Recipe diets taxonomy slug.
     *
     * @var string
     */
    protected $slug = 'diets';

    /**
     * Getter method for slug.
     *
     * @return string Recipe diets slug.
     */
    public function get_slug() {

        return $this->slug;

    }

    /* Methods
    ---------------------------------------------------------------------------------- */

    /**
     * Enqueues scripts.
     */
    public function get_taxonomy_options() {

        $wp_recipe = WP_Recipe::get_instance();

        return new WP_Taxonomy_Options(
            __( 'Diet', $wp_recipe->get_slug() ),
            __( 'Diets', $wp_recipe->get_slug() ),
            $this->get_slug(),
            'recipe'
        );

    }

}
