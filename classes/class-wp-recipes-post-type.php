<?php
/**
 * @package WP_Recipes
 * @author Michael Novotny <manovotny@gmail.com>
 */

/*
/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ CONTENTS /\/\/\/\/\/\/\/\/\/\/\/\/\/\//\/\/\/\/\

    1. Properties
    2. Constructor
    3. Post Type

/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\//\/\/\/\/\/\/\/\/\/\
*/

class WP_Recipes_Post_Type {

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

        // Create post type.
        add_action( 'init', array( $this, 'recipes_post_type' ) );

    }

    /* Post Types
    ---------------------------------------------------------------------------------- */

    /**
     * Creates recipes post type.
     */
    public function recipes_post_type() {

        $domain = 'wp-recipes';
        
        // Create labels.
        $labels = array(
            'add_new_item'          =>  _x( 'Add New Recipe', 'custom post type add new item', $domain ),
            'all_items'             =>  _x( 'All Recipes', 'custom post type all items', $domain ),
            'edit_item'             =>  _x( 'Edit Recipe', 'custom post type edit item', $domain ),
            'menu_name'             =>  _x( 'Recipes', 'custom post menu name', $domain ),
            'name'                  =>  _x( 'Recipes', 'custom post type name', $domain ),
            'new_item'              =>  _x( 'New Recipe', 'custom post new item', $domain ),
            'not_found'             =>  _x( 'No recipes found', 'custom post not found', $domain ),
            'not_found_in_trash'    =>  _x( 'No recipes found in the trash', 'custom post not found in trash', $domain ),
            'search_items'          =>  _x( 'Search Recipes', 'custom post type search items', $domain ),
            'singular_name'         =>  _x( 'Recipe', 'custom post type singular name', $domain ),
            'view_item'             =>  _x( 'View Recipe', 'custom post type view item', $domain )
        );

        // Create post type arguments.
        $args = array(
            'description'           =>  _x( 'A place to collect all your delicious recipes', 'custom post type description', $domain ),
            'exclude_from_search'   =>  false,
            'hierarchical'          =>  false,
            'labels'                =>  $labels,
            'menu_position'         =>  5,
            'public'                =>  true,
            'supports'              =>  array(
                                            'comments',
                                            'editor',
                                            'revisions',
                                            'thumbnail',
                                            'title'
                                        )
        );

        // Create post type.
        register_post_type( 'recipe', $args );

    }

}
