<?php
/**
 * @package WP_Recipes
 * @author Michael Novotny <manovotny@gmail.com>
 */

/*
/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ CONTENTS /\/\/\/\/\/\/\/\/\/\/\/\/\/\//\/\/\/\/\

    1. Properties
    2. Constructor
    3. Shortcodes

/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\//\/\/\/\/\/\/\/\/\/\
*/

class WP_Recipes_Shortcode {

    /* Properties
    ---------------------------------------------------------------------------------- */

    /* Instance
    ---------------------------------------------- */

    /**
     * Instance of the class.
     *
     * @var mixed
     */
    protected static $instance = null;

    /**
     * Get accessor method for instance property.
     *
     * @return mixed Instance of the class.
     */
    public static function get_instance() {

        // Check if an instance has not been created yet.
        if ( null == self::$instance ) {

            // Set instance of class.
            self::$instance = new self;

        }

        // Return instance.
        return self::$instance;

    }

    /* Constructor
    ---------------------------------------------------------------------------------- */

    /**
     * Initializes plugin.
     */
    private function __construct() {

        // Register shortcode.
        add_shortcode( 'recipe', array( $this, 'recipes_shortcode' ) );

    }

    /* Shortcodes
    ---------------------------------------------------------------------------------- */

    /**
     * Renders recipe shortcode.
     *
     * @param array $attributes Shortcode attributes.
     * @return string Rendered shortcode.
     */
    public function recipes_shortcode( $attributes ) {

        // Extract shortcode attributes.
        extract( shortcode_atts( array( 'id' => '' ), $attributes ) );

        // Check for id.
        if ( empty( $id ) ) {

            // No id.
            return '';

        }

        // Get recipe.
        $recipe = get_post( $id );

        // Check for recipe.
        if ( empty( $recipe ) ) {

            // No recipe.
            return '';

        }

        // Return recipe content.
        return $recipe->post_content;

    }

}
