<?php

class WP_Recipe_Title {

    /* Properties
    ---------------------------------------------------------------------------------- */

    /**
     * Instance of the class.
     *
     * @var WP_Recipe_Title
     */
    protected static $instance = null;

    /* Public
    ---------------------------------------------------------------------------------- */

    /**
     * Gets instance of class.
     *
     * @return WP_Recipe_Title Instance of the class.
     */
    public static function get_instance() {

        if ( null == self::$instance ) {

            self::$instance = new self;

        }

        return self::$instance;

    }

    /**
     * Renders view.
     *
     * @param string $recipe_id Recipe id.
     */
    public function render( $recipe_id ) {

        $title = get_the_title( $recipe_id );

        if ( ! empty( $title ) ) {

            echo '<h3 class="recipe-title">' . $title . '</h3>';

        }

    }

}
