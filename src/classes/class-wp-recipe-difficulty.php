<?php

class WP_Recipe_Difficulty {

    /* Properties
    ---------------------------------------------------------------------------------- */

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

    /* Slug
    ---------------------------------------------- */

    /**
     * Recipe difficulty slug.
     *
     * @var string
     */
    protected $slug = 'wp-recipe-difficulty';

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
            'Difficulty',
            array( $this, 'render' ),
            $wp_recipe->get_post_type(),
            'side',
            'high'
        );

    }

    /**
     * Renders meta box.
     */
    public function render() {

        global $post;

        wp_nonce_field( $this->slug, $this->get_nonce() );

        $difficulty = get_post_meta( $post->ID, $this->get_post_meta_key(), true );

        echo '<fieldset class="' . $this->slug . '">';
            echo '<label class="item-label" for="' . $this->get_id() . '">Difficulty</label>';
            echo '<select id="' . $this->get_id() . '" class="item-control" name="' . $this->get_id() . '">';

                foreach ( $this->options as $key => $value )  {

                    echo '<option value="' . $key . '" ' . selected( $difficulty, $key, false ) . '>';
                        echo $value;
                    echo '</option>';

                }

            echo '</select>';
        echo '</fieldset>';

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
     * @return string Recipe difficulty id.
     */
    private function get_id() {

        return str_replace( '-', '_', $this->slug );

    }

    /**
     * Gets nonce.
     *
     * @return string Recipe difficulty nonce.
     */
    private function get_nonce() {

        return $this->slug . '-nonce';

    }

    /**
     * Gets post meta key.
     *
     * @return string Recipe difficulty post meta key.
     */
    private function get_post_meta_key() {

        return '_' . $this->slug;

    }

}
