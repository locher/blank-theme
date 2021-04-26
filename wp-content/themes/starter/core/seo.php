<?php

// robots.txt

add_filter('robots_txt', 'idx_custom_robot', 10,  2);

function idx_custom_robot($output, $public) {
    return 'User-agent: *
Sitemap: '.WP_HOME.'/sitemap_index.xml';
}
