<?php
/**
 * @package WP_Recipe
 */

global $post;

$recipe_references = WP_Recipe_Cross_Reference_Recipes::get_instance();

$recipe_references_meta = get_post_meta( $post->ID, $recipe_references->get_meta_slug() );

$html = '';
$html .= '<section class="' . $recipe_references->get_slug() . '">';
    $html .= '<p>Below are a list of recipes who are referenced in this post.</p>';

    if ( empty( $recipe_references_meta ) ) {

        $html .= '<p class="empty">No recipes referenced in post.</p>';

    } else {

        $html .= '<ul>';

        foreach ( $recipe_references_meta as $recipe_id ) {

            $html .= '<li>';
                $html .= '<a href="' . get_edit_post_link( $recipe_id ) . '">' . get_the_title( $recipe_id ) . '</a>' ;
            $html .= '</li>';

        }

        $html .= '</ul>';

    }

$html .= '</section>';

echo $html;