<?php
/**
 * @package WP_Recipe
 * @author Michael Novotny <manovotny@gmail.com>
 */

class WP_Recipe_Yield {

    /* Properties
    ---------------------------------------------------------------------------------- */

    /* Id
    ---------------------------------------------- */

    /**
     * Getter method for id.
     *
     * @return string Recipe yield id.
     */
    public function get_id() {

        return $this->slug;

    }

    /* Instance
    ---------------------------------------------- */

    /**
     * Instance of the class.
     *
     * @var WP_Recipe_Yield
     */
    protected static $instance = null;

    /**
     * Get accessor method for instance property.
     *
     * @return WP_Recipe_Yield Instance of the class.
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
     * @return string Recipe yield nonce.
     */
    public function get_nonce() {

        return $this->slug . '-nonce';

    }

    /* Meta Slug
    ---------------------------------------------- */

    /**
     * Getter method for meta slug.
     *
     * @return string Recipe yield meta slug.
     */
    public function get_meta_slug() {

        return '_' . $this->slug;

    }

    /* Slug
    ---------------------------------------------- */

    /**
     * Recipe yield slug.
     *
     * @var string
     */
    protected $slug = 'wp-recipe-yield';

    /**
     * Getter method for slug.
     *
     * @return string Recipe yield slug.
     */
    public function get_slug() {

        return $this->slug;

    }

}
