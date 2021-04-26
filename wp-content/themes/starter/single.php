<?php

$context = \Timber\Timber::get_context();
$context['post'] = new \Timber\Post();
\Timber\Timber::render('templates/single.twig', $context);
