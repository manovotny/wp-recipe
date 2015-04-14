<?php

class WP_Recipe_Ingredients {

    /* Properties
    ---------------------------------------------------------------------------------- */

    /* Instance
    ---------------------------------------------- */

    /**
     * Instance of the class.
     *
     * @var WP_Recipe_Ingredients
     */
    protected static $instance = null;

    /**
     * Get accessor method for instance property.
     *
     * @return WP_Recipe_Ingredients Instance of the class.
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
     * Recipe ingredients slug.
     *
     * @var string
     */
    protected $slug = 'wp-recipe-ingredients';

    /**
     * Getter method for slug.
     *
     * @return string Recipe ingredients slug.
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

        add_action( 'add_meta_boxes_recipe', array( $this, 'add_meta_box' ) );
        add_action( 'save_post_' . WP_Recipe::get_instance()->get_post_type(), array( $this, 'save' ) );

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
            'Ingredients',
            array( $this, 'render_meta_box' ),
            $wp_recipe->get_post_type(),
            'normal',
            'high'
        );

    }

    /**
     * Generates admin markup for a given ingredient.
     *
     * @param string $ingredient Optional. Ingredient value to added to admin markup.
     * @return string Recipe ingredient admin markup.
     */
    public function generate_admin_markup( $ingredient = '' ) {

        $classes = $this->get_classes();

        $html = '';

        $html .= '<li class="' . $classes[ 'item' ] . '">';
            $html .= '<label class="item-label">Ingredient</label>';
            $html .= '<input class="item-control" type="text" value="' . esc_attr( $ingredient ) . '" placeholder="Ingredient"/>';
            $html .= '<ul class="actions">';
                $html .= '<li class="action-item">';
                    $html .= '<button class="' . $classes[ 'remove' ] . ' button">Remove</button>';
                $html .= '</li>';
                $html .= '<li class="action-item">';
                    $html .= '<span class="drag-handle"></span>';
                $html .= '</li>';
            $html .= '</ul>';
        $html .= '</li>';

        return $html;

    }

    /**
     * Generates markup for a given ingredient.
     *
     * @param string $ingredient Optional. Ingredient value to added to markup.
     * @return string Recipe ingredient markup.
     */
    public function generate_markup( $ingredient ) {

        return '<li>' . $ingredient . '</li>';

    }

    /**
     * Gets recipe ingredients classes.
     *
     * @return array List of recipe ingredients classes.
     */
    public function get_classes() {

        return array(
            'add'    => 'add-ingredient',
            'item'   => 'ingredient',
            'list'   => 'ingredients',
            'remove' => 'remove-ingredient'
        );

    }

    /**
     * Renders meta box.
     */
    public function render_meta_box() {

        global $post;

        $wp_recipe_ingredients_group = WP_Recipe_Ingredients_Group::get_instance();

        wp_nonce_field( $this->slug, WP_Recipe_Util::get_instance()->get_nonce( $this->slug ) );

        $ingredients = maybe_unserialize( get_post_meta( $post->ID, WP_Recipe_Util::get_instance()->get_post_meta_key( $this->slug ), true ) );
        $ingredients_classes = $this->get_classes();
        $ingredients_group_classes = $wp_recipe_ingredients_group->get_classes();

        echo '<fieldset class="' . $this->slug . '">';
            echo '<section class="toolbar">';
                echo '<ul class="actions">';
                    echo '<li class="action-item">';
                        echo '<button class="' . $ingredients_classes[ 'add' ] . ' button">Add Ingredient</button>';
                    echo '</li>';
                    echo '<li class="action-item">';
                        echo '<button class="' . $ingredients_group_classes[ 'add' ] . ' button">Add Group</button>';
                    echo '</li>';
                echo '</ul>';
            echo '</section>';
            echo '<div class="editor">';
                echo '<ul class="list ' . $ingredients_classes[ 'list' ] . '">';

                    if ( ! empty( $ingredients ) ) {

                        foreach ( $ingredients as $item ) {

                            if ( is_array( $item ) ) {

                                echo $wp_recipe_ingredients_group->generate_admin_markup( $item );

                            } else {

                                echo $this->generate_admin_markup( $item );

                            }

                        }

                    }

                echo '</ul>';
            echo '</div>';
        echo '</fieldset>';

    }

    /**
     * Renders shortcode.
     *
     * @param array $post_meta Recipe post meta.
     */
    public function render_shortcode( $post_meta ) {

        $wp_recipe_ingredients_group = WP_Recipe_Ingredients_Group::get_instance();

        $post_meta_key = WP_Recipe_Util::get_instance()->get_post_meta_key( $this->slug );

        $value = maybe_unserialize( $post_meta[ $post_meta_key ][ 0 ] );

        if ( ! empty( $value ) ) {

            echo '<section class="recipe-ingredients">';
                echo '<h4>Ingredients</h4>';
                echo '<ul>';

                    foreach ( $value as $item ) {

                        if ( is_array( $item ) ) {

                            echo $wp_recipe_ingredients_group->generate_markup( $item );

                        } else {

                            echo $this->generate_markup( $item );

                        }

                    }

                echo '</ul>';
            echo '</section>';

        }

    }

    /**
     * Saves meta box.
     *
     * @param string $post_id Post id.
     */
    public function save( $post_id ) {

        $post_type = WP_Recipe::get_instance()->get_post_type();

        WP_Recipe_Util::get_instance()->save_meta_box( $post_type, $post_id, $this->slug );

    }

}
