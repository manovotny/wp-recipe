<?php

class WP_Recipe_Shortcode {

    /* Properties
    ---------------------------------------------------------------------------------- */

    /* Instance
    ---------------------------------------------- */

    /**
     * Instance of the class.
     *
     * @var WP_Recipe_Shortcode
     */
    protected static $instance = null;

    /**
     * Get accessor method for instance property.
     *
     * @return WP_Recipe_Shortcode Instance of the class.
     */
    public static function get_instance() {

        if ( null == self::$instance ) {

            self::$instance = new self;

        }

        return self::$instance;

    }

    /* Constructor
    ---------------------------------------------------------------------------------- */

    /**
     * Initialize class.
     */
    public function __construct() {

        add_shortcode( WP_Recipe::get_instance()->get_shortcode(), array( $this, 'render' ) );

    }

    /* Methods
    ---------------------------------------------------------------------------------- */

    /**
     * Renders recipe shortcode.
     *
     * @param array $attributes Shortcode attributes.
     * @return string Rendered shortcode.
     */
    public function render( $attributes ) {

        ob_start();

        $this->get_template( $attributes );

        $html = ob_get_contents();

        ob_end_clean();

        return $html;

    }

    /* Helpers
    ---------------------------------------------------------------------------------- */

    /**
     * Gets recipe shortcode template.
     *
     * @param array $attributes Shortcode attributes.
     * @return string Shortcode template.
     */
    private function get_template( $attributes ) {

        extract(
            shortcode_atts(
                array(
                    'id' => ''
                ),
                $attributes
            )
        );

        if ( empty( $id ) ) {

            return '';

        }

        $recipe_post_meta = get_post_meta( $id );

        if ( empty( $recipe_post_meta ) ) {

            return '';

        }

        $wp_recipe = WP_Recipe::get_instance();
        $wp_recipe_description = WP_Recipe_Description::get_instance();
        $wp_recipe_directions = WP_Recipe_Directions::get_instance();
        $wp_recipe_ingredients = WP_Recipe_Ingredients::get_instance();
        $wp_recipe_ingredients_group = WP_Recipe_Ingredients_Group::get_instance();
        $wp_recipe_tips = WP_Recipe_Tips::get_instance();
        $wp_recipe_yield = WP_Recipe_Yield::get_instance();

        $actions = $wp_recipe->get_actions();

        $title = get_the_title( $id );
        $description = $recipe_post_meta[ $wp_recipe_description->get_meta_slug() ][ 0 ];
        $directions = $recipe_post_meta[ $wp_recipe_directions->get_meta_slug() ][ 0 ];
        $ingredients = maybe_unserialize( $recipe_post_meta[ $wp_recipe_ingredients->get_meta_slug() ][ 0 ] );
        $tips = $recipe_post_meta[ $wp_recipe_tips->get_meta_slug() ][ 0 ];
        $yield = $recipe_post_meta[ $wp_recipe_yield->get_meta_slug() ][ 0 ];

        echo '<div class="recipe">';

            if ( ! empty( $title ) ) {

                echo '<h3 class="recipe-title">' . $title . '</h3>';

            }

            echo '<ul class="recipe-controls">';

            if ( shortcode_exists( 'pinit' ) ) {

                echo '<li>';
                    echo do_shortcode( '[pinit]' );
                echo '</li>';

            }

            echo '</ul>';

            if ( ! empty( $yield ) ) {

                echo '<section class="recipe-meta">';
                    echo '<p class="recipe-yield">' . $yield . '</p>';
                echo '</section>';

            }

            if ( ! empty( $description ) ) {

                echo '<div class="recipe-description">';
                    echo '<h4>Description</h4>';
                    echo '<p>' . $description . '</p>';
                echo '</div>';

            }

            if ( ! empty( $ingredients ) ) {

                echo '<section class="recipe-ingredients">';
                    echo '<h4>Ingredients</h4>';
                    echo '<ul>';

                        foreach ( $ingredients as $item ) {

                            if ( is_array( $item ) ) {

                                echo $wp_recipe_ingredients_group->generate_markup( $item );

                            } else {

                                echo $wp_recipe_ingredients->generate_markup( $item );

                            }

                        }

                    echo '</ul>';
                echo '</section>';

            }

            if ( ! empty( $directions ) ) {

                echo '<section class="recipe-directions">';
                    echo '<h4>Directions</h4>';
                    echo '<p>' . $directions . '</p>';
                echo '</section>';

            }

            if ( ! empty( $tips ) ) {

                echo '<section class="recipe-tips">';
                    echo '<h4>Notes</h4>';
                    echo '<p>' . $tips . '</p>';
                echo '</section>';

            }

            echo '<section class="recipe-after">';
                do_action( $actions[ 'after_recipe' ] );
            echo '</section>';

        echo '</div>';

    }

}
