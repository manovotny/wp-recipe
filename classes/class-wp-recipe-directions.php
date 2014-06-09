<?php
/**
 * @package WP_Recipe
 * @author Michael Novotny <manovotny@gmail.com>
 */

class WP_Recipe_Directions {

    /* Properties
    ---------------------------------------------------------------------------------- */

    /* Id
    ---------------------------------------------- */

    /**
     * Getter method for id.
     *
     * @return string Recipe directions id.
     */
    public function get_id() {

        return str_replace( '-', '_', $this->slug );

    }

    /* Instance
    ---------------------------------------------- */

    /**
     * Instance of the class.
     *
     * @var WP_Recipe_Directions
     */
    protected static $instance = null;

    /**
     * Get accessor method for instance property.
     *
     * @return WP_Recipe_Directions Instance of the class.
     */
    public static function get_instance() {

        if ( null == self::$instance ) {

            self::$instance = new self;

        }

        return self::$instance;

    }

    /* Nonce
    ---------------------------------------------- */

    /**
     * Getter method for nonce.
     *
     * @return string Recipe directions nonce.
     */
    public function get_nonce() {

        return $this->slug . '-nonce';

    }

    /* Slug
    ---------------------------------------------- */

    /**
     * Recipe directions slug.
     *
     * @var string
     */
    protected $slug = 'wp-recipe-directions';

    /**
     * Getter method for slug.
     *
     * @return string Recipe directions slug.
     */
    public function get_slug() {

        return $this->slug;

    }

}
