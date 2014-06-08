<?php
/**
 * @package WP_Recipe
 * @author Michael Novotny <manovotny@gmail.com>
 */

class WP_Recipe {

    /* Properties
    ---------------------------------------------------------------------------------- */

    /* Instance
    ---------------------------------------------- */

    /**
     * Instance of the class.
     *
     * @var WP_Recipe
     */
    protected static $instance = null;

    /**
     * Get accessor method for instance property.
     *
     * @return WP_Recipe Instance of the class.
     */
    public static function get_instance() {

        if ( null == self::$instance ) {

            self::$instance = new self;

        }

        return self::$instance;

    }

    /* Post Type
    ---------------------------------------------- */

    /**
     * Recipe post type.
     *
     * @var string
     */
    protected $post_type = 'recipe';

    /**
     * Getter method for post type.
     *
     * @return string Recipe post type.
     */
    public function get_post_type() {

        return $this->post_type;

    }

    /* Version
    ---------------------------------------------- */

    /**
     * Plugin version, used for cache-busting of style and script file references.
     *
     * @var string
     */
    protected $version = '0.5.0';

    /**
     * Getter method for version.
     *
     * @return string Plugin version.
     */
    public function get_version() {

        return $this->version;

    }

    /* Methods
    ---------------------------------------------------------------------------------- */

    /**
     * Determines if the current screen is the recipe add or edit screen.
     *
     * @return boolean Whether or not the current screen is the recipe add or edit screen.
     */
    public function is_wp_recipe_add_or_edit_screen() {

        $screen = get_current_screen();

        return 'recipe' === $screen->post_type && ( 'add' === $screen->action || ( array_key_exists( 'action', $_REQUEST ) && 'edit' === $_REQUEST[ 'action' ] ) );

    }












    /**
     * Determines whether or not the current user has the ability to save meta data
     * associated with this post.
     *
     * @param int $post_id The id of the post being saved.
     * @param string $action The feature's action.
     * @param string $nonce The feature's nonce.
     * @return boolean Whether the user can save or not.
     */
    public function can_user_save( $post_id, $action, $nonce ) {

        $is_autosave = wp_is_post_autosave( $post_id );
        $is_revision = wp_is_post_revision( $post_id );
        $is_valid_nonce = ( isset( $_POST[ $nonce ] ) && wp_verify_nonce( $_POST[ $nonce ], $action ) );

        // Return true if the user is able to save; otherwise, false.
        return ! ( $is_autosave || $is_revision ) && $is_valid_nonce;

    } // end user_can_save

}
