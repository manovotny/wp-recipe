<?php

class WP_Recipe_Controls {

    /* Properties
    ---------------------------------------------------------------------------------- */

    /**
     * Instance of the class.
     *
     * @var WP_Recipe_Controls
     */
    protected static $instance = null;

    /* Public
    ---------------------------------------------------------------------------------- */

    /**
     * Gets instance of class.
     *
     * @return WP_Recipe_Controls Instance of the class.
     */
    public static function get_instance() {

        if ( null == self::$instance ) {

            self::$instance = new self;

        }

        return self::$instance;

    }

    /**
     * Renders shortcode.
     */
    public function render() {

        echo '<ul class="recipe-controls">';

        if ( shortcode_exists( 'pinit' ) ) {

            echo '<li>';
                echo do_shortcode( '[pinit]' );
            echo '</li>';

        }

        echo '</ul>';

    }

}
