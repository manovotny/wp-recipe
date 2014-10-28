<?php

class WP_Recipe_Cross_Reference_Posts {

    /* Properties
    ---------------------------------------------------------------------------------- */

    /* Instance
    ---------------------------------------------- */

    /**
     * Instance of the class.
     *
     * @var WP_Recipe_Cross_Reference_Posts
     */
    protected static $instance = null;

    /**
     * Get accessor method for instance property.
     *
     * @return WP_Recipe_Cross_Reference_Posts Instance of the class.
     */
    public static function get_instance() {

        if ( null == self::$instance ) {

            self::$instance = new self;

        }

        return self::$instance;

    }

    /* Meta Slug
    ---------------------------------------------- */

    /**
     * Getter method for meta slug.
     *
     * @return string Recipe post cross reference meta slug.
     */
    public function get_meta_slug() {

        return '_' . $this->slug;

    }

    /* Slug
    ---------------------------------------------- */

    /**
     * Recipe post cross reference slug.
     *
     * @var string
     */
    protected $slug = 'wp-recipe-cross-reference-posts';

    /**
     * Getter method for slug.
     *
     * @return string Recipe post cross reference slug.
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
    public function update( $post_id, $recipe_ids )
    {
        $recipe_references = WP_Recipe_Cross_Reference_Recipes::get_instance();
        $post_references = WP_Recipe_Cross_Reference_Posts::get_instance();

        $previous_recipe_ids = get_post_meta( $post_id, $recipe_references->get_meta_slug() );

        $recipe_ids_removed = array_diff( $previous_recipe_ids, $recipe_ids );

        foreach ( $recipe_ids_removed as $recipe_id ) {

            delete_post_meta( $recipe_id, $post_references->get_meta_slug(), $post_id );

        }

        foreach ( $recipe_ids as $recipe_id ) {

            if ( $this->post_exists( $recipe_id ) ) {

                $post_references_meta = get_post_meta( $recipe_id, $post_references->get_meta_slug() );

                if ( ! in_array( $post_id, $post_references_meta ) ) {

                    add_post_meta( $recipe_id, $post_references->get_meta_slug(), $post_id );

                }

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
