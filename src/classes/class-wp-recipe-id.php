<?php

class WP_Recipe_Id {

    /* Properties
    ---------------------------------------------------------------------------------- */

    /**
     * Instance of the class.
     *
     * @var WP_Recipe_Id
     */
    protected static $instance = null;

    /**
     * Recipe id slug.
     *
     * @var string
     */
    protected $slug = 'wp-recipe-id';

    /* Constructor
    ---------------------------------------------------------------------------------- */

    /**
     * Initialize class.
     */
    public function __construct() {

        add_action( 'add_meta_boxes_recipe', array( $this, '__initialize' ) );

    }

    /* Public
    ---------------------------------------------------------------------------------- */

    /**
     * Gets instance of class.
     *
     * @return WP_Recipe_Id Instance of the class.
     */
    public static function get_instance() {

        if ( null == self::$instance ) {

            self::$instance = new self;

        }

        return self::$instance;

    }

    /* Private
    ---------------------------------------------------------------------------------- */

    /**
     * Initializes view.
     */
    public function __initialize() {

        add_meta_box(
            $this->slug,
            'Recipe Id',
            array( $this, '__render' ),
            WP_Recipe_Post_Type::get_instance()->get_post_type(),
            'side',
            'high'
        );

    }

    /**
     * Renders view.
     */
    public function __render() {

        global $post;

        echo '<p>' . $post->ID . '</p>';

    }

}
