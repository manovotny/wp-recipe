<?php

class WP_Recipe_Post_Type_Columns {

    /* Properties
    ---------------------------------------------------------------------------------- */

    /**
     * Instance of the class.
     *
     * @var WP_Recipe_Post_Type_Columns
     */
    protected static $instance = null;

    /* Constructor
    ---------------------------------------------------------------------------------- */

    /**
     * Initialize class.
     */
    public function __construct() {

        add_action( 'manage_recipe_posts_custom_column', array( $this, '__render' ), 10, 2 );

        add_filter( 'manage_recipe_posts_columns', array( $this, '__initialize' ) );

    }

    /* Public
    ---------------------------------------------------------------------------------- */

    /**
     * Gets instance of class.
     *
     * @return WP_Recipe_Post_Type_Columns Instance of the class.
     */
    public static function get_instance() {

        if ( null == self::$instance ) {

            self::$instance = new self;

        }

        return self::$instance;

    }

    /* Private
    ---------------------------------------------------------------------------------- */

    /**
     * Initializes view.
     *
     * @param $columns array Existing post type columns.
     * @return mixed Modified post type columns
     */
    public function __initialize( $columns ) {

        $wp_array_util = WP_Array_Util::get_instance();

        $custom_columns = array(
            'recipe_id' => 'Id'
        );

        return $wp_array_util->add_items_at_index( $columns, $custom_columns, 2 );

    }

    /**
     * Renders view.
     *
     * @param $column string Current column being rendered.
     * @param $post_id string Id of the post type.
     */
    public function __render( $column, $post_id ) {

        if ( $column == 'recipe_id' ) {

            echo '<span>' . $post_id . '</span>';

        }

    }

}
