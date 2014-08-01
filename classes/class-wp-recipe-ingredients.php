<?php
/**
 * @package WP_Recipe
 * @author Michael Novotny <manovotny@gmail.com>
 */

class WP_Recipe_Ingredients {

    /* Properties
    ---------------------------------------------------------------------------------- */

    /* Id
    ---------------------------------------------- */

    /**
     * Getter method for id.
     *
     * @return string Recipe ingredients id.
     */
    public function get_id() {

        return $this->slug;

    }

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

    /* Nonce
    ---------------------------------------------- */

    /**
     * Getter method for nonce.
     *
     * @return string Recipe ingredients nonce.
     */
    public function get_nonce() {

        return $this->slug . '-nonce';

    }

    /* Meta Slug
    ---------------------------------------------- */

    /**
     * Getter method for meta slug.
     *
     * @return string Recipe ingredients meta slug.
     */
    public function get_meta_slug() {

        return '_' . $this->slug;

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

    /* Methods
    ---------------------------------------------------------------------------------- */

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
            $html .= '<input class="item-control" type="text" value="' . $ingredient . '" placeholder="Ingredient"/>';
            $html .= '<ul class="actions">';
                $html .= '<li class="action-item">';
                    $html .= '<button class="' . $classes[ 'remove' ] . ' button">Remove</button>';
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

}
