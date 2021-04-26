<?php

$context = \Timber\Timber::get_context();
$context['posts'] = new \Timber\PostQuery();

\Timber\Timber::render('templates/search.twig', $context);
