<?php
/**
 * @package WP_Recipe
 */

class WP_Recipe_Id {

    /* Properties
    ---------------------------------------------------------------------------------- */

    /* Instance
    ---------------------------------------------- */

    /**
     * Instance of the class.
     *
     * @var WP_Recipe_Id
     */
    protected static $instance = null;

    /**
     * Get accessor method for instance property.
     *
     * @return WP_Recipe_Id Instance of the class.
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
     * Recipe id slug.
     *
     * @var string
     */
    protected $slug = 'wp-recipe-id';

    /**
     * Getter method for id.
     *
     * @return string Recipe id slug.
     */
    public function get_slug() {

        return $this->slug;

    }

}
