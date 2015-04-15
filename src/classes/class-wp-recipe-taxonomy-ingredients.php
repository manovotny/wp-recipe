<?php

class WP_Recipe_Ingredients_Taxonomy {

    /* Properties
    ---------------------------------------------------------------------------------- */

    /**
     * Instance of the class.
     *
     * @var WP_Recipe_Ingredients_Taxonomy
     */
    protected static $instance = null;

    /**
     * Recipe ingredients taxonomy slug.
     *
     * @var string
     */
    protected $slug = 'ingredients';

    /* Public
    ---------------------------------------------------------------------------------- */

    /**
     * Gets instance of class.
     *
     * @return WP_Recipe_Ingredients_Taxonomy Instance of the class.
     */
    public static function get_instance() {

        if ( null == self::$instance ) {

            self::$instance = new self;

        }

        return self::$instance;

    }

    /**
     * Gets slug.
     *
     * @return string Recipe ingredients taxonomy slug.
     */
    public function get_slug() {

        return $this->slug;

    }

    /**
     * Gets taxonomy options.
     */
    public function get_taxonomy_options() {

        $domain = WP_Recipe::get_instance()->get_slug();

        return new WP_Taxonomy_Options(
            __( 'Ingredient', $domain ),
            __( 'Ingredients', $domain ),
            $this->get_slug(),
            WP_Recipe_Post_Type::get_instance()->get_post_type(),
            false
        );

    }

}
