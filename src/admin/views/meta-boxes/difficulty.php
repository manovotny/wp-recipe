<?php

global $post;

$wp_recipe_difficulty = WP_Recipe_Difficulty::get_instance();

wp_nonce_field( $wp_recipe_difficulty->get_slug(), $wp_recipe_difficulty->get_nonce() );

$difficulty = get_post_meta( $post->ID, $wp_recipe_difficulty->get_meta_slug(), true );

$html = '';

$html .= '<fieldset class="' . $wp_recipe_difficulty->get_slug() . '">';
    $html .= '<label class="item-label" for="' . $wp_recipe_difficulty->get_id() . '">Difficulty</label>';
    $html .= '<select id="' . $wp_recipe_difficulty->get_id() . '" class="item-control" name="' . $wp_recipe_difficulty->get_id() . '">';

        $options = $wp_recipe_difficulty->get_options();
        foreach ( $options as $key => $value )  {

            $html .= '<option value="' . $key . '" ' . selected( $difficulty, $key, false ) . '>';
                $html .= $value;
            $html .= '</option>';

        }

    $html .= '</select>';
$html .= '</fieldset>';

echo $html;
