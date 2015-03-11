<?php

class WP_Recipe_Index {

    /* Properties
    ---------------------------------------------------------------------------------- */

    /* Instance
    ---------------------------------------------- */

    /**
     * Instance of the class.
     *
     * @var WP_Recipe_Index
     */
    protected static $instance = null;

    /**
     * Get accessor method for instance property.
     *
     * @return WP_Recipe_Index Instance of the class.
     */
    public static function get_instance() {

        if ( null == self::$instance ) {

            self::$instance = new self;

        }

        return self::$instance;

    }

    /* Methods
    ---------------------------------------------------------------------------------- */

    /**
     * Displays the recipe index, broken into taxonomy sections and their terms.
     */
    public function display() {

        $taxonomies = WP_Recipe_Taxonomies::get_instance()->get_taxonomies();

        foreach ( $taxonomies as $taxonomy ) {

            $this->generate_markup( $taxonomy );

        }

    }

    /* Helpers
    ---------------------------------------------------------------------------------- */

    /**
     * Generates the recipe index markup for a given taxonomy.
     *
     * @param $taxonomy_slug string Taxonomy slug to generate markup for.
     */
    function generate_markup( $taxonomy_slug ) {

        $terms = get_terms( $taxonomy_slug );

        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {

            $taxonomy = get_taxonomy( $taxonomy_slug );

            echo '<h3>' . $taxonomy->label . '</h3>';
            echo '<ul>';

                foreach ( $terms as $term ) {

                    echo '<li>';
                        echo '<a href="' . get_term_link( $term ) . '" title="View all recipes for ' . $term->name . '">' . $term->name . '</a>';
                    echo '</li>';

                }

            echo '</ul>';
        }
    }

}
