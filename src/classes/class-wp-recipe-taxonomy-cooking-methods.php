<?php

class WP_Recipe_Cooking_Methods_Taxonomy {

    /* Properties
    ---------------------------------------------------------------------------------- */

    /**
     * Instance of the class.
     *
     * @var WP_Recipe_Cooking_Methods_Taxonomy
     */
    protected static $instance = null;

    /**
     * Recipe cooking method taxonomy slug.
     *
     * @var string
     */
    protected $slug = 'cooking-methods';

    /* Public
    ---------------------------------------------------------------------------------- */

    /**
     * Gets instance of class.
     *
     * @return WP_Recipe_Cooking_Methods_Taxonomy Instance of the class.
     */
    public static function get_instance() {

        if ( null == self::$instance ) {

            self::$instance = new self;

        }

        return self::$instance;

    }

    /**
     * Gets taxonomy slug.
     *
     * @return string Recipe cooking method taxonomy slug.
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
            __( 'Cooking Method', $domain ),
            __( 'Cooking Methods', $domain ),
            $this->get_slug(),
            WP_Recipe_Post_Type::get_instance()->get_post_type()
        );

    }

}
