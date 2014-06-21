<?php
/**
 * @package WP_Array_Util
 */

class WP_Array_Util {

    /* Properties
    ---------------------------------------------------------------------------------- */

    /* Instance
    ---------------------------------------------- */

    /**
     * Instance of the class.
     *
     * @var WP_Array_Util
     */
    protected static $instance = null;

    /**
     * Get accessor method for instance property.
     *
     * @return WP_Array_Util Instance of the class.
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
     * Adds item(s) to an existing array at a specified index.
     *
     * @param array $existing_array Existing array to add new item(s) to.
     * @param array $items_to_add New item(s) to add.
     * @param integer $index Index where to add new item(s).
     * @return array New array with new item(s) added.
     */
    public function add_items_at_index( $existing_array, $items_to_add, $index = -1 ) {

        if ( empty( $existing_array ) ) {

            return $items_to_add;
        }

        if ( empty( $items_to_add ) ) {

            return $existing_array;
        }

        $highest_available_index = count( $existing_array ) - 1;

        if ( -1 >= $index || $index > $highest_available_index ) {

            return array_merge( $existing_array, $items_to_add );

        }

        $start = array_slice( $existing_array, 0, $index );
        $end = array_slice( $existing_array, $index );

        return array_merge( $start, $items_to_add, $end );

    }
}
