<?php

class WP_Recipe_Difficulty {

    /* Properties
    ---------------------------------------------------------------------------------- */

    /* Id
    ---------------------------------------------- */

    /**
     * Getter method for id.
     *
     * @return string Recipe difficulty id.
     */
    public function get_id() {

        return $this->slug;

    }

    /* Instance
    ---------------------------------------------- */

    /**
     * Instance of the class.
     *
     * @var WP_Recipe_Difficulty
     */
    protected static $instance = null;

    /**
     * Get accessor method for instance property.
     *
     * @return WP_Recipe_Difficulty Instance of the class.
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
     * @return string Recipe difficulty nonce.
     */
    public function get_nonce() {

        return $this->slug . '-nonce';

    }

    /* Meta Slug
    ---------------------------------------------- */

    /**
     * Getter method for meta slug.
     *
     * @return string Recipe difficulty meta slug.
     */
    public function get_meta_slug() {

        return '_' . $this->slug;

    }

    /* Options
    ---------------------------------------------- */

    /**
     * Recipe difficulty options.
     *
     * @var string
     */
    protected $options = array(
        '' => '',
        'easy' => 'Easy',
        'medium' => 'Medium',
        'hard' => 'Hard'
    );

    /**
     * Getter method for options.
     *
     * @return string Recipe difficulty options.
     */
    public function get_options() {

        return $this->options;

    }

    /* Slug
    ---------------------------------------------- */

    /**
     * Recipe difficulty slug.
     *
     * @var string
     */
    protected $slug = 'wp-recipe-difficulty';

    /**
     * Getter method for slug.
     *
     * @return string Recipe difficulty slug.
     */
    public function get_slug() {

        return $this->slug;

    }

}
