<?php

/* Template Name: Language switcher  */

$context = \Timber\Timber::get_context();
$context['post'] = new \Timber\Post();

//Get languages
$context['languages'] = apply_filters('wpml_active_languages', null, 'skip_missing=0&orderby=name&order=asc');

\Timber\Timber::render('templates/template-language-selector.twig', $context);
