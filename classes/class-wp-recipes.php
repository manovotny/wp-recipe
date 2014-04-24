<?php
/**
 * @package WP_Recipes
 * @author Michael Novotny <manovotny@gmail.com>
 */

/*
/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ CONTENTS /\/\/\/\/\/\/\/\/\/\/\/\/\/\//\/\/\/\/\

    1. Properties
    2. Constructor
    3. Custom Post Types
    4. Shortcodes
    5. Helpers

/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\//\/\/\/\/\/\/\/\/\/\
*/

class WP_Recipes {

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

    /* Slug
    ---------------------------------------------- */

    /**
     * Plugin unique identifier.
     *
     * @var string
     */
    protected $slug = 'wp-recipes';

    /* Constructor
    ---------------------------------------------------------------------------------- */

    /**
     * Initializes plugin.
     */
    private function __construct() {

        // Register custom post type.
        add_action( 'init', array( $this, 'recipes_taxonomy_cooking_methods' ) );
        add_action( 'init', array( $this, 'recipes_custom_post_type' ) );
        add_filter('manage_recipe_posts_columns', array( $this, 'recipes_custom_post_type_columns' ) );
        add_action('manage_recipe_posts_custom_column', array( $this, 'recipes_custom_post_type_columns_content' ), 10, 2 );

        // Register shortcode.
        add_shortcode( 'recipe', array( $this, 'recipe_shortcode' ) );

    } // end construct

    /* Custom Post Types
    ---------------------------------------------------------------------------------- */

    public function recipes_custom_post_type() {

        $labels = array(
            'add_new_item'          =>  _x( 'Add New Recipe', 'custom post type add new item', $this->slug ),
            'all_items'             =>  _x( 'All Recipes', 'custom post type all items', $this->slug ),
            'edit_item'             =>  _x( 'Edit Recipe', 'custom post type edit item', $this->slug ),
            'menu_name'             =>  _x( 'Recipes', 'custom post menu name', $this->slug ),
            'name'                  =>  _x( 'Recipes', 'custom post type name', $this->slug ),
            'new_item'              =>  _x( 'New Recipe', 'custom post new item', $this->slug ),
            'not_found'             =>  _x( 'No recipes found', 'custom post not found', $this->slug ),
            'not_found_in_trash'    =>  _x( 'No recipes found in the trash', 'custom post not found in trash', $this->slug ),
            'search_items'          =>  _x( 'Search Recipes', 'custom post type search items', $this-> slug ),
            'singular_name'         =>  _x( 'Recipe', 'custom post type singular name', $this-> slug ),
            'view_item'             =>  _x( 'View Recipe', 'custom post type view item', $this-> slug )
        );

        $args = array(
            'description'           =>  _x( 'A place to gather all your delicious noms', 'custom post type description', $this->slug ),
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
            ),
            'taxonomies'            =>  array(
                'category',
                'post_tag',
            )
        );

        register_post_type( 'recipe', $args );

    }

    public function recipes_custom_post_type_columns( $columns ) {

//        // Add custom columns.
//        $custom_columns[ 'recipe_id' ] = 'Id';
//
//        // Position custom columns right after title column.
//        return $this->array_add_at_index( $columns, $custom_columns );

        // Add custom columns.
        $columns[ 'recipe_id' ] = 'Id';

        return $columns;

    }

    public function recipes_custom_post_type_columns_content( $column, $post_id ) {

        if ( $column == 'recipe_id' ) {

            // Display recipe id.
            echo '<span>' . $post_id . '</span>';

        }

    }

    function recipes_taxonomy_cooking_methods() {

        $this->create_taxonomy( 'Cooking Method', 'Cooking Methods', 'cooking-methods', 'recipe' );
        $this->create_taxonomy( 'Course', 'Courses', 'courses', 'recipe' );
        $this->create_taxonomy( 'Cuisine', 'Cuisines', 'cuisines', 'recipe' );
        $this->create_taxonomy( 'Occasion', 'Occasions', 'occasions', 'recipe' );

    }

    /* Shortcodes
    ---------------------------------------------------------------------------------- */

    public function recipe_shortcode( $attributes, $content = null ) {

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

    /* Helpers
    ---------------------------------------------------------------------------------- */

    /* Private
    ---------------------------------------------------------------- */

    private function array_add_at_index( $array, $add, $index = -1 ) {

        // Create merged.
        $merged = array();

        // Get start.
        $start = array_slice( $array, 0, $index );

        // Get end.
        $end = array_slice( $array, $index );

        // Merge.
        $merged = array_merge( $merged, $start );
        $merged = array_merge( $merged, $add );
        $merged = array_merge( $merged, $end );

        // Return merged.
        return $merged;

    }

    private function create_taxonomy( $singular, $plural, $slug, $post_type ) {

        $labels = array(
            'add_new_item'      => __( 'Add New ' . $singular ),
            'all_items'         => __( 'All ' . $plural ),
            'edit_item'         => __( 'Edit ' . $singular ),
            'menu_name'         => __( $plural ),
            'name'              => __( $plural ),
            'new_item_name'     => __( 'New ' . $singular . ' Name' ),
            'parent_item'       => __( 'Parent ' . $singular ),
            'parent_item_colon' => __( 'Parent ' . $singular . ':' ),
            'search_items'      => __( 'Search ' . $plural ),
            'singular_name'     => __( $singular ),
            'update_item'       => __( 'Update ' . $singular ),
        );

        $args = array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => $slug ),
            'show_admin_column' => true,
            'show_ui'           => true,
        );

        register_taxonomy( $slug, array( $post_type ), $args );
    }

}
