<?php

function idx_latest_update_shortcode(): string
{

    $args = array(
        'post_type' => 'any',
        'posts_per_page' => 1,
        'post_status' => 'publish',
        'orderby' => 'modified',
        'order' => 'desc'
    );

    $latest_update = new WP_Query($args);
    $date = new DateTime($latest_update->post->post_modified);

    return($date->format('d/m/Y'));
}

add_shortcode('idx_latest_update_date', 'idx_latest_update_shortcode');
