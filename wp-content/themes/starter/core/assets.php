<?php

//-----------------------------------------------------
// JAVASCRIPT
//-----------------------------------------------------

function idx_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
        if (getenv('WP_ENV') == 'production') {
            $file_name = 'scripts.min.js';
        } else {
            $file_name = 'scripts.js';
        }

        wp_register_script('scripts-vendors', get_theme_file_uri() . '/dist/js/'.$file_name, array('jquery-core'), '1.0.0', true);
        wp_enqueue_script('scripts-vendors');
    }
}

add_action('wp_enqueue_scripts', 'idx_scripts');

// Load conditional scripts
function idx_conditional_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
        if (getenv('WP_ENV') == 'production') {
            $file_name = 'custom-scripts.min.js';
        } else {
            $file_name = 'custom-scripts.js';
        }

        if (is_page('pagenamehere')) {
            wp_register_script('scriptname', get_theme_file_uri() . '/dist/js/' . $file_name, array('jquery-core'), '1.0.0', true);
            wp_enqueue_script('scriptname');
        }
    }
}

//add_action('wp_enqueue_scripts', 'idx_conditional_scripts');

//-----------------------------------------------------
// CSS
//-----------------------------------------------------

function idx_styles()
{

    if (getenv('WP_ENV') == 'production') {
        $file_name = 'style.min.css';
    } else {
        $file_name = 'style.css';
    }

    wp_register_style('blanktheme', get_theme_file_uri() . '/dist/'.$file_name, array(), '1.0', 'all');
    wp_enqueue_style('blanktheme');
}

add_action('wp_enqueue_scripts', 'idx_styles');

//-----------------------------------------------------
// CONTACT FORM 7
//-----------------------------------------------------

function idx_enqueue_cf7_scripts()
{
    if (is_page_template('template-contact.php') && function_exists('wpcf7_enqueue_scripts')) {
        wpcf7_enqueue_scripts();
    }
}

//Dequeue default script & css
add_filter('wpcf7_load_css', '__return_false');
//add_filter('wpcf7_load_js', '__return_false');

//Enqueue script only on contact page
add_action('wp', 'idx_enqueue_cf7_scripts');
