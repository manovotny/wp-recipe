<?php

WP_Recipe_Cross_Reference_Posts::get_instance();
WP_Recipe_Cross_Reference_Recipes::get_instance();
WP_Recipe_Description::get_instance();
WP_Recipe_Difficulty::get_instance();
WP_Recipe_Directions::get_instance();
WP_Recipe_Enqueue_Admin_Scripts::get_instance();
WP_Recipe_Enqueue_Admin_Styles::get_instance();
WP_Recipe_Enqueue_Scripts::get_instance();
WP_Recipe_Enqueue_Styles::get_instance();
WP_Recipe_Grunticon::get_instance();
WP_Recipe_Id::get_instance();
WP_Recipe_Post_Type::get_instance();
WP_Recipe_Post_Type_Columns::get_instance();
WP_Recipe_Query::get_instance();
WP_Recipe_Shortcode::get_instance();
WP_Recipe_Taxonomies::get_instance();
WP_Recipe_Tips::get_instance();
WP_Recipe_Yield::get_instance();

require __DIR__ . '/admin/inc/meta-boxes/ingredients.php';
require __DIR__ . '/admin/inc/remove-default-discussion-meta-box.php';
require __DIR__ . '/admin/inc/remove-default-editor.php';
require __DIR__ . '/admin/inc/save-post.php';