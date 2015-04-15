<?php

class WP_Recipe_Index_Item {

    /* Properties
    ---------------------------------------------------------------------------------- */

    /**
     * Instance of the class.
     *
     * @var WP_Recipe_Index_Item
     */
    protected static $instance = null;

    /* Public
    ---------------------------------------------------------------------------------- */

    /**
     * Gets instance of class.
     *
     * @return WP_Recipe_Index_Item Instance of the class.
     */
    public static function get_instance() {

        if ( null == self::$instance ) {

            self::$instance = new self;

        }

        return self::$instance;

    }

    /**
     * Renders recipe index item.
     *
     * @param $recipe_id string Recipe id.
     */
    public function render( $recipe_id ) {

        $wp_recipe = WP_Recipe::get_instance();

        $post_meta_key = WP_Recipe_Cross_Reference_Posts::get_instance()->get_post_meta_key();

        $post_references = get_post_meta( $recipe_id, $post_meta_key );

        if ( empty( $post_references ) ) {

            return;

        }

        $permalink = get_permalink( $post_references[ 0 ] );
        $title = get_the_title();
        $link_title = __( 'View recipe for', $wp_recipe->get_slug() ) . ' ' . $title;

        echo '<li>';
            echo '<a href="' . $permalink . '" rel="bookmark" title="' . $link_title  . '">';
                echo $title;
            echo '</a>';
        echo '</li>';

    }

}
