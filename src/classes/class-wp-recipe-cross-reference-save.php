<?php

class WP_Recipe_Cross_Reference_Save {

    /* Properties
    ---------------------------------------------------------------------------------- */

    /* Instance
    ---------------------------------------------- */

    /**
     * Instance of the class.
     *
     * @var WP_Recipe_Cross_Reference_Save
     */
    protected static $instance = null;

    /**
     * Get accessor method for instance property.
     *
     * @return WP_Recipe_Cross_Reference_Save Instance of the class.
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
        $post_references = WP_Recipe_Cross_Reference_Posts::get_instance();
        $recipe_references = WP_Recipe_Cross_Reference_Recipes::get_instance();

        /*
         * Need to grab the content from `$_POST` and not the `global post` because
         * the `global post` contains the existing post information and the `$_POST`
         * contains the new information being saved.
         */
        $recipe_ids = $this->get_shortcode_attribute_values( $_POST[ 'content' ], $wp_recipe->get_shortcode(), 'id' );

        $post_references->update( $post_id, $recipe_ids );
        $recipe_references->update( $post_id, $recipe_ids );

    }

    /* Helpers
    ---------------------------------------------------------------------------------- */

    /**
     * Gets shortcode attributes values from supplied content.
     *
     * @param $content string Content to search.
     * @param $find_shortcode string Shortcode to look for.
     * @param $find_attribute string Shortcode attribute to look for.
     * @return array Shortcode attribute values.
     */
    private function get_shortcode_attribute_values( $content, $find_shortcode, $find_attribute ) {

        $shortcodes = $this->get_shortcodes( $content );

        if ( empty( $shortcodes ) ) {

            return null;

        }

        $values = array();

        $name = 2;
        $attribute_string = 3;

        foreach ( $shortcodes[ $name ] as $index => $shortcode ) {

            if ( $find_shortcode === $shortcode ) {

                $attributes = explode( ' ', trim( $shortcodes[ $attribute_string ][ $index ] ) );

                foreach ( $attributes as $attribute ) {

                    $attribute_key_value = explode( '=', $attribute );

                    if ( $find_attribute === $attribute_key_value[ 0 ] ) {

                        array_push( $values, $attribute_key_value[ 1 ] );

                    }

                }

            }

        }

        return $values;

    }

    /**
     * Gets all shortcodes used within supplied content.
     *
     * @param $content string Content to search.
     * @return mixed Shortcodes used in content.
     */
    private function get_shortcodes( $content ) {

        $pattern = get_shortcode_regex();

        preg_match_all( '/' . $pattern . '/s', $content, $matches );

        return $matches;

    }

}
