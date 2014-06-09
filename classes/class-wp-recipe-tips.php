<?php
/**
 * @package WP_Recipe
 * @author Michael Novotny <manovotny@gmail.com>
 */

class WP_Recipe_Tips {

    /* Properties
    ---------------------------------------------------------------------------------- */

    /* Id
    ---------------------------------------------- */

    /**
     * Getter method for id.
     *
     * @return string Recipe tips id.
     */
    public function get_id() {

        return str_replace( '-', '_', $this->slug );

    }

    /* Instance
    ---------------------------------------------- */

    /**
     * Instance of the class.
     *
     * @var WP_Recipe_Tips
     */
    protected static $instance = null;

    /**
     * Get accessor method for instance property.
     *
     * @return WP_Recipe_Tips Instance of the class.
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
     * @return string Recipe tips nonce.
     */
    public function get_nonce() {

        return $this->slug . '-nonce';

    }

    /* Slug
    ---------------------------------------------- */

    /**
     * Recipe tips slug.
     *
     * @var string
     */
    protected $slug = 'wp-recipe-tips';

    /**
     * Getter method for slug.
     *
     * @return string Recipe tips slug.
     */
    public function get_slug() {

        return $this->slug;

    }

}
