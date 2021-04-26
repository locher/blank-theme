<?php

require_once( __DIR__ . '/../vendor/autoload.php' );
$timber = new Timber\Timber();

// Global context, available to all templates

function add_to_context($context) {

    // WP Templates
    $context['wp']['template'] = array(
        'front_page' => is_front_page(),
        'blog' => is_home(),
    );

    //Add mainMenu to Timber context
    global $mainMenu, $footerMenu;
    $context['menus']['main'] = wp_nav_menu(array(
        'echo' => false,
        'menu_class' => 'main-menu',
        'theme_location' => 'main'
    ));
    $context['menus']['footer'] = wp_nav_menu(array(
        'echo' => false,
        'menu_class' => 'footer-menu',
        'theme_location' => 'footer'
    ));;

    //Options pages
    $context['options'] = get_fields('option');

    return $context;
}

add_filter('timber/context','add_to_context');

// Custom functions

require_once ABSPATH . 'wp-admin/includes/plugin.php';

if(!is_admin() && getenv('WP_ENV') === 'development'){
    add_filter( 'timber/twig', 'idx_add_kint_d' );
}

// Add d function (Require Kint debuger plugin)

function idx_add_kint_d( $twig ) {
    $twig->addFunction( new Timber\Twig_Function( 'd', 'd' ) );
    return $twig;
}
