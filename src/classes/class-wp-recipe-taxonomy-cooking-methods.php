<?php

class WP_Recipe_Cooking_Methods_Taxonomy {

    /* Properties
    ---------------------------------------------------------------------------------- */

    /* Instance
    ---------------------------------------------- */

    /**
     * Instance of the class.
     *
     * @var WP_Recipe_Cooking_Methods_Taxonomy
     */
    protected static $instance = null;

    /**
     * Get accessor method for instance property.
     *
     * @return WP_Recipe_Cooking_Methods_Taxonomy Instance of the class.
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
     * Recipe cooking method taxonomy slug.
     *
     * @var string
     */
    protected $slug = 'cooking-method';

    /**
     * Getter method for slug.
     *
     * @return string Recipe cooking method taxonomy slug.
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
            __( 'Cooking Method', $wp_recipe->get_slug() ),
            __( 'Cooking Methods', $wp_recipe->get_slug() ),
            $this->get_slug(),
            'recipe'
        );

    }

}
