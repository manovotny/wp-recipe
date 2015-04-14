<?php

class WP_Recipe_Cross_Reference_Recipes {

    /* Properties
    ---------------------------------------------------------------------------------- */

    /**
     * Instance of the class.
     *
     * @var WP_Recipe_Cross_Reference_Recipes
     */
    protected static $instance = null;

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

    /* Public
    ---------------------------------------------------------------------------------- */

    /**
     * Gets instance of class.
     *
     * @return WP_Recipe_Cross_Reference_Recipes Instance of the class.
     */
    public static function get_instance() {

        if ( null == self::$instance ) {

            self::$instance = new self;

        }

        return self::$instance;

    }

    /* Private
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
     * Renders meta box.
     */
    public function render() {

        global $post;

        $recipe_references_meta = get_post_meta( $post->ID, WP_Recipe_Util::get_instance()->get_post_meta_key( $this->slug ) );

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
     * @param string $post_id Post id.
     * @param array $recipe_ids_used_in_post Recipe ids used in the post.
     */
    public function update( $post_id, $recipe_ids_used_in_post ) {

        $this->remove_all_recipe_references_from_post( $post_id );

        $this->add_recipe_reference_to_posts_using_the_recipe( $post_id, $recipe_ids_used_in_post );
    }

    /**
     * Adds a recipe reference to a post.
     *
     * @param string $post_id Post id.
     * @param string $recipe_id Recipe id.
     */
    private function add_recipe_reference_to_post( $post_id, $recipe_id ) {

        add_post_meta( $post_id, '_wp-recipe-cross-reference-recipes', $recipe_id );

    }

    /**
     * Adds a recipe reference to posts using the recipe.
     *
     * @param string $post_id Post id.
     * @param array $recipe_ids_used_in_post Recipe ids used in the post.
     */
    private function add_recipe_reference_to_posts_using_the_recipe( $post_id, $recipe_ids_used_in_post ) {

        $recipe_ids_used_in_post = array_unique( $recipe_ids_used_in_post );

        foreach ( $recipe_ids_used_in_post as $recipe_id ) {

            if ( WP_Recipe_Util::get_instance()->recipe_exists( $recipe_id ) ) {

                $this->add_recipe_reference_to_post( $post_id, $recipe_id );

            }

        }

    }

    /**
     * Removes all recipe references fro ma post.
     *
     * @param string $post_id Post id.
     */
    private function remove_all_recipe_references_from_post( $post_id ) {

        delete_post_meta( $post_id, '_wp-recipe-cross-reference-recipes' );

    }

}
