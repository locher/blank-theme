<?php

if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
    'page_title'  => __('Global informations', 'idx_admin'),
    'menu_title' => __('Global informations', 'idx_admin'),
    'menu_slug' => 'global_informations',
    'capability' => 'edit_posts',
    'redirect' => false,
    'position' => 50
    ));
}
