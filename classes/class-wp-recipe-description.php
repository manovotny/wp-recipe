<?php
/**
 * @package WP_Recipe
 * @author Michael Novotny <manovotny@gmail.com>
 */

class WP_Recipe_Description {

    /* Properties
    ---------------------------------------------------------------------------------- */

    /* Id
    ---------------------------------------------- */

    /**
     * Getter method for id.
     *
     * @return string Recipe description id.
     */
    public function get_id() {

        return str_replace( '-', '_', $this->slug );

    }

    /* Instance
    ---------------------------------------------- */

    /**
     * Instance of the class.
     *
     * @var WP_Recipe_Description
     */
    protected static $instance = null;

    /**
     * Get accessor method for instance property.
     *
     * @return WP_Recipe_Description Instance of the class.
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
     * @return string Recipe description nonce.
     */
    public function get_nonce() {

        return $this->slug . '-nonce';

    }

    /* Meta Slug
    ---------------------------------------------- */

    /**
     * Getter method for meta slug.
     *
     * @return string Recipe description meta slug.
     */
    public function get_meta_slug() {

        return '_' . $this->slug;

    }

    /* Slug
    ---------------------------------------------- */

    /**
     * Recipe description slug.
     *
     * @var string
     */
    protected $slug = 'wp-recipe-description';

    /**
     * Getter method for slug.
     *
     * @return string Recipe description slug.
     */
    public function get_slug() {

        return $this->slug;

    }

}
