<?php

global $post;

$wp_recipe_yield = WP_Recipe_Yield::get_instance();

wp_nonce_field( $wp_recipe_yield->get_slug(), $wp_recipe_yield->get_nonce() );

$yield = get_post_meta( $post->ID, $wp_recipe_yield->get_meta_slug(), true );

$html = '';

$html .= '<fieldset class="' . $wp_recipe_yield->get_slug() . '">';
    $html .= '<ul class="list">';
        $html .= '<li class="list-item">';
            $html .= '<label class="item-label" for="' . $wp_recipe_yield->get_id() . '">Yield</label>';
            $html .= '<input class="item-control" id="' . $wp_recipe_yield->get_id() . '" name="' . $wp_recipe_yield->get_id() . '" type="text" value="' . $yield . '" />';
        $html .= '</li>';
    $html .= '</ul>';
$html .= '</fieldset>';

echo $html;