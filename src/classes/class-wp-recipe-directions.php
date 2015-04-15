<?php

class WP_Recipe_Directions {

    /* Properties
    ---------------------------------------------------------------------------------- */

    /**
     * Instance of the class.
     *
     * @var WP_Recipe_Directions
     */
    protected static $instance = null;

    /**
     * Recipe directions slug.
     *
     * @var string
     */
    protected $slug = 'wp-recipe-directions';

    /* Constructor
    ---------------------------------------------------------------------------------- */

    /**
     * Initialize class.
     */
    public function __construct() {

        add_action( 'add_meta_boxes_recipe', array( $this, '__initialize' ) );
        add_action( 'save_post_' . WP_Recipe_Post_Type::get_instance()->get_post_type(), array( $this, '__save' ) );

    }

    /* Public
    ---------------------------------------------------------------------------------- */

    /**
     * Gets instance of class.
     *
     * @return WP_Recipe_Directions Instance of the class.
     */
    public static function get_instance() {

        if ( null == self::$instance ) {

            self::$instance = new self;

        }

        return self::$instance;

    }

    /**
     * Renders shortcode.
     *
     * @param array $post_meta Recipe post meta.
     */
    public function render( $post_meta ) {

        $post_meta_key = WP_Recipe_Util::get_instance()->get_post_meta_key( $this->slug );

        $value = $post_meta[ $post_meta_key ][ 0 ];

        if ( ! empty( $value ) ) {

            echo '<section class="recipe-directions">';
                echo '<h4>Directions</h4>';
                echo '<p>' . $value . '</p>';
            echo '</section>';

        }

    }

    /* Private
    ---------------------------------------------------------------------------------- */

    /**
     * Initializes view.
     */
    public function __initialize() {

        add_meta_box(
            $this->slug,
            'Directions',
            array( $this, '__render' ),
            WP_Recipe_Post_Type::get_instance()->get_post_type(),
            'normal',
            'high'
        );

    }

    /**
     * Renders view.
     */
    public function __render() {

        global $post;

        wp_nonce_field( $this->slug, WP_Recipe_Util::get_instance()->get_nonce( $this->slug ) );

        $directions = get_post_meta( $post->ID, WP_Recipe_Util::get_instance()->get_post_meta_key( $this->slug ), true );

        $settings = array(
            'drag_drop_upload' => true,
            'textarea_rows' => 8
        );

        wp_editor( $directions, WP_Recipe_Util::get_instance()->get_id( $this->slug ), $settings );

    }

    /**
     * Saves data.
     *
     * @param string $post_id Post id.
     */
    public function __save( $post_id ) {

        $post_type = WP_Recipe_Post_Type::get_instance()->get_post_type();

        WP_Recipe_Util::get_instance()->save_meta_box( $post_type, $post_id, $this->slug );

    }

}
