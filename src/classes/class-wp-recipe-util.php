<?php

class WP_Recipe_Util {

    /* Properties
    ---------------------------------------------------------------------------------- */

    /**
     * Instance of the class.
     *
     * @var WP_Recipe_Util
     */
    protected static $instance = null;

    /* Public
    ---------------------------------------------------------------------------------- */

    /**
     * Generates id from supplied slug.
     *
     * @param string $slug Slug to derive id from.
     * @return string Generated id.
     */
    public function get_id( $slug ) {

        return str_replace( '-', '_', $slug );

    }

    /**
     * Gets instance of class.
     *
     * @return WP_Recipe_Util Instance of the class.
     */
    public static function get_instance() {

        if ( null == self::$instance ) {

            self::$instance = new self;

        }

        return self::$instance;

    }

    /**
     * Generates nonce from supplied slug.
     *
     * @param string $slug Slug to derive id from.
     * @return string Generated nonce.
     */
    public function get_nonce( $slug ) {

        return $slug . '-nonce';

    }

    /**
     * Generates post meta key from supplied slug.
     *
     * @param string $slug Slug to derive id from.
     * @return string Generated post meta key.
     */
    public function get_post_meta_key( $slug ) {

        return '_' . $slug;

    }

    /**
     * Gets shortcode attributes values from supplied content.
     *
     * @param $content string Content to search.
     * @param $find_shortcode string Shortcode to look for.
     * @param $find_attribute string Shortcode attribute to look for.
     * @return array Shortcode attribute values.
     */
    public function get_shortcode_attribute_values( $content, $find_shortcode, $find_attribute ) {

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
     * Generates shortcode from supplied slug.
     *
     * @param string $slug Slug to derive id from.
     * @return string Recipe shortcode.
     */
    public function get_shortcode( $slug ) {

        return str_replace( '-', '', $slug );

    }

    /**
     * Gets all shortcodes used within supplied content.
     *
     * @param $content string Content to search.
     * @return mixed Shortcodes used in content.
     */
    public function get_shortcodes( $content ) {

        $pattern = get_shortcode_regex();

        preg_match_all( '/' . $pattern . '/s', $content, $matches );

        return $matches;

    }

    /**
     * Determines if a post exists or not.
     *
     * @param string $post_id The post id to check for existence.
     * @return boolean Whether or not the post exists.
     */
    public function post_exists( $post_id ) {

        return is_string( get_post_status( $post_id ) );

    }

    /**
     * Determines if a recipe exists or not.
     *
     * @param string $recipe_id The recipe id to check for existence.
     * @return boolean Whether or not the recipe exists.
     */
    public function recipe_exists( $recipe_id ) {

        return $this->post_exists( $recipe_id );

    }

    /**
     * Saves meta box.
     *
     * @param string $post_type Post type to save for. 
     * @param string $post_id Post id.
     * @param string $slug Slug of items to save.
     */
    public function save_meta_box( $post_type, $post_id, $slug ) {

        $wp_post_type_util = WP_Post_Type_Util::get_instance();

        if ( ! $wp_post_type_util->is_post_type_saving_post_meta( $post_type ) ) {

            return;

        }

        $wp_recipe_util = WP_Recipe_Util::get_instance();

        $nonce = $wp_recipe_util->get_nonce( $slug );

        if ( $wp_post_type_util->can_save_post_meta( $post_id, $slug, $nonce ) ) {

            $post_meta_key = $wp_recipe_util->get_post_meta_key( $slug );
            $id = $wp_recipe_util->get_id( $slug );

            update_post_meta( $post_id, $post_meta_key, $_POST[ $id ] );

        }

    }

}
