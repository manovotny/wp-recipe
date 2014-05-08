<?php
/**
 * @package WP_Taxonomy_Util
 * @author Michael Novotny <manovotny@gmail.com>
 */

/*
/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ CONTENTS /\/\/\/\/\/\/\/\/\/\/\/\/\/\//\/\/\/\/\

    1. Properties
    2. Methods

/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\//\/\/\/\/\/\/\/\/\/\
*/

class WP_Taxonomy_Util {

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

    /* Methods
    ---------------------------------------------------------------------------------- */

    /**
     * Creates multiple custom taxonomies.
     *
     * @param array $taxonomies An array of WP_Taxonomy_Options.
     */
    public function create_taxonomies( $taxonomies ) {

        foreach( $taxonomies as $taxonomy ) {

            $this->create_taxonomy( $taxonomy );

        }

    }

    /**
     * Creates a custom taxonomy.
     *
     * @param WP_Taxonomy_Options $options Properties to create a new taxonomy.
     */
    public function create_taxonomy( $options ) {

        // Ensure we have the correct options.
        if ( ! $options instanceof WP_Taxonomy_Options ) {

            // Trigger error.
            trigger_error( 'Options must be passed as a WP_Taxonomy_Options.' );

            // Exit.
            return;

        }

        // Ensure we have all the properties required.
        if ( ! $options->has_required_properties() ) {

            // Trigger error.
            trigger_error( 'WP_Taxonomy_Options are missing required properties.' );

            // Exit.
            return;

        }

        // Create labels.
        $labels = array(
            'add_new_item'      => __( 'Add New ' . $options->get_singular_name() ),
            'all_items'         => __( 'All ' . $options->get_plural_name() ),
            'edit_item'         => __( 'Edit ' . $options->get_singular_name() ),
            'menu_name'         => __( $options->get_plural_name() ),
            'name'              => __( $options->get_plural_name() ),
            'new_item_name'     => __( 'New ' . $options->get_singular_name() . ' Name' ),
            'parent_item'       => __( 'Parent ' . $options->get_singular_name() ),
            'parent_item_colon' => __( 'Parent ' . $options->get_singular_name() . ':' ),
            'search_items'      => __( 'Search ' . $options->get_plural_name() ),
            'singular_name'     => __( $options->get_singular_name() ),
            'update_item'       => __( 'Update ' . $options->get_singular_name() ),
        );

        // Create taxonomy arguments.
        $args = array(
            'hierarchical'      => $options->get_hierarchical(),
            'labels'            => $labels,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => $options->get_slug() ),
            'show_admin_column' => true,
            'show_ui'           => true,
        );

        // Create taxonomy.
        register_taxonomy( $options->get_slug(), array( $options->get_post_type() ), $args );

    }

}
