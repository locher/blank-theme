<?php

add_filter('acf/settings/save_json', 'sfam_acf_json_save_point');

function sfam_acf_json_save_point()
{
    return get_stylesheet_directory() . '/acf-json';
}
