<?php

class WP_Recipe_Enqueue_Admin_Scripts {

    /* Properties
    ---------------------------------------------------------------------------------- */

    /**
     * Instance of the class.
     *
     * @var WP_Recipe_Enqueue_Admin_Scripts
     */
    protected static $instance = null;

    /* Constructor
    ---------------------------------------------------------------------------------- */

    /**
     * Initialize class.
     */
    public function __construct() {

        add_action( 'admin_enqueue_scripts', array( $this, '__enqueue_scripts' ) );

    }

    /* Public
    ---------------------------------------------------------------------------------- */

    /**
     * Gets instance of class.
     *
     * @return WP_Recipe_Enqueue_Admin_Scripts Instance of the class.
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
     * Enqueues scripts.
     */
    public function __enqueue_scripts() {

        $this->enqueue_default_scripts();
        $this->enqueue_bundled_scripts();

    }

    /**
     * Enqueues bundled scripts.
     */
    private function enqueue_bundled_scripts() {

        $wp_enqueue_util = WP_Enqueue_Util::get_instance();
        $wp_recipe = WP_Recipe::get_instance();
        $wp_recipe_ingredients = WP_Recipe_Ingredients::get_instance();
        $wp_recipe_ingredients_group = WP_Recipe_Ingredients_Group::get_instance();

        $handle = $wp_recipe->get_slug() . '-admin-script';
        $relative_path = __DIR__ . '/../admin/js/';
        $filename = 'bundle.min.js';
        $filename_debug = 'bundle.concat.js';
        $dependencies = array( 'underscore' );

        $group_keys = $wp_recipe_ingredients_group->get_keys();

        $new_group = array(
            $group_keys[ 'group' ] => ''
        );

        $data = array(
            'ingredient' => array(
                'classes' => $wp_recipe_ingredients->get_classes(),
                'group' => array(
                    'classes' => $wp_recipe_ingredients_group->get_classes(),
                    'keys' => $group_keys,
                    'markup' => $wp_recipe_ingredients_group->generate_admin_markup( $new_group )
                ),
                'id' => WP_Recipe_Util::get_instance()->get_id( $wp_recipe_ingredients->get_slug() ),
                'markup' => $wp_recipe_ingredients->generate_admin_markup()
            )
        );

        $options = new WP_Enqueue_Options(
            $handle,
            $relative_path,
            $filename,
            $filename_debug,
            $dependencies,
            $wp_recipe->get_version(),
            true
        );

        $localization_name = WP_Recipe_Util::get_instance()->get_id( $wp_recipe->get_slug() );

        $options->set_localization( $localization_name, $data );

        $wp_enqueue_util->enqueue_script( $options );

    }

    /**
     * Enqueues default scripts.
     */
    private function enqueue_default_scripts() {

        wp_enqueue_script( 'jquery-ui-sortable' );

    }

}
