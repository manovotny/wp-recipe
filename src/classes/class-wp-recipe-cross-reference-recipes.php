<?php

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

    /* Constructor
    ---------------------------------------------------------------------------------- */

    /**
     * Initialize class.
     */
    public function __construct() {

        add_action( 'add_meta_boxes_post', array( $this, 'add_meta_box' ) );

    }

    /* Methods
    ---------------------------------------------------------------------------------- */

    /**
     * Adds post cross reference meta box to recipes.
     */
    public function add_meta_box() {

        add_meta_box(
            $this->slug,
            'Recipe Cross References',
            array( $this, 'render' ),
            'post',
            'normal',
            'high'
        );

    }

    /**
     * Gets post meta key.
     *
     * @return string Recipe cross reference recipes post meta key.
     */
    public function get_post_meta_key() {

        return '_' . $this->slug;

    }

    /**
     * Renders meta box.
     */
    public function render() {

        global $post;

        $recipe_references_meta = get_post_meta( $post->ID, $this->get_post_meta_key() );

        echo '<section class="' . $this->slug . '">';
            echo '<p>Below are a list of recipes who are referenced in this post.</p>';

            if ( empty( $recipe_references_meta ) ) {

                echo '<p class="empty">No recipes referenced in post.</p>';

            } else {

                echo '<ul>';

                foreach ( $recipe_references_meta as $recipe_id ) {

                    echo '<li>';
                        echo '<a href="' . get_edit_post_link( $recipe_id ) . '">' . get_the_title( $recipe_id ) . '</a>' ;
                    echo '</li>';

                }

                echo '</ul>';

            }

        echo '</section>';

    }

    /**
     * Updates cross reference.
     *
     * @param $post_id
     * @param $recipe_ids
     */
    public function update( $post_id, $recipe_ids ) {

        delete_post_meta( $post_id, $this->get_post_meta_key() );

        $recipe_ids = array_unique( $recipe_ids );

        foreach ( $recipe_ids as $recipe_id ) {

            if ( $this->post_exists( $recipe_id ) ) {

                add_post_meta( $post_id, $this->get_post_meta_key(), $recipe_id );

            }

        }
    }

    /* Helpers
    ---------------------------------------------------------------------------------- */

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
