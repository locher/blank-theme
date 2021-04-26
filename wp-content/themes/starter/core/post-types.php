<?php

//add_action('init', 'sfam_custom_post_type');

function sfam_custom_post_type()
{
    register_post_type('offers', array(
        'labels' => array(
            'name' => 'Offres',
        ),
        'public' => true,
        'publicly_queryable' => false,
        'hierarchical' => false, //true for pages, false for posts
        'has_archive' => false,
        'supports' => array(
            'title',
            'page-attributes'
        ),
        'can_export' => true,
        'menu_position' => 25,
        'menu_icon' => 'dashicons-cart',
    ));
}