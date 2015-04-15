<?php

class WP_Recipe_Difficulty {

    /* Properties
    ---------------------------------------------------------------------------------- */

    /**
     * Instance of the class.
     *
     * @var WP_Recipe_Difficulty
     */
    protected static $instance = null;

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

        add_action( 'add_meta_boxes_recipe', array( $this, '__initialize' ) );
        add_action( 'save_post_' . WP_Recipe_Post_Type::get_instance()->get_post_type(), array( $this, '__save' ) );

    }

    /* Public
    ---------------------------------------------------------------------------------- */

    /**
     * Gets instance of class.
     *
     * @return WP_Recipe_Difficulty Instance of the class.
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
            'Difficulty',
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

        wp_nonce_field( $this->slug, WP_Recipe_Util::get_instance()->get_nonce( $this->slug ) );

        $difficulty = get_post_meta( $post->ID, WP_Recipe_Util::get_instance()->get_post_meta_key( $this->slug ), true );

        $id = WP_Recipe_Util::get_instance()->get_id( $this->slug );

        echo '<fieldset class="' . $this->slug . '">';
            echo '<label class="item-label" for="' . $id . '">Difficulty</label>';
            echo '<select id="' . $id . '" class="item-control" name="' . $id . '">';

                $options = array(
                    '' => '',
                    'easy' => 'Easy',
                    'medium' => 'Medium',
                    'hard' => 'Hard'
                );

                foreach ( $options as $key => $value )  {

                    echo '<option value="' . $key . '" ' . selected( $difficulty, $key, false ) . '>';
                        echo $value;
                    echo '</option>';

                }

            echo '</select>';
        echo '</fieldset>';

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
