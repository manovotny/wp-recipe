<?php
    add_filter( 'manage_recipe_posts_columns', array( $this, 'recipes_custom_post_type_columns' ) );
    add_action( 'manage_recipe_posts_custom_column', array( $this, 'recipes_custom_post_type_columns_content' ), 10, 2 );

    public function recipes_custom_post_type_columns( $columns ) {

        // Add custom columns.
        $custom_columns[ 'recipe_id' ] = 'Id';

        // Position custom columns right after title column.
        return $this->array_add_at_index( $columns, $custom_columns );

        // Add custom columns.
        $columns[ 'recipe_id' ] = 'Id';

        return $columns;

    }

    public function recipes_custom_post_type_columns_content( $column, $post_id ) {

        if ( $column == 'recipe_id' ) {

            // Display recipe id.
            echo '<span>' . $post_id . '</span>';

        }

    }

    private function array_add_at_index( $array, $add, $index = -1 ) {

        // Create merged.
        $merged = array();

        // Get start.
        $start = array_slice( $array, 0, $index );

        // Get end.
        $end = array_slice( $array, $index );

        // Merge.
        $merged = array_merge( $merged, $start );
        $merged = array_merge( $merged, $add );
        $merged = array_merge( $merged, $end );

        // Return merged.
        return $merged;

    }