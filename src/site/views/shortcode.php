<?php

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

echo '<section class="recipe">';

    if ( ! empty( $title ) ) {

        echo '<h3 class="title">' . $title . '</h3>';

    }

    if ( shortcode_exists( 'pinit' ) ) {

        echo do_shortcode( '[pinit]' );

    }

    echo '<button class="print">Print Recipe</button>';

    if ( ! empty( $description ) ) {

        echo '<h4 class="description">' . $description . '</h4>';

    }

    if ( ! empty( $yield ) ) {

        echo '<section class="meta">';
           echo '<p>' . $yield . '</p>';
        echo '</section>';

    }

    if ( ! empty( $ingredients ) ) {

        echo '<section class="ingredients">';
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

        echo '<section class="directions">';
            echo '<h4>Directions</h4>';
            echo '<p>' . $directions . '</p>';
        echo '</section>';

    }

    if ( ! empty( $tips ) ) {

        echo '<section class="tips">';
            echo '<h4>Tips</h4>';
            echo '<p>' . $tips . '</p>';
        echo '</section>';

    }

    do_action( $actions[ 'after_recipe' ] );

echo '</section>';
