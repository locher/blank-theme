<?php

function idx_register_menu()
{
    register_nav_menus(array(
        'main' => __('Main menu', 'idx'),
        'footer' => __('Footer menu', 'idx')
    ));
}

add_action('init', 'idx_register_menu');

