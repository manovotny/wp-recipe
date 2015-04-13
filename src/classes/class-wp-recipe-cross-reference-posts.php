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

    /* Slug
    ---------------------------------------------- */

    /**
     * Recipe post cross reference slug.
     *
     * @var string
     */
    protected $slug = 'wp-recipe-cross-reference-posts';

    /* Constructor
    ---------------------------------------------------------------------------------- */

    /**
     * Initialize class.
     */
    public function __construct() {

        add_action( 'add_meta_boxes_recipe', array( $this, 'add_meta_box' ) );

    }

    /* Methods
    ---------------------------------------------------------------------------------- */

    /**
     * Adds post cross reference meta box to recipes.
     */
    public function add_meta_box() {

        $wp_recipe = WP_Recipe::get_instance();

        add_meta_box(
            $this->slug,
            'Post Cross References',
            array( $this, 'render' ),
            $wp_recipe->get_post_type(),
            'normal',
            'high'
        );

    }

    /**
     * Renders meta box.
     */
    public function render() {

        global $post;

        $post_references_meta = get_post_meta( $post->ID, WP_Recipe_Util::get_instance()->get_post_meta_key( $this->slug ) );

        echo '<section class="' . $this->slug . '">';
            echo '<p>Below are a list of posts who are referencing this recipe.</p>';

            if ( empty( $post_references_meta ) ) {

                echo '<p class="empty">No posts reference this recipe.</p>';

            } else {

                echo '<ul>';

                    foreach ( $post_references_meta as $post_id ) {

                        echo '<li>';
                            echo '<a href="' . get_edit_post_link( $post_id ) . '">' . get_the_title( $post_id ) . '</a>' ;
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

        $wp_recipe_util = WP_Recipe_Util::get_instance();

        $post_meta_key = $wp_recipe_util->get_post_meta_key( $this->slug );

        $previous_recipe_ids = get_post_meta( $post_id, $post_meta_key );

        $recipe_ids_removed = array_diff( $previous_recipe_ids, $recipe_ids );

        foreach ( $recipe_ids_removed as $recipe_id ) {

            delete_post_meta( $recipe_id, $post_meta_key, $post_id );

        }

        foreach ( $recipe_ids as $recipe_id ) {

            if ( $wp_recipe_util->post_exists( $recipe_id ) ) {

                $post_references_meta = get_post_meta( $recipe_id, $post_meta_key );

                if ( ! in_array( $post_id, $post_references_meta ) ) {

                    add_post_meta( $recipe_id, $post_meta_key, $post_id );

                }

            }

        }
    }

}
