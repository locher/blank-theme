<?php

/* Template Name: Sitemap  */

$context = \Timber\Timber::get_context();
$context['post'] = new \Timber\Post();


/*
 * CUSTOM POST TYPE
 */

//List of CPT you want in the sitemap
$cpt_list = array('customposttype');

foreach($cpt_list as $cpt){
    $argsCPT = array(
        'post_type' => $cpt,
        'posts_per_page' => 10
    );
    $context['cpt'][] = \Timber\Timber::get_posts($argsCPT);

    //CPT informations
    $context['cptLabels'][] = \Timber\Timber::get_posts(get_post_type_object($cpt));
}


/*
 * PAGES
 */

//Pages sitemap
$argsPages = array(
    'post_type' => 'page',
    'orderby' => 'title',
    'order' => 'ASC'
);

$context['pages'] = \Timber\Timber::get_posts($argsPages);

/*
 * Taxonomies
 */

//List of taxonomies you want in the sitemap
$taxo_list = array('customposttype-category');

foreach($taxo_list as $taxonomy){
    $context['taxo'] = get_terms(array(
        'taxonomy' => $taxonomy,
        'hide_empty' => true,
        'orderby' => 'count',
        'order' => 'DESC'
    ));
}

\Timber\Timber::render('templates/template-sitemap.twig', $context);
