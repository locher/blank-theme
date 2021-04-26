<?php

// Add Breadcrumb in almost every page

function idx_breadcrumb()
{
    //Change the pages you want the breadcrumb to display
    if (!is_admin() && !is_front_page()) {
        if (function_exists('yoast_breadcrumb')) {
            yoast_breadcrumb('<nav class="breadcrumb">', '</nav>');
        }
    }
}

add_action('idx_breacrumb_place', 'idx_breadcrumb');