<?php

/* Template Name: Contact  */

$context = \Timber\Timber::get_context();
$context['post'] = new \Timber\Post();
\Timber\Timber::render('templates/template-contact.twig', $context);