<?php

class WP_Recipe_Cross_References {

    /* Properties
    ---------------------------------------------------------------------------------- */

    /* Instance
    ---------------------------------------------- */

    /**
     * Instance of the class.
     *
     * @var WP_Recipe_Cross_References
     */
    protected static $instance = null;

    /**
     * Get accessor method for instance property.
     *
     * @return WP_Recipe_Cross_References Instance of the class.
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

        add_action( 'save_post_post', array( $this, 'save' ) );

    }

    /* Methods
    ---------------------------------------------------------------------------------- */

    /**
     * Saves post and recipe cross references.
     */
    public function save() {

        global $post;

        if ( empty( $post ) || ! array_key_exists( 'content', $_POST ) ) {

            return;

        }

        $post_id = $post->ID;

        $wp_recipe = WP_Recipe::get_instance();
        $wp_recipe_util = WP_Recipe_Util::get_instance();
        $post_references = WP_Recipe_Cross_Reference_Posts::get_instance();
        $recipe_references = WP_Recipe_Cross_Reference_Recipes::get_instance();

        /*
         * Need to grab the content from `$_POST` and not the `global post` because
         * the `global post` contains the existing post information and the `$_POST`
         * contains the new information being saved.
         */
        $shortcode = WP_Recipe_Util::get_instance()->get_shortcode( $wp_recipe->get_slug() );
        $recipe_ids = $wp_recipe_util->get_shortcode_attribute_values( $_POST[ 'content' ], $shortcode, 'id' );

        $post_references->update( $post_id, $recipe_ids );
        $recipe_references->update( $post_id, $recipe_ids );

    }

}
