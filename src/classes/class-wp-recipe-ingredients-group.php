<?php

class WP_Recipe_Ingredients_Group {

    /* Properties
    ---------------------------------------------------------------------------------- */

    /**
     * Instance of the class.
     *
     * @var WP_Recipe_Ingredients
     */
    protected static $instance = null;

    /* Public
    ---------------------------------------------------------------------------------- */

    /**
     * Generates admin markup for a given ingredient group.
     *
     * @param array $ingredient_group Ingredient group to generate admin markup for.
     * @return string Recipe ingredient group admin markup.
     */
    public function generate_admin_markup( $ingredient_group ) {

        $wp_recipe_ingredients = WP_Recipe_Ingredients::get_instance();

        $group_classes = $this->get_classes();
        $ingredient_classes = $wp_recipe_ingredients->get_classes();

        $html = '';

        if ( ! empty( $ingredient_group ) ) {

            $html .= '<li class="' . $group_classes[ 'item' ] . '">';

                foreach ( $ingredient_group as $key => $ingredient ) {

                    if ( 'group' === $key ) {

                        $html .= '<label class="item-label">Ingredient Group</label>';
                        $html .= '<input class="item-control" type="text" value="' . esc_attr( $ingredient ) . '" placeholder="Ingredient Group"/>';
                        $html .= '<ul class="actions">';
                            $html .= '<li class="action-item">';
                                $html .= '<button class="' . $ingredient_classes[ 'add' ] . ' button">Add</button>';
                            $html .= '</li>';
                            $html .= '<li class="action-item">';
                                $html .= '<button class="' . $group_classes[ 'remove' ] . ' button">Remove</button>';
                            $html .= '</li>';
                            $html .= '<li class="action-item">';
                                $html .= '<span class="drag-handle"></span>';
                            $html .= '</li>';
                        $html .= '</ul>';
                        $html .= '<ul class="' . $group_classes[ 'list' ] . '">';

                    } else {

                        $html .= $wp_recipe_ingredients->generate_admin_markup( $ingredient );

                    }

                }

                $html .= '</ul>';
            $html .= '</li>';

        }

        return $html;

    }

    /**
     * Generates markup for a given ingredient group.
     *
     * @param array $ingredient_group Ingredient group to generate markup for.
     * @return string Recipe ingredient group markup.
     */
    public function generate_markup( $ingredient_group ) {

        $wp_recipe_ingredients = WP_Recipe_Ingredients::get_instance();

        $group_classes = $this->get_classes();

        $html = '';

        $html .= '<li class="' . $group_classes[ 'list' ] . '">';

            foreach ( $ingredient_group as $key => $ingredient ) {

                if ( 'group' === $key ) {

                    $html .= $ingredient;
                    $html .= '<ul>';

                } else {

                    $html .= $wp_recipe_ingredients->generate_markup( $ingredient );

                }

            }

            $html .= '</ul>';
        $html .= '</li>';

        return $html;

    }

    /**
     * Gets recipe ingredients group classes.
     *
     * @return array List of recipe ingredients group classes.
     */
    public function get_classes() {

        return array(
            'add'    => 'add-group',
            'item'   => 'group',
            'list'   => 'ingredients-group',
            'remove' => 'remove-group'
        );

    }

    /**
     * Gets instance of class.
     *
     * @return WP_Recipe_Ingredients Instance of the class.
     */
    public static function get_instance() {

        if ( null == self::$instance ) {

            self::$instance = new self;

        }

        return self::$instance;

    }

    /**
     * Gets recipe ingredients group keys.
     *
     * @return array List of recipe ingredients group keys.
     */
    public function get_keys() {

        return array(
            'group' => 'group'
        );

    }

}
