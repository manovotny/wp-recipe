<?php

class WP_Recipe_Shortcode {

    /* Properties
    ---------------------------------------------------------------------------------- */

    /* Instance
    ---------------------------------------------- */

    /**
     * Instance of the class.
     *
     * @var WP_Recipe_Shortcode
     */
    protected static $instance = null;

    /**
     * Get accessor method for instance property.
     *
     * @return WP_Recipe_Shortcode Instance of the class.
     */
    public static function get_instance() {

        if ( null == self::$instance ) {

            self::$instance = new self;

        }

        return self::$instance;

    }

    /* Constructor
    ---------------------------------------------------------------------------------- */

    /**
     * Initialize class.
     */
    public function __construct() {

        add_shortcode( WP_Recipe::get_instance()->get_shortcode(), array( $this, 'render' ) );

    }

    /* Methods
    ---------------------------------------------------------------------------------- */

    /**
     * Renders recipe shortcode.
     *
     * @param array $attributes Shortcode attributes.
     * @return string Rendered shortcode.
     */
    public function render( $attributes ) {

        ob_start();

        $this->get_template( $attributes );

        $html = ob_get_contents();

        ob_end_clean();

        return $html;

    }

    /* Helpers
    ---------------------------------------------------------------------------------- */

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

            WP_Recipe_Title::get_instance()->render_shortcode( $id );
            WP_Recipe_Controls::get_instance()->render_shortcode();
            WP_Recipe_Yield::get_instance()->render_shortcode( $post_meta );
            WP_Recipe_Description::get_instance()->render_shortcode( $post_meta );
            WP_Recipe_Ingredients::get_instance()->render_shortcode( $post_meta );
            WP_Recipe_Directions::get_instance()->render_shortcode( $post_meta );
            WP_Recipe_Tips::get_instance()->render_shortcode( $post_meta );
            WP_Recipe_After::get_instance()->render_shortcode();

        echo '</div>';

    }

}
