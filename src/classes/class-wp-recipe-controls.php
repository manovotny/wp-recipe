<?php

class WP_Recipe_Controls {

    /* Properties
    ---------------------------------------------------------------------------------- */

    /* Instance
    ---------------------------------------------- */

    /**
     * Instance of the class.
     *
     * @var WP_Recipe_Controls
     */
    protected static $instance = null;

    /**
     * Get accessor method for instance property.
     *
     * @return WP_Recipe_Controls Instance of the class.
     */
    public static function get_instance() {

        if ( null == self::$instance ) {

            self::$instance = new self;

        }

        return self::$instance;

    }

    /* Methods
    ---------------------------------------------------------------------------------- */

    /**
     * Renders shortcode.
     */
    public function render_shortcode() {

        echo '<ul class="recipe-controls">';

        if ( shortcode_exists( 'pinit' ) ) {

            echo '<li>';
                echo do_shortcode( '[pinit]' );
            echo '</li>';

        }

        echo '</ul>';

    }

}
