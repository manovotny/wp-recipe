<?php

class WP_Recipe_Title {

    /* Properties
    ---------------------------------------------------------------------------------- */

    /* Instance
    ---------------------------------------------- */

    /**
     * Instance of the class.
     *
     * @var WP_Recipe_Title
     */
    protected static $instance = null;

    /**
     * Get accessor method for instance property.
     *
     * @return WP_Recipe_Title Instance of the class.
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
     *
     * @param string $recipe_id Recipe id.
     */
    public function render_shortcode( $recipe_id ) {

        $title = get_the_title( $recipe_id );

        if ( ! empty( $title ) ) {

            echo '<h3 class="recipe-title">' . $title . '</h3>';

        }

    }

}
