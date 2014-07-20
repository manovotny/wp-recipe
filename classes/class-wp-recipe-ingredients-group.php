<?php
/**
 * @package WP_Recipe
 * @author Michael Novotny <manovotny@gmail.com>
 */

class WP_Recipe_Ingredients_Group {

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

    /* Methods
    ---------------------------------------------------------------------------------- */

    /**
     * Generates markup for a given ingredient group.
     *
     * @param array $ingredient_group Ingredient group to generate markup for.
     * @return string Recipe ingredient group markup.
     */
    public function generate_markup( $ingredient_group ) {

        $wp_recipe_ingredients = WP_Recipe_Ingredients::get_instance();

        $group_classes = $this->get_classes();
        $ingredient_classes = $wp_recipe_ingredients->get_classes();

        $html = '';

        if ( ! empty( $ingredient_group ) ) {

            $html .= '<li class="' . 'ingredient-group' . '">';

                foreach ( $ingredient_group as $key => $ingredient ) {

                    if ( 'group' === $key ) {

                        $html .= '<label class="item-label">Ingredient Group</label>';
                        $html .= '<input class="item-control" type="text" value="' . $ingredient . '" />';
                        $html .= '<span class="item-action">';
                            $html .= '<button class="' . $group_classes[ 'remove' ] . ' button">Remove</button>';
                            $html .= '<button class="' . $ingredient_classes[ 'add' ] . ' button">Add</button>';
                        $html .= '</span>';
                        $html .= '<ul class="list">';

                    } else {

                        $html .= $wp_recipe_ingredients->generate_markup( $ingredient );

                    }

                }

                $html .= '</ul>';
            $html .= '</li>';

        }

        return $html;

    }

    /**
     * Gets recipe ingredients group classes.
     *
     * @return array List of recipe ingredients classes.
     */
    public function get_classes() {

        return array(
            'add'       => 'add-group',
            'remove'    => 'remove-group'
        );

    }

}
