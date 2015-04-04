<?php

class WP_Recipe_Description {

    /* Properties
    ---------------------------------------------------------------------------------- */

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

    /* Slug
    ---------------------------------------------- */

    /**
     * Recipe description slug.
     *
     * @var string
     */
    protected $slug = 'wp-recipe-description';

    /* Constructor
    ---------------------------------------------------------------------------------- */

    /**
     * Initialize class.
     */
    public function __construct() {

        add_action( 'add_meta_boxes_recipe', array( $this, 'add_meta_box' ) );
        add_action( 'save_post_' . WP_Recipe::get_instance()->get_post_type(), array( $this, 'save' ) );

    }

    /* Methods
    ---------------------------------------------------------------------------------- */

    /**
     * Adds post cross reference meta box to recipes.
     */
    public function add_meta_box() {

        $wp_recipe = WP_Recipe::get_instance();

        add_meta_box(
            $this->slug,
            'Description',
            array( $this, 'render' ),
            $wp_recipe->get_post_type(),
            'normal',
            'high'
        );

    }

    /**
     * Renders meta box.
     */
    public function render() {

        global $post;

        wp_nonce_field( $this->slug, $this->get_nonce() );

        $description = get_post_meta( $post->ID, $this->get_post_meta_key(), true );

        $settings = array(
            'drag_drop_upload' => true,
            'textarea_rows' => 3
        );

        wp_editor( $description, $this->get_id(), $settings );

    }

    /**
     * Saves meta box.
     *
     * @param string $post_id Post id.
     */
    public function save( $post_id ) {

        $wp_post_type_util = WP_Post_Type_Util::get_instance();
        $wp_recipe = WP_Recipe::get_instance();

        if ( ! $wp_post_type_util->is_post_type_saving_post_meta( $wp_recipe->get_post_type() ) ) {

            return;

        }

        if ( $wp_post_type_util->can_save_post_meta( $post_id, $this->slug, $this->get_nonce() ) ) {

            update_post_meta( $post_id, $this->get_post_meta_key(), $_POST[ $this->get_id() ] );

        }

    }

    /* Helpers
    ---------------------------------------------------------------------------------- */

    /**
     * Gets editor id.
     *
     * @return string Recipe description id.
     */
    private function get_id() {

        return str_replace( '-', '_', $this->slug );

    }

    /**
     * Gets nonce.
     *
     * @return string Recipe description nonce.
     */
    private function get_nonce() {

        return $this->slug . '-nonce';

    }

    /**
     * Gets post meta key.
     *
     * @return string Recipe description post meta key.
     */
    private function get_post_meta_key() {

        return '_' . $this->slug;

    }

}
