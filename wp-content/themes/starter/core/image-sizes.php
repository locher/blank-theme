<?php

add_theme_support( 'post-thumbnails' );

if (function_exists('add_theme_support')) {
    // Add Menu Support
    add_theme_support('menus');

}

//Disable unused images sizes

function idx_remove_unused_image_sizes()
{
    remove_image_size('1536x1536');
    remove_image_size('2048x2048');
}

add_action('init', 'idx_remove_unused_image_sizes');


// Image sizes definitions

if (function_exists('add_theme_support')) {

    //Custom image size
    //add_image_size('my_custom_size', 960, 540, array('center', 'center', true));
}