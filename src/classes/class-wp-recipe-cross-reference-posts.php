<?php

class WP_Recipe_Cross_Reference_Posts {

    /* Properties
    ---------------------------------------------------------------------------------- */

    /**
     * Instance of the class.
     *
     * @var WP_Recipe_Cross_Reference_Posts
     */
    protected static $instance = null;

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

    /* Public
    ---------------------------------------------------------------------------------- */

    /**
     * Gets instance of class.
     *
     * @return WP_Recipe_Cross_Reference_Posts Instance of the class.
     */
    public static function get_instance() {

        if ( null == self::$instance ) {

            self::$instance = new self;

        }

        return self::$instance;

    }

    /**
     * Updates cross reference.
     *
     * @param string $post_id Post id.
     * @param array $recipe_ids_used_in_post Recipe ids used in the post.
     */
    public function update( $post_id, $recipe_ids_used_in_post ) {

        $this->remove_post_reference_from_recipes_removed_from_post( $post_id, $recipe_ids_used_in_post );

        $this->add_post_reference_to_recipes_used_in_post( $post_id, $recipe_ids_used_in_post );
    }

    /* Private
    ---------------------------------------------------------------------------------- */

    /**
     * Adds post cross reference meta box to recipes.
     */
    public function add_meta_box() {

        add_meta_box(
            $this->slug,
            'Post Cross References',
            array( $this, 'render' ),
            WP_Recipe_Post_Type::get_instance()->get_post_type(),
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
     * Adds a post reference to a recipe.
     *
     * @param string $post_id Post id.
     * @param string $recipe_id Recipe id.
     */
    private function add_post_reference_to_recipe( $post_id, $recipe_id ) {

        add_post_meta( $recipe_id, '_wp-recipe-cross-reference-posts', $post_id );

    }

    /**
     * Adds a post referenced to recipes used in a post.
     *
     * @param string $post_id Post id.
     * @param array $recipe_ids_used_in_post Recipe ids used in the post.
     */
    private function add_post_reference_to_recipes_used_in_post( $post_id, $recipe_ids_used_in_post ) {

        foreach ( $recipe_ids_used_in_post as $recipe_id ) {

            if ( WP_Recipe_Util::get_instance()->recipe_exists( $recipe_id ) && ! $this->is_post_a_recipe_reference( $post_id, $recipe_id ) ) {

                $this->add_post_reference_to_recipe( $post_id, $recipe_id );

            }

        }

    }

    /**
     * Gets recipes removed from post.
     *
     * @param string $post_id Post id.
     * @param array $recipe_ids_used_in_post Recipe ids used in the post.
     *
     * @return array Recipes removed from post.
     */
    private function get_recipes_removed_from_post( $post_id, $recipe_ids_used_in_post ) {

        $previous_recipe_ids_used_in_post = get_post_meta( $post_id, '_wp-recipe-cross-reference-recipes' );

        return array_diff( $previous_recipe_ids_used_in_post, $recipe_ids_used_in_post );

    }

    /**
     * Determines whether a post is a reference on a recipe or not.
     *
     * @param string $post_id Post id.
     * @param string $recipe_id Recipe id.
     *
     * @return boolean Whether a post is a reference on a recipe or not.
     */
    private function is_post_a_recipe_reference( $post_id, $recipe_id ) {

        $posts_referencing_recipe = get_post_meta( $recipe_id, '_wp-recipe-cross-reference-posts' );

        return in_array( $post_id, $posts_referencing_recipe );

    }

    /**
     * Removes a post reference from a recipe.
     *
     * @param string $post_id Post id.
     * @param string $recipe_id Recipe id.
     */
    private function remove_post_reference_from_recipe( $recipe_id, $post_id ) {

        delete_post_meta( $recipe_id, '_wp-recipe-cross-reference-posts', $post_id );

    }

    /**
     * Removes a post reference from recipes that were removed from the post.
     *
     * @param string $post_id Post id.
     * @param array $recipe_ids_used_in_post Recipe ids used in the post.
     */
    private function remove_post_reference_from_recipes_removed_from_post( $post_id, $recipe_ids_used_in_post ) {

        $recipe_ids_removed_from_post = $this->get_recipes_removed_from_post( $post_id, $recipe_ids_used_in_post );

        foreach ( $recipe_ids_removed_from_post as $recipe_id ) {

            $this->remove_post_reference_from_recipe( $recipe_id, $post_id );

        }

    }

}
