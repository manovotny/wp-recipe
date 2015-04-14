<?php

class WP_Recipe_Post_Type {

    /* Properties
    ---------------------------------------------------------------------------------- */

    /* Instance
    ---------------------------------------------- */

    /**
     * Instance of the class.
     *
     * @var WP_Recipe_Post_Type
     */
    protected static $instance = null;

    /**
     * Get accessor method for instance property.
     *
     * @return WP_Recipe_Post_Type Instance of the class.
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

    /* Constructor
    ---------------------------------------------------------------------------------- */

    /**
     * Initialize class.
     */
    public function __construct() {

        add_action( 'init', array( $this, 'create' ) );

    }

    /* Methods
    ---------------------------------------------------------------------------------- */

    /**
     * Creates recipe post type.
     */
    public function create() {

        $wp_image_util = WP_Image_Util::get_instance();
        $wp_recipe = WP_Recipe::get_instance();

        $slug = $wp_recipe->get_slug();

        $labels = array(
            'add_new_item' => _x( 'Add New Recipe', 'recipe custom post type add new item', $slug ),
            'all_items' => _x( 'All Recipes', 'recipe custom post type all items', $slug ),
            'edit_item' => _x( 'Edit Recipe', 'recipe custom post type edit item', $slug ),
            'menu_name' => _x( 'Recipes', 'recipe custom post type menu name', $slug ),
            'name' => _x( 'Recipes', 'recipe custom post type name', $slug ),
            'new_item' => _x( 'New Recipe', 'recipe custom post type new item', $slug ),
            'not_found' => _x( 'No recipes found', 'recipe custom post type not found', $slug ),
            'not_found_in_trash' => _x( 'No recipes found in the trash', 'recipe custom post type not found in trash', $slug ),
            'search_items' => _x( 'Search Recipes', 'recipe custom post type search items', $slug ),
            'singular_name' => _x( 'Recipe', 'recipe custom post type singular name', $slug ),
            'view_item' => _x( 'View Recipe', 'recipe custom post type view item', $slug )
        );

        $args = array(
            'description' => _x( 'A place to collect all your delicious recipes', 'recipe custom post type description', $slug ),
            'hierarchical' =>  false,
            'labels' =>  $labels,
            'menu_icon' => $wp_image_util->generate_datauri( realpath( __DIR__ . '/../admin/images/data/recipes.svg' ) ),
            'menu_position' =>  5,
            'public' =>  true,
            'supports' =>  array(
                'comments',
                'editor',
                'revisions',
                'thumbnail',
                'title'
            )
        );

        register_post_type( WP_Recipe_Post_Type::get_instance()->get_post_type(), $args );

    }

}
