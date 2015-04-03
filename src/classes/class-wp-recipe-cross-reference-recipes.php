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

    /* Meta Slug
    ---------------------------------------------- */

    /**
     * Getter method for meta slug.
     *
     * @return string Recipe cross reference meta slug.
     */
    public function get_meta_slug() {

        return '_' . $this->slug;

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

        $recipe_references = WP_Recipe_Cross_Reference_Recipes::get_instance();

        add_meta_box(
            $recipe_references->get_slug(),
            'Recipe Cross References',
            array( $this, 'render' ),
            'post',
            'normal',
            'high'
        );

    }

    /**
     * Renders meta box.
     */
    public function render() {

        global $post;

        $recipe_references = WP_Recipe_Cross_Reference_Recipes::get_instance();

        $recipe_references_meta = get_post_meta( $post->ID, $recipe_references->get_meta_slug() );

        echo '<section class="' . $recipe_references->get_slug() . '">';
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

        delete_post_meta( $post_id, $this->get_meta_slug() );

        $recipe_ids = array_unique( $recipe_ids );

        foreach ( $recipe_ids as $recipe_id ) {

            if ( $this->post_exists( $recipe_id ) ) {

                add_post_meta( $post_id, $this->get_meta_slug(), $recipe_id );

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
