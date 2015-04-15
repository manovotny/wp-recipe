<?php

class WP_Recipe_Shortcode {

    /* Properties
    ---------------------------------------------------------------------------------- */

    /**
     * Instance of the class.
     *
     * @var WP_Recipe_Shortcode
     */
    protected static $instance = null;

    /* Constructor
    ---------------------------------------------------------------------------------- */

    /**
     * Initialize class.
     */
    public function __construct() {

        $shortcode = WP_Recipe_Util::get_instance()->get_shortcode( WP_Recipe::get_instance()->get_slug() );

        add_shortcode( $shortcode, array( $this, '__render' ) );

    }

    /* Public
    ---------------------------------------------------------------------------------- */

    /**
     * Gets instance of class.
     *
     * @return WP_Recipe_Shortcode Instance of the class.
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
     * Renders view.
     *
     * @param array $attributes Shortcode attributes.
     * @return string Rendered shortcode.
     */
    public function __render( $attributes ) {

        ob_start();

        $this->get_template( $attributes );

        $html = ob_get_contents();

        ob_end_clean();

        return $html;

    }

    /**
     * Gets recipe shortcode template.
     *
     * @param array $attributes Shortcode attributes.
     * @return string Shortcode template.
     */
    private function get_template( $attributes ) {

        extract(
            shortcode_atts(
                array(
                    'id' => ''
                ),
                $attributes
            )
        );

        if ( empty( $id ) ) {

            return '';

        }

        $post_meta = get_post_meta( $id );

        if ( empty( $post_meta ) ) {

            return '';

        }

        echo '<div class="recipe">';

            WP_Recipe_Title::get_instance()->render( $id );
            WP_Recipe_Controls::get_instance()->render();
            WP_Recipe_Yield::get_instance()->render( $post_meta );
            WP_Recipe_Description::get_instance()->render( $post_meta );
            WP_Recipe_Ingredients::get_instance()->render( $post_meta );
            WP_Recipe_Directions::get_instance()->render( $post_meta );
            WP_Recipe_Tips::get_instance()->render( $post_meta );
            WP_Recipe_After::get_instance()->render();

        echo '</div>';

    }

}
