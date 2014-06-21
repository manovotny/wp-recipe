<?php
/**
 * @package WP_Taxonomy_Util
 * @author Michael Novotny <manovotny@gmail.com>
 */

/*
/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ CONTENTS /\/\/\/\/\/\/\/\/\/\/\/\/\/\//\/\/\/\/\

    1. Properties
    2. Constructor
    3. Methods

/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\//\/\/\/\/\/\/\/\/\/\
*/

class WP_Taxonomy_Options {

    /* Properties
    ---------------------------------------------------------------------------------- */

    /* Hierarchical
    ---------------------------------------------- */

    /**
     * If the taxonomy should be hierarchical (ie. categories) or flat (ie. tags).
     *
     * @var boolean
     */
    private $hierarchical = true;

    /**
     * Getter method for hierarchical.
     *
     * @return boolean Whether the taxonomy should be hierarchical or flat.
     */
    public function get_hierarchical() {

        return $this->hierarchical;

    }

    /**
     * Setter method for hierarchical.
     *
     * @param boolean $value Whether the taxonomy should be hierarchical or flat.
     */
    public function set_hierarchical( $value ) {

        $this->hierarchical = $value;

    }
    /* Plural Name
    ---------------------------------------------- */

    /**
     * Plural name of the taxonomy.
     *
     * @var string
     */
    private $plural_name = '';

    /**
     * Getter method for plural name.
     *
     * @return string Plural name of the taxonomy.
     */
    public function get_plural_name() {

        return $this->plural_name;

    }

    /**
     * Setter method for plural name.
     *
     * @param string $value Plural name of the taxonomy.
     */
    public function set_plural_name( $value ) {

        $this->plural_name = $value;

    }

    /* Post Type
    ---------------------------------------------- */

    /**
     * Post type the taxonomy belongs to.
     *
     * @var string
     */
    private $post_type = '';

    /**
     * Getter method for post type name.
     *
     * @return string Post type the taxonomy belongs to.
     */
    public function get_post_type() {

        return $this->post_type;

    }

    /**
     * Setter method for post type name.
     *
     * @param string $value Post type the taxonomy belongs to.
     */
    public function set_post_type( $value ) {

        $this->post_type = $value;

    }

    /* Singular Name
    ---------------------------------------------- */

    /**
     * Singular name of the taxonomy.
     *
     * @var string
     */
    private $singular_name = '';

    /**
     * Getter method for singular name.
     *
     * @return string Singular name of the taxonomy.
     */
    public function get_singular_name() {

        return $this->singular_name;

    }

    /**
     * Setter method for singular name.
     *
     * @param string $value Singular name of the taxonomy.
     */
    public function set_singular_name( $value ) {

        $this->singular_name = $value;

    }

    /* Slug
    ---------------------------------------------- */

    /**
     * Slug of the taxonomy.
     *
     * @var string
     */
    private $slug = '';

    /**
     * Getter method for slug.
     *
     * @return string Slug of the taxonomy.
     */
    public function get_slug() {

        return $this->slug;

    }

    /**
     * Setter method for slug.
     *
     * @param string $value Slug of the taxonomy.
     */
    public function set_slug( $value ) {

        $this->slug = $value;

    }

    /* Constructor
    ---------------------------------------------------------------------------------- */

    /**
     * Initializes plugin.
     */
    public function __construct( $singular = '', $plural = '', $slug = '', $post_type = '', $hierarchical = true ) {

        // Set properties
        $this->singular_name = $singular;
        $this->plural_name = $plural;
        $this->slug = $slug;
        $this->post_type = $post_type;
        $this->hierarchical = $hierarchical;

    }

    /* Methods
    ---------------------------------------------------------------------------------- */

    /**
     * Determines if required properties are populated or not.
     *
     * @return boolean Whether required properties are populated or not.
     */
    public function has_required_properties() {

        return (
            ! empty( $this->plural_name )
            && ! empty( $this->post_type )
            && ! empty( $this->singular_name )
            && ! empty( $this->slug )
        );

    }

}
