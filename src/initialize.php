<?php

WP_Recipe::get_instance();

require __DIR__ . '/admin/inc/enqueue-scripts.php';
require __DIR__ . '/admin/inc/enqueue-styles.php';
require __DIR__ . '/admin/inc/meta-boxes/cross-reference-posts.php';
require __DIR__ . '/admin/inc/meta-boxes/cross-reference-recipes.php';
require __DIR__ . '/admin/inc/meta-boxes/description.php';
require __DIR__ . '/admin/inc/meta-boxes/directions.php';
require __DIR__ . '/admin/inc/meta-boxes/id.php';
require __DIR__ . '/admin/inc/meta-boxes/ingredients.php';
require __DIR__ . '/admin/inc/meta-boxes/tips.php';
require __DIR__ . '/admin/inc/meta-boxes/yield.php';
require __DIR__ . '/admin/inc/post-type.php';
require __DIR__ . '/admin/inc/post-type-columns.php';
require __DIR__ . '/admin/inc/remove-default-discussion-meta-box.php';
require __DIR__ . '/admin/inc/remove-default-editor.php';
require __DIR__ . '/admin/inc/save-post.php';
require __DIR__ . '/admin/inc/shortcode.php';
require __DIR__ . '/admin/inc/taxonomies.php';