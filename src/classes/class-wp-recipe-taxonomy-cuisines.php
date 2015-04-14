<?php

class WP_Recipe_Cuisines_Taxonomy {

    /* Properties
    ---------------------------------------------------------------------------------- */

    /* Instance
    ---------------------------------------------- */

    /**
     * Instance of the class.
     *
     * @var WP_Recipe_Cuisines_Taxonomy
     */
    protected static $instance = null;

    /**
     * Get accessor method for instance property.
     *
     * @return WP_Recipe_Cuisines_Taxonomy Instance of the class.
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
     * Recipe cuisines taxonomy slug.
     *
     * @var string
     */
    protected $slug = 'cuisines';

    /**
     * Getter method for slug.
     *
     * @return string Recipe cuisines taxonomy slug.
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
            __( 'Cuisine', $wp_recipe->get_slug() ),
            __( 'Cuisines', $wp_recipe->get_slug() ),
            $this->get_slug(),
            WP_Recipe_Post_Type::get_instance()->get_post_type()
        );

    }

}
