<?php
/**
 * @package WP_Recipe
 */

class WP_Recipe_Cross_Reference_Recipes {

    /* Properties
    ---------------------------------------------------------------------------------- */

    /* Instance
    ---------------------------------------------- */

    /**
     * Instance of the class.
     *
     * @var WP_Recipe_Cross_Reference_Recipes
     */
    protected static $instance = null;

    /**
     * Get accessor method for instance property.
     *
     * @return WP_Recipe_Cross_Reference_Recipes Instance of the class.
     */
    public static function get_instance() {

        if ( null == self::$instance ) {

            self::$instance = new self;

        }

        return self::$instance;

    }

    /* Slug
    ---------------------------------------------- */

    /**
     * Recipe cross reference slug.
     *
     * @var string
     */
    protected $slug = 'wp-recipe-cross-reference-recipes';

    /**
     * Getter method for slug.
     *
     * @return string Recipe cross reference slug.
     */
    public function get_slug() {

        return $this->slug;

    }

    /* Methods
    ---------------------------------------------------------------------------------- */

    /**
     * @param $post_id
     * @param $recipe_ids
     */
    public function update( $post_id, $recipe_ids ) {

        $post_references = WP_Recipe_Cross_Reference_Posts::get_instance();

        delete_post_meta( $post_id, $this->get_slug() );

        $recipe_ids = array_unique( $recipe_ids );

        foreach ( $recipe_ids as $recipe_id ) {

            if ( $this->post_exists( $recipe_id ) ) {

                add_post_meta( $post_id, $this->get_slug(), $recipe_id );

            }

        }
    }

    /**
     * Determines if a post exists or not.
     *
     * @param string $post_id The post id to check for existence.
     * @return boolean Whether or not the post exists.
     */
    private function post_exists( $post_id ) {

        return is_string( get_post_status( $post_id ) );

    }

}
