<?php
/**
 * @package WP_Recipe
 */

global $post;

$post_references = WP_Recipe_Cross_Reference_Posts::get_instance();

$post_references_meta = get_post_meta( $post->ID, $post_references->get_meta_slug() );

$html = '';
$html .= '<section class="' . $post_references->get_slug() . '">';
    $html .= '<p>Below are a list of posts who are referencing this recipe.</p>';

    if ( empty( $post_references_meta ) ) {

        $html .= '<p class="empty">No posts reference this recipe.</p>';

    } else {

        $html .= '<ul>';

        foreach ( $post_references_meta as $post_id ) {

            $html .= '<li>';
                $html .= '<a href="' . get_edit_post_link( $post_id ) . '">' . get_the_title( $post_id ) . '</a>' ;
            $html .= '</li>';

        }

        $html .= '</ul>';

    }

$html .= '</section>';

echo $html;