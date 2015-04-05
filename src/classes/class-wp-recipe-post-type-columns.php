<?php

class WP_Recipe_Post_Type_Columns {

    /* Properties
    ---------------------------------------------------------------------------------- */

    /* Instance
    ---------------------------------------------- */

    /**
     * Instance of the class.
     *
     * @var WP_Recipe_Post_Type_Columns
     */
    protected static $instance = null;

    /**
     * Get accessor method for instance property.
     *
     * @return WP_Recipe_Post_Type_Columns Instance of the class.
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

        add_action( 'manage_recipe_posts_custom_column', array( $this, 'render' ), 10, 2 );

        add_filter( 'manage_recipe_posts_columns', array( $this, 'create' ) );

    }

    /* Methods
    ---------------------------------------------------------------------------------- */

    /**
     * Creates recipe post type columns.
     *
     * @param $columns array Existing post type columns.
     * @return mixed Modified post type columns
     */
    public function create( $columns ) {

        $wp_array_util = WP_Array_Util::get_instance();

        $custom_columns = array(
            'recipe_id' => 'Id'
        );

        return $wp_array_util->add_items_at_index( $columns, $custom_columns, 2 );

    }

    /**
     * Renders post type columns.
     *
     * @param $column string Current column being rendered.
     * @param $post_id string Id of the post type.
     */
    public function render( $column, $post_id ) {

        if ( $column == 'recipe_id' ) {

            echo '<span>' . $post_id . '</span>';

        }

    }

}
