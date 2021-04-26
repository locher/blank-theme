<?php

add_action('admin_enqueue_scripts', function($current_page) {

    $module_images_path = get_theme_file_uri() . '/dist/img/acf/';
    $placeholder = get_theme_file_uri() . '/dist/img/acf/no-preview.png';

    if ( $current_page != 'post.php' && $current_page != 'post-new.php' ) {
        return;
    }
    wp_enqueue_script( 'acf-admin-js', get_stylesheet_directory_uri().'/dist/js/admin/acf.js');
    wp_localize_script('acf-admin-js', 'adminLocal', ['img_path' => $module_images_path, 'placeholder' => $placeholder ]);
});
